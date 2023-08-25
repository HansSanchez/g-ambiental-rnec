<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class WasteType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'danger_current',
        'transportation_manager',
        'external_manager',
        'environmental_license',
        'certificate_or_type_of_treatment',
        'year',
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
            ->orWhere('danger_current', 'LIKE', '%' . $search_term . '%')
            ->orWhere('transportation_manager', 'LIKE', '%' . $search_term . '%')
            ->orWhere('external_manager', 'LIKE', '%' . $search_term . '%')
            ->orWhere('environmental_license', 'LIKE', '%' . $search_term . '%')
            ->orWhere('certificate_or_type_of_treatment', 'LIKE', '%' . $search_term . '%')
            ->orWhere('year', 'LIKE', '%' . $search_term . '%');
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
            Log::error("(WasteTypeModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
