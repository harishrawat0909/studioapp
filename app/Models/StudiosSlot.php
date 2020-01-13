<?php

namespace App\Models;
use App\Models\Studio;

use Illuminate\Database\Eloquent\Model;

class StudiosSlot extends Model
{
    protected $fillable = [
        'start_time', 'end_time', 'studio_id', 'is_booked'
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
