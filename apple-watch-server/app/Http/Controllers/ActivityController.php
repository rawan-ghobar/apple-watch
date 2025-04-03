<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityController extends Controller
{
    public function getActivities(){
        $user = auth()->user();

        $activities = ActivityLog::where('user_id', $user->id)->get();

        if ($activities->isNotEmpty()) {
            return response()->json([
                "success" => true,
                "activities" => $activities
            ]);
        }

        return response()->json([
            "success" => false,
            "message" => "No activities found for the user."
        ], 404);
    }
}
