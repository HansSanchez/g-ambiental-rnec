<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenceCoResponsibilityAgreement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file',
        'co_responsibility_agreement_id'
    ];

    public function CoResponsibilityAgreement()
    {
        return $this->belongsTo(CoResponsibilityAgreement::class);
    }
}
