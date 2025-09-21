<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\StudentModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Student extends Controller
{
    private function rules()
    {
        return [
            'first_name'          => 'required|max:100',
            'middle_name'         => 'required|max:100',
            'last_name'           => 'required|max:100',
            'email'               => 'required|email|max:150',
            'contact_no'          => 'required|numeric|max:11',
            'membership_id'       => 'required|max:50',
            'program_name'        => 'required|max:150',
            'training_status'     => 'required|max:50',
            'start_of_training'   => 'required|date',
            'date_completed'      => 'required|date',
            'training_expiration' => 'required|date'
        ];
    }

    public function getStudentLists()
    {
        $data = StudentModel::select(
            DB::raw('CONCAT_WS(" ", first_name, middle_name, last_name) AS full_name'),
            'program_name',
            'start_of_training',
            'date_completed',
            'training_status',
            'training_expiration'
        )->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function createStudent(Request $request)
    {
        $validatedData = $request->validate($this->rules());

        DB::beginTransaction();
        try {
            // Insert into students table
            $data = StudentModel::create($validatedData);

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
