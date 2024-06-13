<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function timeslot() {
        return $this->belongsTo(Timeslot::class);
    }

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function staff() {
        return $this->belongsTo(User::class, "staff_id");
    }

    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }
}
