<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;
use App\Models\StudiosSlot;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;

class StudioController extends Controller
{
    public static function getStudios($condition='desc', $query='')
    {
        if($condition=='des' || $condition=="as") {
            return Studio::select('id', 'name', 'location', 'opens_at', 'closes_at')->orderBy('price', $condition.'c')->get();
        }
        else if (in_array($condition, ['10', '12', '14', '16', '18'])) {
            return Studio::select('id', 'name', 'location', 'opens_at', 'closes_at')
                    ->with('studiosslots')->whereHas('studiosslots', function($query) use($condition) {
                        $query->where(['start_time'=>$condition, 'is_booked'=>'0']);
                     })->get();
        }
        else {
            return Studio::select('id', 'name', 'location', 'opens_at', 'closes_at')->orderBy('id', $condition)->get();
        }
    }

    public function getStudio($studioId)
    {
        return Studio::with('studiosslots')->where('id', $studioId)->first();
    }

    public function checkStudioAvailablity($slotId)
    {
        return StudiosSlot::where('id', $slotId)->first()->is_booked;
    }

    public function bookStudio(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "email" => "bail|required|email",
            "first_name" => "bail|required|alpha|max:20",
            "last_name" => "bail|required|alpha|max:20",
            "studio_id" => "bail|numeric",
            "slot_id" => "bail|numeric",
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors->all()
            ]);
        }

        $checkUser = Booking::where(['email' => $request->email, 'studio_id' => $request->studio_id])->first();
        if (!empty($checkUser)) {
            return response()->json(["message" => "You already have a booking for this studio."]);
        } 
        else {
            $response = StudiosSlot::where('id', $request->slot_id)->update(['is_booked' => true]);
            if ($response) {
                return Booking::create($request->all());
            }
        }
    }

    public function searchStudios($condition, $query='')
    {
        if (empty($query)) {
            return StudioController::getStudios($condition);
        } 
        else {
            return Studio::where('name', 'like', "$query%")->get();
        }
    }
}
