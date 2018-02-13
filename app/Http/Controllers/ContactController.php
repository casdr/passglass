<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyContact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getAdd(Company $company)
    {
        return view('contacts.add', ['company' => $company]);
    }

    public function postAdd(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $contact = $company->contacts()->create($request->all());

        return redirect()->route('companies.view', ['company' => $company->id])
            ->with('msg', 'Contact '.$contact->name.' has been created');
    }

    public function getDelete(CompanyContact $contact)
    {
        $contact->delete();

        return redirect()->route('companies.view', ['company' => $contact->company->id])
            ->with('msg', 'Contact '.$contact->name.' has been removed');
    }
}
