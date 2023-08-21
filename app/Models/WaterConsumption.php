<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class WaterConsumption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'environmental_manager',
        'delegation_id',
        'municipality_id',
        'year',
        'month',
        'm3_monthly',
        'total_staff',
        'observations',
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
            ->orWhere('observations', 'LIKE', '%' . $search_term . '%');
    }

    public function Delegation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Delegation::class);
    }

    public function EvidenceWaterConsumption()
    {
        return $this->hasMany(EvidenceWaterConsumption::class);
    }

    public function Municipality()
    {
        return $this->belongsTo(Municipality::class);
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
            Log::error("(WaterConsumptionModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
