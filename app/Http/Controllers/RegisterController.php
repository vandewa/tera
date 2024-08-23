<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Session;

class RegisterController extends Controller
{
    public function store(Request $request)
    {

        $a = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'wa' => $request->wa,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $a->addrole('3');

        Session::flash('pesan', 'ok');

        return redirect()->url('/login');

    }
}
