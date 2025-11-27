<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'price',
        'tasks',
        'start_date',
        'end_date',
    ];

    
  public function members()
{
    return $this->belongsToMany(User::class, 'project_user');
}

public function owner()
{
    return $this->belongsTo(User::class, 'owner_id');
}
}
