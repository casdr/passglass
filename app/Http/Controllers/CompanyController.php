<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getRedirect()
    {
        return redirect()->intended('/companies');
    }

    public function getIndex()
    {
        $companies = Company::all();

        return view('companies.index', ['companies' => $companies]);
    }

    public function getView(Company $company)
    {
        return view('companies.view', ['company' => $company]);
    }

    public function getAdd()
    {
        return view('companies.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $company = Company::create($request->all());

        return redirect()
            ->route('companies.view', ['company' => $company])
            ->with('message', 'The company '.$company->name.' has been added');
    }
}
