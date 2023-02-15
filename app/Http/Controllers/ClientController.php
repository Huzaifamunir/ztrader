<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\City;

class ClientController extends Controller
{
    //
     public function index(){
      // dd('good');

        //  $id=Auth::user()->company_id;
        //  $client= User::where('company_id','=',$id)->where()->get();
         $client=User::role('Client')->where('company_id','=',Auth()->user()->company_id)->get();
         
         return view('client.index',compact('client'));

        }

     public function client_create(){

         $city = City::get();
         $client = User::where('company_id', '=', Auth::user()->company_id)->get();
         $product = Product::where('company_id', '=', Auth::user()->company_id)->get();

        return view('client.form', compact('city','client', 'product'));

     }

    public function client_add(Request $request)
    {
      // dd($request->all());

         $client=new User;
         $client->company_id= Auth::user()->company_id;
         $client->email = $request->email;
         $client->city_id = $request->city_id;
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
         $client->assignRole($request->role);

         if($client->save()){
            
            
            $id=$client->id;
            $role=Role::where('name','=',$request->role)->where('company_id',Auth()->user()->company_id)->first();
            
            $db= DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?,?,?)', [$role->id,'App\Models\User',$id]);

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Client Successfully Created !');
            $request->session()->flash('message.link', 'sale/'.$client->id);
            // dd('client');
            if($request->role=='Client')
            {
            return redirect('client');
            }else{
               return redirect('provider');
            }
         }else{
            if($request->role=='Client')
            {
            return redirect('client');
            }else{
               return redirect('provider');
            }
         }
     }
     public function client_single($id){
              $user=User::where('id','=',$id)->first();
              return view('client.single',compact('user'));
     }
     public function client_edit($id){

           $client=User::find($id);
           $city = City::all();
           return view('client.edit',compact('client','city'));
     }

     public function client_update(Request $request)
     {


      // dd($request->all());

        $client=User::find($request->id);
        $client->name=$request->first_name.'.'.$request->last_name;
        $client->email = $request->email;

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

        if($client->save()){
           return redirect('client')->with('msg','Client updated Successfull');
        }else{
           return redirect('client')->with('error','Sorry Something Went Wrong, Try Again');
        }
     }
}
