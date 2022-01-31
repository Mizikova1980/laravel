<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class role extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'name'
    ];

public function users()
    {
        return $this->belongsToMany(User::class);
    }


}


