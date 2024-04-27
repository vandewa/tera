<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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


        return redirect()->url('/login')->with('pesan', 'ok');

    }
}
