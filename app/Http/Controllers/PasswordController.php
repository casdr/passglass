<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Key;
use App\Models\Password;
use App\Models\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function getView(Password $password)
    {
        $password->logEntries()->create([
            'description' => 'viewed the password',
        ]);

        return view('passwords.view', ['password' => $password]);
    }

    public function getAdd(Company $company)
    {
        return view('passwords.add', ['company' => $company]);
    }

    public function postAdd(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        $password = Password::create(array_merge(
            $request->only(['name', 'username', 'password']),
            ['company_id' => $company->id]
        ));
        $password->logEntries()->create([
            'description' => 'created the password',
        ]);

        return redirect()
            ->route('passwords.view', ['password' => $password])
            ->with('message', 'The password ' . $password->title . ' has been added');
    }

    public function getDecrypt(Password $password)
    {
        return $password->password;
    }

    public function getKeys() {
        $fetchKeys = Key::all();
        $keys = [];
        foreach ($fetchKeys as $key) {
            $keys[] = $key->gpg_public;
        }
        return [
            'keys' => implode("\n", $keys)
        ];
    }

    public function getUpdate(Password $password)
    {
        return view('passwords.update', ['password' => $password]);
    }

    public function postUpdate(Request $request, Password $password)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        $password->update($request->only('name', 'username', 'password'));

        return redirect()
            ->route('passwords.view', ['password' => $password])
            ->with('message', 'The password ' . $password->title . ' has been updated');
    }
}
