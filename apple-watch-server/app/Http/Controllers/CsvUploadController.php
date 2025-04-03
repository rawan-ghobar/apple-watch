<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class CsvUploadController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid file format',
                'errors' => $validator->errors()
            ], 422);
        }

        $filePath = $request->file('file')->store('csv_files');

        $csv = fopen(storage_path('app/private/' . $filePath), 'r');

        fgetcsv($csv);

        $userId = auth()->id();

        while (($row = fgetcsv($csv)) !== false) {

            DB::table('activity_logs')->insert([
                'user_id'        => $userId,
                'date'           => $row[1],
                'steps'          => $row[2],
                'distance_km'    => $row[3],
                'active_minutes' => $row[4],
            ]);
        }

        fclose($csv);

        return response()->json([
            'message' => 'File uploaded and data inserted successfully',
            'path' => $filePath
        ], 200);
    }
}
