<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $profile = User::where('id', '=', $id)->first();

        // dd($profile);
        return view('profile.superadminprofile', compact('profile'));
    }

    public function editprofile(Request $request)
    {

        // dd($request->all());
        $id = Auth::user()->id;
        // dd($id);
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password == null) {
            
        }
        else {

            $user->password = Hash::make($request->password);

            
        }

        $user->update();

        return redirect()->back();
    }
}
