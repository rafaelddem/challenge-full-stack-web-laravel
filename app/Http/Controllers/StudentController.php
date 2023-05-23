<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(StudentRequest $request)
    {
        try {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->cpf = $request->cpf;
            $student->save();

            $message = 'Record successfully saved';
            return response(['response' => $message], 200);
        } catch (\Throwable $th) {
            $message = 'Internal Server Error';
            return response(['response' => $message], 500);
        }
    }

}