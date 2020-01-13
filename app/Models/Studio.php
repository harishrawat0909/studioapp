<?php

namespace App\Models;
use App\Models\StudiosSlot;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = [
        'name', 'image', 'description', 'location', 'price', 'opens_at', 'closes_at'
    ];

    public function studiosslots()
    {
        return $this->hasMany(StudiosSlot::class);
    }
}
