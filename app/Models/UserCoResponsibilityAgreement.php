<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoResponsibilityAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'co_responsibility_agreement_id',
        'user_id'
    ];

    public function CoResponsibilityAgreements()
    {
        return $this->belongsToMany(CoResponsibilityAgreement::class);
    }
}
