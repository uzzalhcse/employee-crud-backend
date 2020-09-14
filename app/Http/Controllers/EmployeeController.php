<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::paginate(10,['id', 'name', 'email']);
        return response()->success('Employee list', [
            'employee'=> $employee
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'company_id' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:employees'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->error('Validation error',$validator->errors()->all(),Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $credentials = request(['name', 'email', 'company_id']);

            $employee = Employee::create($credentials);
            EmployeeInfo::create([
                'employee_id'=>$employee->id,
                'birthday'=>$request->birthday,
            ]);

            return response()->success('Employee updated', [ 'employee' => $employee], Response::HTTP_CREATED);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return void
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        if (empty($employee)){
            return response()->error('Employee not found',null, 404);
        }
        return response()->success('Employee detail', [
            'employee'=> [
                'id'=> $employee->id,
                'name'=> $employee->name,
                'email'=> $employee->email,
                'company_id'=> $employee->company->id,
                'company_name'=> $employee->company->name,
                'birthday'=> $employee->birthday,
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'company_id' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:employees,email,'.$id.',id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->error('Validation error',$validator->errors()->all(),Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $employee = Employee::findOrFail($id);
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->company_id = $request->company_id;
            $employee->save();
            $employee_info = EmployeeInfo::find($employee->employee_info->id);
            if ($employee_info){
                $employee_info->birthday = $request->birthday;
                $employee_info->save();
            }

            return response()->success('Employee updated', [ 'employee' => $employee], Response::HTTP_CREATED);

        }
    }

    public function destroy($id){
        $employee = Employee::findOrFail($id);
        if ($employee->employee_info){
            $employee->employee_info->delete();
        }
        $employee->delete();
        return response()->success('Employee deleted', null, Response::HTTP_OK);
    }
}
