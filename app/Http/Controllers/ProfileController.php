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

        $rand=rand(111111111,999999999);
        $file = $request->image;
  
        $fileName = time().rand(100,1000).'.'.$file->extension();  
    

        $file->move(public_path('logo'), $fileName);
       

        $id = Auth::user()->id;
   
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $fileName;

        if ($request->password == null) {
            
        }
        else {

            $user->password = Hash::make($request->password);

            
        }

        $user->update();

        return redirect()->back();
    }
}
