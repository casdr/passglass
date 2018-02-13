<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Bitbeans\Yubikey\Yubikey;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mockery\Exception;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/companies';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        if (!$this->guard()->attempt($this->credentials($request), $request->has('remember'))) {
            return false;
        }

        try {
            $yk = new Yubikey();
            $yk->verify($request->input('yubikey'));
            $identity = $yk->getParameter('identity');
            /* @noinspection PhpUndefinedFieldInspection */
            if ($identity != $this->guard()->user()->yubikey_identity) {
                throw new Exception('Incorrect identity');
            }
        } catch (\Exception $e) {
            $this->guard()->logout();

            return false;
        }
    }
}
