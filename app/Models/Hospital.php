<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function departments() {
        return $this->hasMany(Department::class);
    }
}
