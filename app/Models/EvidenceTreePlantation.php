<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenceTreePlantation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file',
        'tree_plantation_id'
    ];

    public function TreePlantation()
    {
        return $this->belongsTo(TreePlantation::class);
    }
}
