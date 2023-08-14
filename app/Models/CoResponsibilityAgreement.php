<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoResponsibilityAgreement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'delegation_id',
        'municipality_id',
        'environmental_operator',
        'date',
        'observations',
    ];
}
