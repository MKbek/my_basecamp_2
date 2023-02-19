<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'role',
    ];

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
