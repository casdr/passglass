<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function getNagios(Request $request) {
        $val = $request->header('Authorization');
        if ($val != 'Bearer ' . config('passglass.monitoring.header')) {
            return response('Unauthorized', 401);
        }
        $unsealed = Password::where('sealed', 0)->get();

        $res = [];
        foreach($unsealed as $un) {
            $res[] = $un->company->name . "->" . $un->name;
        }
        if(count($res) > 0) {
            return "unsealed: " . implode(', ', $res);
        }
        return "all sealed";
    }
}
