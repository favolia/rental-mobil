<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
