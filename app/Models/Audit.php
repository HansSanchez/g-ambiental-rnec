<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'action',
        'description',
        'module',
        'user_id',
    ];

    protected $appends = [
        'CreatedLabel',
    ];


    public function scopeSearch($query, $search_term)
    {
        if ($search_term != null)
            $query->where('action', 'like', '%' . $search_term . '%')
                ->orWhere('module', 'like', '%' . $search_term . '%')
                ->orWhere('description', 'like', '%' . $search_term . '%')
                ->orWhereHas('user', function ($query) use ($search_term) {
                    if ($search_term != null)
                        $query->where('name', 'like', '%' . $search_term . '%');
                });
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->with([
                'delegation' => function ($query) {
                    $query->select('delegations.id', 'delegations.name');
                },
            ]);
    }

    public function getCreatedLabelAttribute()
    {
        if ($this->created_at != null) {
            return $this->created_at->format('Y-m-d H:i');
        }

        return null;
    }
}
