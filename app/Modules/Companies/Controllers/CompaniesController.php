<?php

namespace App\Modules\Companies\Controllers;

use Illuminate\Http\Request;
use App;
use App\Modules\Companies\Models\Company;
use App\Modules\Companies\Models\Employee;
use Illuminate\Support\Facades\Storage;
use App\Modules\Companies\Requests\StoreCompany;
use App\Modules\Companies\Requests\UpdateCompany;


class CompaniesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware(['role:admin'], ['except'=>['index', 'view']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(5);
        $wages= $this->getHighestWages();
        return view('Companies::home', compact('companies','wages'));
    }

    public function store(StoreCompany $request)
    {
        $file = $request->file('logo');
        $randomFileName=$this->getRandomFileName($file);
        $file ->storePubliclyAs('/upload', $randomFileName);

        $company = new Company;
        $this->setFields($company, $request,'upload/'.$randomFileName);
        $company->save();
        return redirect()->route('companies.index')->with('message', 'New record added');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company->employees->first()) {
            return redirect()->route('companies.index')->with('message-removed', 'Can\'t remove company with existing employees') ;
        }
        $url = $company->logo;
        Storage::delete($url);
        if ($company) {
        $company->forceDelete();
        }
        return redirect()->route('companies.index')->with('message-removed', 'Record removed');
    }

    public function edit($id)
    {
        $company = Company::find($id);
        return view('Companies::editcompany', compact('company'));
    }

    public function update(UpdateCompany $request, Company $company)
    {
        if ($request->file(('logo'))) {
            $file = $request->file('logo');
            $randomFileName = $this->getRandomFileName($file);
            $file ->storePubliclyAs('/upload', $randomFileName);

            $url = $company->logo;
            Storage::delete($url);
            $this->setFields($company, $request,'upload/'.$randomFileName);
        }
        $this->setFields($company, $request, $company->logo, $request);
        $company->save();
        return redirect()->route('companies.index')->with('message', 'Record updated');
    }

    public function view($id)
    {
        $company = Company::findOrFail($id);
        $numberOfEmployees = $company->employees()->count();
        return view('Companies::viewcompany', compact('company', 'numberOfEmployees'));
    }

    public function getHighestWages()
    {
        $companies = Company::all();
        $wages = [];
        foreach ($companies as $company) {
            $wages[$company->getAttribute('Name')] = Employee::with('companies')
                                                        ->where('company', $company->getAttribute('id'))
                                                        ->orderByDesc('salary')
                                                        ->first();
        }
        return $wages;
    }

    public function getRandomFileName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $randomFileName = rand();
        return $randomFileName. '.' .$extension;
    }

    public function setFields(Company $company, Request $request, $filePath)
    {
        $company->Name = $request->Name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->logo = $filePath;
        $company->description=$request->description;
    }

}
