<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ElectricalConsumption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'month',
        'kw_monthly',
        'total_staff',
        'observations',
        'headquarter_id',
        'user_id'
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
            ->orWhere('environmental_manager', 'LIKE', '%' . $search_term . '%')
            ->orWhere('year', 'LIKE', '%' . $search_term . '%')
            ->orWhere('month', 'LIKE', '%' . $search_term . '%')
            ->orWhere('observations', 'LIKE', '%' . $search_term . '%')
            ->orWhere(function ($query) use ($search_term) {
                $query->whereHas('User', function ($query2) use ($search_term) {
                    $query2->where('users.first_name', 'LIKE', '%' . $search_term . '%')
                        ->orWhere('users.second_name', 'LIKE', '%' . $search_term . '%')
                        ->orWhere('users.first_last_name', 'LIKE', '%' . $search_term . '%')
                        ->orWhere('users.second_last_name', 'LIKE', '%' . $search_term . '%');
                });
            });
    }

    public function scopeWithRelations($query)
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
            'EvidenceElectricalConsumption' => function ($query) {
                $query->select(
                    'evidence_electrical_consumptions.id',
                    'evidence_electrical_consumptions.file',
                    'evidence_electrical_consumptions.electrical_consumption_id'
                );
            },
            // RELACIÓN CON EL/LA CREADOR(A)
            'User' => function ($query) {
                $query->select(
                    'users.id',
                    'users.first_name',
                    'users.second_name',
                    'users.first_last_name',
                    'users.second_last_name',
                );
            },
        ]);
    }

    public function scopeFilter($query, $request, $permissions)
    {
        return $query->where(function ($query) use ($request, $permissions) {
            // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
            if ($request->search) $query->search($request->search);
            // FILTRO PARA BÚSQUEDA POR AÑO
            if ($request->yearFilter) $query->where('electrical_consumptions.year', $request->yearFilter);
            else $query->where('electrical_consumptions.year', now()->format('Y'));
            // FILTRO PARA BÚSQUEDA POR MES
            if ($request->monthFilter) $query->where('electrical_consumptions.month', $request->monthFilter);
            // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
            if (array_key_exists('filter_headquarters_electrical_consumptions', $permissions->permissions())) {
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
                    $query->where('electrical_consumptions.headquarter_id', $headquarter->code);
                } else $query->where('electrical_consumptions.headquarter_id', Auth::user()->headquarter_id);
            }
            // SI NO TIENE PERMISO
            else {
                // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN Y MUNICIPIO AL CUAL PERTENECE
                $query->where('electrical_consumptions.headquarter_id', Auth::user()->headquarter_id);
            }
        });
    }

    public function Headquarter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function EvidenceElectricalConsumption()
    {
        return $this->hasMany(EvidenceElectricalConsumption::class);
    }

    public function User(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
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
            Log::error("(ElectricalConsumptionModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
