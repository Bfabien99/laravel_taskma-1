<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'user_id'
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
