<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Headquarter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'in_charge',
        'type',
        'delegation_id',
        'municipality_id',
        'user_id',
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
            ->orWhere('name', 'LIKE', '%' . $search_term . '%')
            ->orWhere('in_charge', 'LIKE', '%' . $search_term . '%')
            ->orWhere('type', 'LIKE', '%' . $search_term . '%');
    }

    public function Delegation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Delegation::class);
    }

    public function Municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function CoResponsibilityAgreements()
    {
        return $this->belongsToMany(CoResponsibilityAgreement::class, 'headquarter_co_responsibility_agreements')
            ->withTimestamps();;
    }

    public function User()
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
            Log::error("(HeadquarterModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
