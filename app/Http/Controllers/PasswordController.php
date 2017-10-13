<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function getView(Password $password) {
        return view('companies.view_password', ['password' => $password]);
    }
}
