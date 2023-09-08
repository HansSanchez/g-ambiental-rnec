<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WasteManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'month',
        'value',
        'observations',
        'headquarter_id',
        'user_id',
        'waste_type_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'CreatedLabel',
    ];


    public function scopeSearch($query, $search_term)
    {
        $query->where('id', $search_term)
            ->orWhere('month', 'LIKE', '%' . $search_term . '%')
            ->orWhere('value', 'LIKE', '%' . $search_term . '%')
            ->orWhere('observations', 'LIKE', '%' . $search_term . '%');
    }

    public function scopeWithRelations($query, $request)
    {
        return $query->with([
            // RELACIÓN CON LA SEDE (ESTA VA PRIMERO POR LAS LLAVES FORANEAS)
            'Headquarter' => function ($query) {
                $query->select(
                    'headquarters.id',
                    'headquarters.name',
                    'headquarters.delegation_id',
                    'headquarters.municipality_id'
                );
            },
            // RELACIÓN CON LA DELEGACIÓN
            'Headquarter.Delegation' => function ($query) {
                $query->select(
                    'delegations.id',
                    'delegations.name'
                );
            },
            // RELACIÓN CON EL MUNICIPIO
            'Headquarter.Municipality' => function ($query) {
                $query->select(
                    'municipalities.id',
                    'municipalities.city_name'
                );
            },
            // RELACIÓN CON LA EVIDENCIA
            'EvidenceWasteManagement' => function ($query) {
                $query->select(
                    'evidence_waste_management.id',
                    'evidence_waste_management.name',
                    'evidence_waste_management.extension',
                    'evidence_waste_management.file',
                    'evidence_waste_management.waste_management_id'
                );
            },
            // RELACIÓN CON EL REPORTANTE
            'User' => function ($query) {
                $query->select(
                    'users.id',
                    'users.first_name',
                    'users.second_name',
                    'users.first_last_name',
                    'users.second_last_name',
                );
            },
            // RELACIÓN CON EL TIPO DE RESIDUO
            'WasteType' => function ($query) use ($request) {
                $query->select(
                    'waste_types.id',
                    'waste_types.name',
                    'waste_types.danger_current',
                    'waste_types.transportation_manager',
                    'waste_types.external_manager',
                    'waste_types.environmental_license',
                    'waste_types.certificate_or_type_of_treatment',
                    'waste_types.year',
                )->where(function ($query) use ($request) {
                    if ($request->yearFilter) $query->where('waste_types.year', $request->yearFilter);
                    else $query->where('waste_types.year', now()->format('Y'));
                })
                ->whereIn('', ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'])
                ->groupBy('waste_types.name');
            },
        ]);
    }


    public function scopeFilter($query, $request, $permissions)
    {
        return $query->where(function ($query) use ($request, $permissions) {
            // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
            if ($request->search) $query->search($request->search);
            // FILTRO PARA BÚSQUEDA POR AÑO
            if ($request->yearFilter)
                $query->whereHas('WasteType', function ($query2) use ($request) {
                    $query2->where('waste_types.year', $request->yearFilter);
                });
            else
                $query->whereHas('WasteType', function ($query2) {
                    $query2->where('waste_types.year', now()->format('Y'));
                });
            // FILTRO PARA BÚSQUEDA POR MES
            if ($request->monthFilter) $query->where('waste_management.month', $request->monthFilter);
            // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
            if (array_key_exists('filter_delegations_waste_management', $permissions->permissions())) {
                // PUEDE ACCEDER AL FILTRO Y ENVIAR DIFERENTES DELEGACIONES POR PARAMETRO
                if ($request->delegations_model) {
                    $delegation = json_decode($request->delegations_model);
                    $query->whereHas('Headquarter', function ($query2) use ($delegation) {
                        $query2->where('delegation_id', $delegation->code);
                    });
                }
                if ($request->municipalities_model) {
                    $municipality = json_decode($request->municipalities_model);
                    $query->whereHas('Headquarter', function ($query2) use ($municipality) {
                        $query2->where('municipality_id', $municipality->code);
                    });
                }
                if ($request->headquarters_model) {
                    $headquarter = json_decode($request->headquarters_model);
                    $query->where('waste_management.headquarter_id', $headquarter->code);
                } else $query->where('waste_management.headquarter_id', Auth::user()->headquarter_id);
            }
            // SI NO TIENE PERMISO
            else {
                // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN Y MUNICIPIO AL CUAL PERTENECE
                $query->where('waste_management.headquarter_id', Auth::user()->headquarter_id);
            }
        });
    }

    public function Headquarter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function EvidenceWasteManagement()
    {
        return $this->hasMany(EvidenceWasteManagement::class);
    }

    public function User(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function WasteType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WasteType::class);
    }

    public function getCreatedLabelAttribute()
    {
        try {
            if ($this->created_at != null) {
                if (gettype($this->created_at) == "string") {
                    return date('Y-m-d', strtotime($this->created_at));
                };
                return $this->created_at->format('Y-m-d H:i');
            }
        } catch (\Exception $exception) {
            Log::error("(WasteManagementModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
