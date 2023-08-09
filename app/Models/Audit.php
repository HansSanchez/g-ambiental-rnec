<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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
                        $query->where('first_name', 'like', '%' . $search_term . '%')
                        ->orWhere('second_name', 'like', '%' . $search_term . '%')
                        ->orWhere('first_last_name', 'like', '%' . $search_term . '%')
                        ->orWhere('second_last_name', 'like', '%' . $search_term . '%');
                });
    }

    public function User()
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
        try {
            if ($this->created_at != null) {
                if (gettype($this->created_at) == "string") {
                    return date('Y-m-d', strtotime($this->created_at));
                };
                return $this->created_at->format('Y-m-d H:i');
            }
        } catch (\Exception $exception) {
            Log::error("(AuditModel - getCreatedLabelAttribute) ERROR => " . $exception->getMessage());
        }
        return null;
    }
}
