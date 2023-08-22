<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'state_code',
        'state_name',
        'city_code',
        'city_name',
        'profile_photo_path',
        'active',
        'delegation_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'FullCityName',
    ];

    public function scopeSearch($query, $searchTerm)
    {
        return $query
            ->where('city_name', 'like', "%" . $searchTerm . "%")
            ->orWhere(DB::raw("CONCAT_WS(' ',city_code,state_code,state_name)"), 'like', "%" . $searchTerm . "%");
    }

    public function CoResponsibilityAgreements()
    {
        return $this->belongsToMany(CoResponsibilityAgreement::class, 'municipality_co_responsibility_agreements')
            ->withTimestamps();;
    }

    public function getFullCityNameAttribute()
    {
        return ucwords(mb_strtolower($this->city_name . ' - ' . $this->state_name, "UTF-8"));
    }
}
