<?php

namespace App\Modules\Companies\Controllers;

use Zizaco\Entrust\EntrustFacade as Entrust;
//use App\Company;
//use App\Employee;
use App\Modules\Companies\Models\Company;
use App\Modules\Companies\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin'], ['except'=>'show']);
    }

    //passes id parameter
    public function show($id)
    {
        $company = Company::find($id);
        $employees = Employee::with('companies')->where('company', $id)->get();

        return view('Companies::employees',  compact('employees', 'company'));
    }

    public function store(Request $request, Company $company)
    {
        $rules = [
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'department'=>'required',
            'birthDate'=>'required|date_format:Y-m-d',
            'salary'=>'required|integer'
        ];

        $validated = $this->validate($request, $rules);

        $employee = new Employee();
        $employee->firstName = $validated['firstName'];
        $employee->lastName = $validated['lastName'];
        $employee->email = $validated['email'];
        $employee->phone = $validated['phone'];
        $employee->department = $validated['department'];
        $employee->salary = $validated['salary'];
        $employee->birthDate = $validated['birthDate'];
        $company->employees()->save($employee);

        return back()->with('message','Record added');;
    }

    public function edit($company,$employee)
    {

        $employee = Employee::find($employee);

        return view('Companies::editemployee', compact('employee'));
    }

    public function update($company, Employee $employee, Request $request)
    {
        $validated = $this->validate($request,[
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'department'=>'required',
            'birthDate'=>'required|date_format:Y-m-d',
            'salary'=>'required|integer'
        ]);

        $employee->firstName = $validated['firstName'];
        $employee->lastName = $validated['lastName'];
        $employee->email = $validated['email'];
        $employee->phone = $validated['phone'];
        $employee->save();

        return redirect()->route('listemployees', ['company' => $company])->with('message','Record updated');
    }

    public function delete($company, $employee)

    {
        //if (!Entrust::hasRole('admin')){
          //  abort('403','You are not allowed to send this request');
        //}
        $employee = Employee::find($employee);
        $employee->forceDelete();

        return redirect()->route('listemployees', ['company' => $company])->with('deleted', 'Record deleted');
    }




}
