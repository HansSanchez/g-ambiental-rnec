<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class CoResponsibilityAgreement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'delegation_id',
        'environmental_operator',
        'date',
        'state',
        'observations',
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
            ->orWhere('observations', 'LIKE', '%' . $search_term . '%');
    }

    public function Delegation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Delegation::class);
    }

    public function EvidenceCoResponsibilityAgreement()
    {
        return $this->hasMany(EvidenceCoResponsibilityAgreement::class);
    }

    public function Municipalities()
    {
        return $this->belongsToMany(Municipality::class, 'municipality_co_responsibility_agreements')
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
                return '<span class="badge badge-danger w-100 full-16">
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
