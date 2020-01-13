<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'studio_id', 'slot_id'
    ];
}
