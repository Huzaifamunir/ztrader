<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //
     public function index(){

        //  $id=Auth::user()->company_id;
        //  $client= User::where('company_id','=',$id)->where()->get();
         $client=User::role('Client')->where('company_id','=',Auth()->user()->company_id)->get();
         return view('client.index',compact('client'));

        }

     public function client_create(){

        return view('client.form');

     }

    public function client_add(Request $request){

         // dd(Auth::user()->role);
         // $rules = [
         //     'first_name' => ['required','string'],
         //     'last_name' => ['required','string'],
         //     'mobile_no' => ['required','string'],
         //     'city_id' => ['required','string'],
         //     'current_bal' => ['nullable','string'],
         //  ];
         // $this->validate($request, $rules);
         //   dd('hello');
         //  $user = User::create([
         //     'company_id' => Auth::user()->company_id,
         //     'name' => $request->first_name.$request->last_name,
         //     'mobileno' => $request->mobile_no,
         //     'start_bal' => $request->start_bal,
         //     'city_id' => $request->city_id,
         //     'address' => $request->address,
         //  ]);
         // $array=array("Client","Provider");

         $client=new User;
         $client->company_id= Auth::user()->company_id;
         $client->name=$request->first_name.'.'.$request->last_name;

         if(isset($request->start_bal)){
             $client->start_bal=$request->start_bal;
         }
         if(isset($request->comment)){
            $client->comment=$request->comment;
         }
         if(isset($request->company_name)){
            $client->comment=$request->company_name;
         }
         $client->mobileno=$request->mobile_no;
         $client->city_id=$request->city_id;
         $client->address=$request->address;
        //  $client->assignRole($request->role);

        //  $role=Role::where('company_id','=',Auth()->user()->company_id)->where('name','=','Client')->first();
        //  DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?, ?)', [$role->id, 'App\Models\User',$client->id]);

         if($client->save()){
            $id=$client->id;
            $role=Role::where('company_id','=',Auth()->user()->company_id)->where('name','=',$request->role)->first();
            $db= DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?,?,?)', [$role->id,'App\Models\User',$id]);
            return redirect()->back()->with('msg','Client Added Successfull');
         }else{
            return redirect()->back()->with('error','Sorry Something Went Wrong, Try Again');
         }
     }
     public function client_single($id){
              $user=User::where('id','=',$id)->first();
              return view('client.single',compact('user'));
     }
}
