<?php

namespace App\Modules\Companies\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
        App::setLocale('pl');
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

    public function store(Request $request)
    {
        $validated = $this->validateForm($request);

        //TODO wyodrębnij plik z requesta

        $file = $request->file('logo');

        //TODO wyodrębnij do zmiennej $filename nazwę pliku (+rozszerzenie)
        $randomFileName=$this->getRandomFileName($file);

        //TODO zapisz plik do katalogu public
        $file ->storePubliclyAs('/upload', $randomFileName);

        $company = new Company;

        $this->setFields($company, $validated,'upload/'.$randomFileName);

        $company->save();

        return redirect('home')->with('message', 'New record added');
    }

    public function destroy($id)
    {
        $company = Company::find($id);

        if ($company->employees->first()) {

            return redirect('home')->with('message-removed', 'Can\'t remove company with existing employees') ;

        } else {

        //TODO znajdż url logo
        $url = $company->logo;

        //TODO usuń plik z public/upload
        Storage::delete($url);

        //TODO usuń plik z BD
        if ($company) {
        $company->forceDelete();
        }

        return redirect('home')->with('message-removed', 'Record removed');
        };
    }

    public function edit($id)
    {
        //TODO znajdź firmę o id z przekazanego parametru
        $company = Company::find($id);

        //TODO przekaż obiekt company do formularza
        return view('Companies::editcompany', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $customErrorMessages = [
            'url'=>'The website address must have such form: https://domainname.extension '
        ];

        $validationRules = [
            'Name' => 'required',
            'email'=>'required|email',
            'website'=>'required|url',
            'logo'=>'image',
            'description'=>'required'
        ];

        $validated = $this->validate($request, $validationRules, $customErrorMessages);

        if ($request->file(('logo'))) {
            $file = $request->file('logo');
            $randomFileName = $this->getRandomFileName($file);
            $file ->storePubliclyAs('/upload', $randomFileName);

            $url = $company->logo;
            Storage::delete($url);
            $this->setFields($company, $validated,'upload/'.$randomFileName);
        }

        $this->setFields($company, $validated, $company->logo, $request);
        $company->save();

        return redirect('home')->with('message', 'Record updated');
    }

    public function view($id)
    {
        $company = Company::find($id);
        $numberOfEmployees = $company->employees()->count();

        return view('Companies::viewcompany', compact('company', 'numberOfEmployees'));
    }

    public function getHighestWages()
    {
        $companies = Company::all();

        foreach ($companies as $company) {

            $wages[$company->getAttribute('Name')] = Employee::with('companies')
                                                        ->where('company',$company->getAttribute('id'))
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

    public function setFields(Company $company, $validated, $filePath)
    {
        $company->Name = $validated['Name'];
        $company->email = $validated['email'];
        $company->website = $validated['website'];
        $company->logo = $filePath;
        $company->description=$validated['description'];
    }

    public function validateForm(Request $request)
    {
        $customErrorMessages=[
            'url'=>'The website address must have such form: https://domainname.extension '
        ];

        $validationRules=[
            'Name' => 'required',
            'email'=>'required|email',
            'website'=>'required|url',
            'logo'=>'required|image',
            'description'=>'required'
        ];

        return $this->validate($request, $validationRules, $customErrorMessages);
    }
}
