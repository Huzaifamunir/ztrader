<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\City;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProviderController extends Controller
{

      public function index(){
        
        // $id=Auth::user()->company_id;
        // $client= User::where('identify','=','client')->where('company_id','=',$id)->get();
        $client=User::role('Provider')->where('company_id','=', Auth::user()->company_id)->get();
        
        return view('provider.index',compact('client'));

       }

     public function provider_create(){

       $city = City::all();
       return view('provider.form', compact('city'));
     }

     public function provider_single($id){
        $provider=User::where('id','=',$id)->first();
        return view('provider.single',compact('provider'));
     }

     public function provider_edit($id){
          $provider=User::find($id);
          return view('provider.edit',compact('provider'));
     }

     public function provider_update(Request $request){

        $client=User::find($request->id);
        $client->name=$request->first_name.'.'.$request->last_name;

        if(isset($request->start_bal)){
            $client->start_bal=$request->start_bal;
        }
        if(isset($request->comment)){
           $client->comment=$request->comment;
        }
        if(isset($request->company_name)){
           $client->company_name=$request->company_name;
        }
        $client->mobileno=$request->mobile_no;
        $client->city_id=$request->city_id;
        $client->address=$request->address;
       //  $client->assignRole($request->role);

       //  $role=Role::where('company_id','=',Auth()->user()->company_id)->where('name','=','Client')->first();
       //  DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?, ?)', [$role->id, 'App\Models\User',$client->id]);

        if($client->save()){
           return redirect()->back()->with('msg','Client updated Successfull');
        }else{
           return redirect()->back()->with('error','Sorry Something Went Wrong, Try Again');
        }
     }

     public function provider_delete($id){
        $provider=User::findorfail($id);
        $provider->delete();

        return redirect()->route('provider');
     }
}
