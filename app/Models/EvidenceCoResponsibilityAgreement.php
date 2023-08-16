<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class EvidenceCoResponsibilityAgreement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'file',
        'co_responsibility_agreement_id'
    ];

        /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'CreatedLabel'
    ];

    public function CoResponsibilityAgreement()
    {
        return $this->belongsTo(CoResponsibilityAgreement::class);
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
            Log::error("(EvidenceCoResponsibilityAgreement - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
