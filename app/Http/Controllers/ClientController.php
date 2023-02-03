<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
       return view('client.index');
    }

    public function client_create(){
        return view('client.form');
    }

    public function client_add(Request $request){
         dd('hello');
         dd(Auth::user());
         $client=new Users;
         $client->company_id=
         $client->firstname=$request->first_name;
         $client->lastname=$request->first_name;
         $client->mobileno=$request->first_name;
         $client->city_id=$request->first_name;

         $rules = [
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
             'mobile_no' => ['required','string'],
             'city_id' => ['required','string'],
               'current_bal' => ['nullable','string'],
          ];
     }

}
