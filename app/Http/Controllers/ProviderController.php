<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class ProviderController extends Controller
{

      public function index(){

        // $id=Auth::user()->company_id;
        // $client= User::where('identify','=','client')->where('company_id','=',$id)->get();
        $client=User::role('Provider')->where('company_id','=',Auth()->user()->company_id)->get();
        return view('provider.index',compact('client'));

       }

     public function provider_create(){
       return view('provider.form');
     }

     public function provider_single($id){
        $provider=User::where('id','=',$id)->first();
        return view('provider.single',compact('provider'));
}
}
