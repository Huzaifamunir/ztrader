<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

 // {{--  public function_construct()
    // {
    //    $this (['Auth','isAdmin']);
    // }

    public function permissions(Request $request)
    {
         return $permissions = Permission::all();

    }

    public function getPermission($id){
        return $permission = Permission::find($id);
    }

    public function deletePermission($id){
        $permission = Permission::find($id);
        $permission->delete();
        return ['message' => 'permission deleted successfully'];
    }

    public function updateRole(Request $request){
        $permission = Permission::find($request->id);
        $permission->name = $request->name;
        $permission->save();
        return ['message' => 'permission Updated successfully'];
    }






    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$permissions = Permission::where('company_id',Auth::user()->company_id)->paginate(5);
        $permissions = Permission::all();
        return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(); //Get all roles

        return view('permissions.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        //'name' => 'required|unique:permissions,name',
        $permission = Permission::create([
            'company_id' => Auth::user()->company_id,
            'name' => $request->input('name')
            ]);

        return redirect()->route('permissions.index')
                        ->with('success','Permission created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        $permissions = Permission::get();
        return view('permissions.show',['permission'=>$permission,'permissions'=>$permissions]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        $permissions = Permission::get();
        return view('permissions.edit',['permission'=>$permission,'permissions'=>$permissions]);

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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();

        $permission->syncPermissions($request->input('permission'));

        return redirect()->route('permissions.index')
                        ->with('success','Permission updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("permissions")->where('id',$id)->delete();
        return redirect()->route('permissions.index')
                        ->with('success','Permission deleted successfully');
    }

}
