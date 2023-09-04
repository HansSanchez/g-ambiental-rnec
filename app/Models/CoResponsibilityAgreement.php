<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CoResponsibilityAgreement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'environmental_operator',
        'date',
        'state',
        'observations',
        'headquarter_id',
        'user_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'StateLabel',
        'CreatedLabel',
        'DateLabel'
    ];


    public function scopeSearch($query, $search_term)
    {
        $query->where('id', $search_term)
            ->orWhere('environmental_operator', 'LIKE', '%' . $search_term . '%')
            ->orWhere('date', 'LIKE', '%' . $search_term . '%')
            ->orWhere('state', 'LIKE', '%' . $search_term . '%')
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
            'Headquarters' => function ($query) {
                $query->select(
                    'headquarters.id',
                    'headquarters.name',
                );
            },
            // RELACIÓN CON LA EVIDENCIA
            'EvidenceCoResponsibilityAgreement' => function ($query) {
                $query->select(
                    'evidence_co_responsibility_agreements.id',
                    'evidence_co_responsibility_agreements.file',
                    'evidence_co_responsibility_agreements.co_responsibility_agreement_id'
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
            // RELACIÓN CON LOS GESTORES AMBIENTALES (TABLA PIVOT)
            'Users' => function ($query) {
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
            // FILTRO PARA BÚSQUEDA DE FECHA DE FIRMACIÓN
            if ($request->dateFilter) $query->whereBetween('co_responsibility_agreements.date', [$day . " 00:00:00", $day . " 23:59:59"]);
            if ($request->stateFilter) $query->where('state', $request->stateFilter);
            // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
            if (array_key_exists('filter_headquarters_co_responsibility_agreements', $permissions->permissions())) {
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
                    $query->where('co_responsibility_agreements.headquarter_id', $headquarter->code);
                } else $query->where('co_responsibility_agreements.headquarter_id', Auth::user()->headquarter_id);
            }
            // SI NO TIENE PERMISO
            else {
                // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN A LA CUAL PERTENECE
                $query->where('co_responsibility_agreements.headquarter_id', Auth::user()->headquarter_id);
            }
        });
    }

    public function EvidenceCoResponsibilityAgreement()
    {
        return $this->hasMany(EvidenceCoResponsibilityAgreement::class);
    }

    public function Headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function Headquarters()
    {
        return $this->belongsToMany(Headquarter::class, 'headquarter_co_responsibility_agreements')
            ->withTimestamps();;
    }

    public function User(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Users()
    {
        return $this->belongsToMany(User::class, 'user_co_responsibility_agreements')
            ->withTimestamps();;
    }

    public function getStateLabelAttribute()
    {
        switch ($this->state) {
            case 'VIGENTE':
                return '<span class="badge badge-success w-100 full-16">
                            <strong>' . $this->state . '</strong>
                        </span>';
            case 'NO VIGENTE':
                return '<span class="badge badge-danger w-100 full-16">
                            <strong>' . $this->state . '</strong>
                        </span>';
            default:
                return '<span class="badge badge-warning w-100 full-16">
                            <strong>' . $this->state . '</strong>
                        </span>';
        }
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
            Log::error("(CoResponsibilityAgreementModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
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
            Log::error("(CoResponsibilityAgreementModel - getDateLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
