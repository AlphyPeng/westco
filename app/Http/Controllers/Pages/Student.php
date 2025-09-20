<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\StudentModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Student extends Controller
{
    public function createStudent(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = StudentModel::create([
                'first_name'          => $request->input('first_name'),
                'middle_name'         => $request->input('middle_name'),
                'last_name'           => $request->input('last_name'),
                'email'               => $request->input('email'),
                'contact_no'          => $request->input('contact_no'),
                'membership_id'       => $request->input('membership_id'),
                'program_name'        => $request->input('program_name'),
                'training_status'     => $request->input('training_status'),
                'start_of_training'   => $request->input('start_of_training'),
                'date_completed'      => $request->input('date_completed'),
                'training_expiration' => $request->input('training_expiration')
            ]);

            DB::commit();

            return response()->json([
                'message' => "Successfully Created",
                'data'    => $data
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ], 500);
        }
    }
}
