<?php

namespace App\Modules\Companies\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class EmployeesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //passes id parameter
    public function show($id){

        //$employees = Company::find($id)->employees
        $company = Company::find($id);
        $employees = Employee::with('companies')->where('company', $id)->get();

        return view('Companies::employees',  compact('employees', 'id', 'company'));
    }

    public function store(Request $request, Company $company){



        $rules = [
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'phone'=>'required|integer',
            'department'=>'required',
            'birthDate'=>'required|date_format:Y-m-d',
            'salary'=>'required|integer'

        ];

        $validated=$this->validate($request, $rules);

        $employee= new Employee();
        $employee->firstName=$validated['firstName'];
        $employee->lastName=$validated['lastName'];
        $employee->email=$validated['email'];
        $employee->phone=$validated['phone'];
        $employee->department=$validated['department'];
        $employee->salary=$validated['salary'];
        $employee->birthDate=$validated['birthDate'];
        $company->employees()->save($employee);
        return back()->with('message','Record added');;

    }

    public function edit($company, $employee){
        $employee=Employee::find($employee);
        return view('Companies::editemployee', compact('employee'));
    }

    public function update($company, Employee $employee, Request $request){
        
        $validated=$this->validate($request,[
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'phone'=>'required|integer'
        ]);

        $employee->firstName=$validated['firstName'];
        $employee->lastName=$validated['lastName'];
        $employee->email=$validated['email'];
        $employee->phone=$validated['phone'];
        $employee->save();
        return redirect()->route('listemployees', ['company' => $company])->with('message','Record updated');

    }

    public function delete($company, $employee)
    {
        $employee=Employee::find($employee);
        $employee->forceDelete();
        return redirect()->route('listemployees', ['company' => $company])->with('deleted', 'Record deleted');

    }
}
