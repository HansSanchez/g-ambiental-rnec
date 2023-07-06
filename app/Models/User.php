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
            ->orWhere('email', 'LIKE', '%' . $search_term . '%');
    }

    public function delegation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Delegation::class);
    }

    public function audits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Audit::class);
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
        if ($this->created_at != null) {
            return $this->created_at->format('Y-m-d H:i');
        }

        return null;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->second_name . ' ' . $this->first_last_name . ' ' . $this->second_last_name;
    }
}
