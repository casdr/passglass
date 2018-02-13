<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getUpdate()
    {
        return view('profile.update');
    }

    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:12',
        ]);
        \Auth::user()->update([
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('profile.update')->with('msg', 'Your profile has been updated');
    }
}
