<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function list()
    {
        $filter = "";

        if (request('search')) 
            $filter = request('search');

        $students = Student::query()
            ->select()
            ->where('name', 'like', $filter . '%')
            ->orderBy('name', 'asc')
            ->get();

        return response(['results' => $students], 200);
    }

    // public function list()
    // {
    //     $search = request('search');

    //     $students = Student::query()
    //         ->select();

    //     if ($search) {
    //         if (is_numeric($search)) {
    //             $students
    //                 ->where('ra', '=', $search)
    //                 ->orWhere('ra', '=', $search);
    //         } else {
    //             $students
    //                 ->where('name', 'like', '%' . $search . '%')
    //                 ->orWhere('name', 'like', '%' . $search . '%');
    //         }
    //     }

    //     $students = $students->get();

    //     return response(['results' => $students], 200);
    // }

    public function store(StudentRequest $request)
    {
        try {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->cpf = $request->cpf;
            $student->save();

            $message = 'Record successfully saved';
            return response(['response' => $message], 201);
        } catch (\Throwable $th) {
            $message = 'Internal Server Error';
            return response(['response' => $message], 500);
        }
    }

    public function show($id)
    {
        try {
            $student = Student::query()->find($id);

            if (empty($student)) 
                return response(['response' => 'Record not found'], 204);
            
            return response(['response' => $student], 200);
        } catch (\Throwable $th) {
            $message = 'Internal Server Error';
            return response(['response' => $message], 500);
        }
    }

    public function update(StudentRequest $request, int $id)
    {
        try {
            $student = Student::query()->find($id);

            if (empty($student)) 
                return response(['response' => 'Record not found'], 204);

            $student->name = $request->name;
            $student->email = $request->email;
            $student->update();

            $message = 'Record successfully updated';
            return response(['response' => $message], 200);
        } catch (\Throwable $th) {
            $message = 'Internal Server Error';
            return response(['response' => $message], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::query()->find($id);

            if (!empty($student)) {
                $student->delete();

                $message = 'Record successfully deleted';
                return response(['response' => $message], 202);
            } else {
                $message = 'Record not found';
                return response(['response' => $message], 204);
            }

        } catch (\Throwable $th) {
            $message = 'Internal Server Error';
            return response(['response' => $message], 500);
        }
    }

}