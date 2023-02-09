<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Enforce middlewares.
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $SubCategories=SubCategory::where('company_id','=',Auth()->user()->company_id)->get();
            return $SubCategories;
        }

         $SubCategories=SubCategory::orderBy('name','asc')->where('company_id','=',Auth()->user()->company_id)->paginate(100);
         $mainCategory=MainCategory::where('company_id','=',Auth()->user()->company_id)->get();
         return view("sub_categories/index", compact("SubCategories","mainCategory"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form=[
            "value"  => "add",
            "name"   => "Add SubCategory",
            "submit" => "Save"
        ];

        // $Users=User::all();
        // foreach($Users as $User){
        //     $Users_list[]=array('id'=>$User->id,'name'=>$User->person->first_name." ".$User->person->last_name);
        // }
        // $Users_list=collect($Users_list);
         $mainCategory=MainCategory::all();

        return view('sub_categories/form',compact('form','mainCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, SubCategory::$rules);

        $SubCategory=SubCategory::create([
            'company_id'=> Auth()->user()->company_id,
            'main_category_id' => $request->main_category_id,
            'name'=> $request->name,
        ]);

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'New Record Successfully Created !');
        $request->session()->flash('message.link', 'sub_category/'.$SubCategory->id);

        return redirect('sub_category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SubCategory=SubCategory::find($id);

        return view('sub_categories/single')->with(['SubCategory'=>$SubCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SubCategory=SubCategory::find($id);

        $form=[
            "value" => "update",
            "name" => "Update SubCategory",
            "submit" => "Update"
        ];

        return view('sub_categories/form',compact('form','SubCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, SubCategory::$rules);

        $SubCategory=SubCategory::find($id);
        $SubCategory->update($request->all());

        $request->session()->flash('message.level', 'warning');
        $request->session()->flash('message.content', 'Record Updated !');
        $request->session()->flash('message.link', 'sub_category/'.$id);

        return redirect('sub_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // return redirect('ud');
        $SubCategory=SubCategory::findOrFail($id);
        $SubCategory->delete();

        $request->session()->flash('message.level', 'error');
        $request->session()->flash('message.content', 'Record deleted!');

        return redirect('sub_category');
    }

    /**
     * Search specified resource.
     *
     * @param  \App\SubCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return redirect('ud');
    }
}
