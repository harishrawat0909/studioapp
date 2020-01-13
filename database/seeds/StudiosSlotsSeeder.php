<?php

use Illuminate\Database\Seeder;
use App\Models\StudiosSlot;

class StudiosSlotsSeeder extends Seeder
{
    public function run()
    {
        $studiosSlots = [];
        $studioSlots = [];
        $perStudioSlot = [];
        $slots = [[0 => 10, 1 => 11], [0 => 12, 1 => 13], [0 => 14, 1 => 15], [0 => 16, 1 => 17], [0 => 18, 1 => 19]];
        for ($i=0; $i < 4; $i++) { 
            for ($j=0; $j < 5; $j++) { 
                $perStudioSlot["start_time"] = $slots[$j][0];
                $perStudioSlot["end_time"]   = $slots[$j][1];
                $perStudioSlot["studio_id"]  = $i+1;
                $studioSlots[$j] = $perStudioSlot;
            }
            StudiosSlot::insert($studioSlots);
        }
        
    }
}
