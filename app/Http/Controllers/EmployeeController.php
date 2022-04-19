<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DB;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$employee = Employee::get();
        $employee = DB::table('employees')
                    ->join('companies','employees.company','=','companies.id')
                    ->select('employees.*','companies.name')
                    ->get();
        //dd($employee);
        return $employee;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd("okkk");
        $this->validate($request,[
            'first_name'=>'required|max:15',
            'last_name'=>'required',
            'company'=>'required',
            'email'=>'required|email|unique:employees',
            'phone'=>'required|numeric',
         ]);
        $employee = new Employee;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company	 = $request->company;
        $employee->email	 = $request->email;
        $employee->phone	 = $request->phone;
        $employee->save();
        if($employee->save())
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Employee::find($id);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'first_name'=>'required|max:15',
            'last_name'=>'required',
            'company'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
         ]);
        $update = Employee::where('id',$id)->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'company'	 => $request->company,
        'email'	 => $request->email,
        'phone'	 => $request->phone,
    ]);
        if($update)
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {//dd($id);
        $delete = Employee::where('id',$id)->delete();
        if($delete)
        {
            return 1;
        }else{
            return 0;
        }
    }
}
