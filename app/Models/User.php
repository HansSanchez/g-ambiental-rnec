<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'personal_id',
        'first_name',
        'second_name',
        'first_last_name',
        'second_last_name',
        'email',
        'active',
        'phone_number',
        'position',
        'delegation_id',
        'municipality_id',
        'headquarter_id',
        'current_team_id',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'ActiveLabel',
        'FullName',
        'CreatedLabel'
    ];

    public function scopeSearch($query, $search_term)
    {
        $query->where('id', $search_term)
            ->orWhere('first_name', 'LIKE', '%' . $search_term . '%')
            ->orWhere('second_name', 'LIKE', '%' . $search_term . '%')
            ->orWhere('first_last_name', 'LIKE', '%' . $search_term . '%')
            ->orWhere('second_last_name', 'LIKE', '%' . $search_term . '%')
            ->orWhere('email', 'LIKE', '%' . $search_term . '%')
            ->orWhere(function ($query) use ($search_term) {
                $query->whereHas('Delegation', function ($query2) use ($search_term) {
                    $query2->where('delegations.name', 'LIKE', '%' . $search_term . '%');
                });
            })
            ->orWhere(function ($query) use ($search_term) {
                $query->whereHas('Municipality', function ($query2) use ($search_term) {
                    $query2->where('municipalities.city_name', 'LIKE', '%' . $search_term . '%');
                });
            })
            ->orWhere(function ($query) use ($search_term) {
                $query->whereHas('Headquarter', function ($query2) use ($search_term) {
                    $query2->where('headquarters.name', 'LIKE', '%' . $search_term . '%');
                });
            });
    }

    public function scopeWithRelations($query)
    {
        return $query->with([
            // RELACIÓN CON LA DELEGACIÓN
            'Delegation' => function ($query) {
                $query->select(
                    'delegations.id',
                    'delegations.name'
                );
            },
            // RELACIÓN CON EL MUNICIPIO
            'Municipality' => function ($query) {
                $query->select(
                    'municipalities.id',
                    'municipalities.city_name',
                    'municipalities.profile_photo_path'
                );
            },
            // RELACIÓN CON LA SEDE
            'Headquarter' => function ($query) {
                $query->select(
                    'headquarters.id',
                    'headquarters.name',
                    'headquarters.type'
                );
            },
            // RELACIÓN CON EL ROL
            'role' => function ($query) {
                $query->select(
                    'roles.id',
                    'roles.name',
                    'roles.display_name'
                );
            }
        ]);
    }

    public function scopeFilter($query, $request, $day)
    {
        return $query->where(function ($query) use ($request, $day) {
            if ($request->search)
                $query->search($request->search);
            if ($request->delegations_model) {
                $delegation = json_decode($request->delegations_model);
                $query->where('users.delegation_id', $delegation->code);
            }
            if ($request->municipalities_model) {
                $municipality = json_decode($request->municipalities_model);
                $query->where('users.municipality_id', $municipality->code);
            }
            if ($request->delegations_model) {
                $headquarter = json_decode($request->headquarters_model);
                $query->where('users.headquarter_id', $headquarter->code);
            }
            if ($request->dateFilter)
                $query->whereBetween('users.created_at', [$day . " 00:00:00", $day . " 23:59:59"]);
        });
    }

    public function scopePaginate($query, $perPage)
    {
        return $query->orderBy('users.first_name')->simplePaginate($perPage);
    }

    public function Audits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Audit::class);
    }

    public function Delegation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Delegation::class);
    }

    public function Municipality(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function Headquarter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function TreePlantations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TreePlantation::class);
    }

    public function getActiveLabelAttribute()
    {
        switch ($this->active == 'ACTIVO') {
            case true:
                return '<span class="badge badge-success full-16">
                            <strong>SI</strong>
                        </span>';
            case false:
                return '<span class="badge badge-danger full-16">
                            <strong>NO</strong>
                        </span>';
            default:
                return '<span class="badge badge-danger full-16">
                            <strong>' . $this->active . '</strong>
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
            Log::error("(UserModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->second_name . ' ' . $this->first_last_name . ' ' . $this->second_last_name;
    }
}
