<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class TreePlantation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'delegation_id', // SEDE O DELEGACIÓN
        'number_of_trees_planted', // NÚMERO DE ÁRBOLES PLANTADOS (AÑO)
        'date', // FECHA DE PLATACIÓN
        'address', // DIRECCIÓN EN DONDE SE PLANTARON LOS ÁRBOLES
        'lat', // LATITUD
        'lng', // LONGITUD
        'observations', // OBSERVACIONES SOBRE LA PLATACIÓN
        'user_id' // USUARIO RELACIONADO CON EL REGISTRO
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'DateLabel'
    ];

    public function scopeSearch($query, $search_term)
    {
        $query->where('id', $search_term)
            ->orWhere('observations', 'LIKE', '%' . $search_term . '%')
            ->orWhere('date', 'LIKE', '%' . $search_term . '%');
    }

    public function Delegation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Delegation::class);
    }

    public function EvidenceTreePlantations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EvidenceTreePlantation::class);
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
            Log::error("(TreePlantationModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
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
            Log::error("(TreePlantationModel - getDateLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
