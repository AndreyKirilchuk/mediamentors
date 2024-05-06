<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin_account;

class renamepassController extends Controller
{
    public function renamePass(Request $request)
    {
        $token = session('token');
        $user = admin_account::query()
            ->where("token", $token)
            ->first();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Invalid token']);
        }

        $user->update(['pass' => $request->newpassword]);

        session()->forget('token');
        return  redirect('/loginAdmin');
    }
}
