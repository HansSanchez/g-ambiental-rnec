<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'in_charge'
    ];

    public function scopeSearch($query, $search_term)
    {
        $query->where('id', $search_term)
            ->orWhere('name', 'LIKE', '%' . $search_term . '%');
    }

    public function TreePlantations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TreePlantation::class);
    }
}
