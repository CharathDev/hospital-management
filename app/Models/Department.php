<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function staff() {
        return $this->hasMany(User::class);
    }

    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }
}
