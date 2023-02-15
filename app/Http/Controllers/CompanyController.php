<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;


class CompanyController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Company::all();

        // $user = User::where()

        return view('companies.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        // dd($roles);

        return view('companies.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $company = Company::create([
            'company_name' => $request->input('company_name'),
            'name' => $request->input('company_username'),
            'company_phoneno' => $request->input('company_phoneno'),
            'company_address' => $request->input('company_address'),
            'company_email' => $request->input('company_email'),
            'company_password' => $request->input('company_password'),
         ]);
         
            $roleadmin = 'admin';

             $user = User::create([
                 'company_id' => $company->id,
                 'name' => $request->company_username,
                 'email' => $request->company_email,
                 'address' => $request->company_address,
                 'password' => Hash::make($request->input('company_password')),
             ]);
            

            //  dd($user);

             
             
             
             $array=array("Provider","Client","admin");
             // $user->assignRole($role_client);
             // $user->assignRole($role_provider);

             foreach($array as $i){
                  $role = Role::create([
                     'company_id' => $company->id,
                     'name' => $i
                    ]);
                }
                $user->assignRole($roleadmin);

                $cash_client = User::create([
                    'company_id' => $company->id,
                    'name' => 'Cash.Client',
                    'email' => 'cash@gmail.com',
                    'address' => 'cash',
                    'start_bal'=>0,
                ]);

                
            $role=Role::where('name','=','Client')->where('company_id',$company->id)->first();
            $cash_client->assignRole($role->name);
            $db= DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?,?,?)', [$role->id,'App\Models\User',$cash_client->id]);
            

     return redirect()->route('companies.index')
                        ->with('success','Company created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $company = Company::find($id);
        // dd($company);
        $user = User::where('email', '=', $company->company_email)->first();
        
            if (empty($user)) {
                abort(404);
            }

            if(Auth::loginUsingId($user->id)){
                
                return redirect('home');
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Company::find($id);
        return view('companies.edit',['user'=>$user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required'
        // ]);

        $company = Company::find($id);
        $company->company_name = $request->input('company_name');
        $company->company_email = $request->input('company_email');
        $company->company_phoneno = $request->input('company_phoneno');
        // $company->company_password = $request->input('company_password');
        $company->save();

        return redirect()->route('companies.index')
                        ->with('success','Companies updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('companies.index')
                        ->with('success','Companies deleted successfully');
    }

    public function companies(){
        return $companies =Company::all();
    }

    public function updateCompany(Request $request){
        $company =company::find($request->id);
        $company->name =$request->name;
        return ['message'=> 'company record updated successfully'];
}
public function deletetCompany($id){
    $company = Company::find($id);
    $company->delete();
    return ['message'=> 'company deleted successfully'];

}

public function getCompany($id){
    return $company =Company::find($id);
}

}
