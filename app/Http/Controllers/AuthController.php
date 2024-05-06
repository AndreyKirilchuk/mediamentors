<?php

namespace App\Http\Controllers;

use App\Models\admin_account;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ReCaptcha\ReCaptcha;

class AuthController extends Controller
{
    public function login(Request $request)
 {
        $token = Str::uuid();

        $user = admin_account::query()
            ->where("pass", $request->password)
            ->first();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Ошибка']);
        }

        $user->update(['token' => $token]);

        session(['token' => $token]);

        return redirect('/admin');
    }
}
