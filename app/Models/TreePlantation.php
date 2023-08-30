<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TreePlantation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number_of_trees_planted', // NÚMERO DE ÁRBOLES PLANTADOS (AÑO)
        'date', // FECHA DE PLATACIÓN
        'address', // DIRECCIÓN EN DONDE SE PLANTARON LOS ÁRBOLES
        'lat', // LATITUD
        'lng', // LONGITUD
        'observations', // OBSERVACIONES SOBRE LA PLATACIÓN
        'headquarter_id', // SEDE O DELEGACIÓN
        'user_id' // USUARIO RELACIONADO CON EL REGISTRO
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'CreatedLabel',
        'DateLabel'
    ];

    public function scopeSearch($query, $search_term)
    {
        $query->where('id', $search_term)
            ->orWhere('number_of_trees_planted', 'LIKE', '%' . $search_term . '%')
            ->orWhere('date', 'LIKE', '%' . $search_term . '%')
            ->orWhere('address', 'LIKE', '%' . $search_term . '%')
            ->orWhere('observations', 'LIKE', '%' . $search_term . '%');
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
            'EvidenceTreePlantations' => function ($query) {
                $query->select(
                    'evidence_tree_plantations.id',
                    'evidence_tree_plantations.file',
                    'evidence_tree_plantations.tree_plantation_id'
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

    public function scopeFilter($query, $request, $day, $permissions)
    {
        return $query->where(function ($query) use ($request, $day, $permissions) {
            // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
            if ($request->search) $query->search($request->search);
            // FILTRO PARA BÚSQUEDA DE FECHA DE PLANTACIÓN
            if ($request->dateFilter) $query->whereBetween('tree_plantations.date', [$day . " 00:00:00", $day . " 23:59:59"]);
            // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR SEDE
            if (array_key_exists('filter_headquarters_tree_plantations', $permissions->permissions())) {
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
                    $query->where('tree_plantations.headquarter_id', $headquarter->code);
                }
            }
            // SI NO TIENE PERMISO
            else {
                // PUEDE VER SOLO LOS REGISTROS DE LA SEDE A LA CUAL PERTENECE
                $query->where('tree_plantations.headquarter_id', Auth::user()->headquarter_id);
            }
        });
    }

    public function scopePaginate($query, $perPage)
    {
        return $query->orderBy('tree_plantations.id')->simplePaginate($perPage);
    }

    public function Headquarter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function EvidenceTreePlantations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EvidenceTreePlantation::class);
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
            Log::error("(TreePlantationModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }

    public function getDateLabelAttribute()
    {
        try {
            if ($this->date != null) {
                if (gettype($this->date) == "string") {
                    return date('Y-m-d', strtotime($this->date));
                };
                return $this->date->format('Y-m-d');
            }
        } catch (\Exception $exception) {
            Log::error("(TreePlantationModel - getDateLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
