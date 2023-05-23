<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // /**
    //     * Display a listing of the resource.
    //     *
    //     * @return Response
    //     */
    //     public function index()
    //     {
    //         //
    //     }
    
    //     /**
    //         * Show the form for creating a new resource.
    //         *
    //         * @return Response
    //         */
    //     public function create()
    //     {
    //         //
    //     }
    
    //     /**
    //         * Store a newly created resource in storage.
    //         *
    //         * @return Response
    //         */
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
    
    //     /**
    //         * Display the specified resource.
    //         *
    //         * @param  int  $id
    //         * @return Response
    //         */
    //     public function show($id)
    //     {
    //         //
    //     }
    
    //     /**
    //         * Show the form for editing the specified resource.
    //         *
    //         * @param  int  $id
    //         * @return Response
    //         */
    //     public function edit($id)
    //     {
    //         //
    //     }
    
    //     /**
    //         * Update the specified resource in storage.
    //         *
    //         * @param  int  $id
    //         * @return Response
    //         */
    //     public function update($id)
    //     {
    //         //
    //     }
    public function update(StudentRequest $request, int $id)
    {
        try {
            $student = Student::query()->find($id);
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
            } else {
                $message = 'Record not found';
            }

            return response(['response' => $message], 200);
        } catch (\Throwable $th) {
            $message = 'Internal Server Error';
            return response(['response' => $message], 500);
        }
    }

}