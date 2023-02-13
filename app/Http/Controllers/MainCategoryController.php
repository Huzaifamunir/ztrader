<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\User;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $MainCategories=MainCategory::where('company_id','=',Auth()->user()->company_id)->get();

            return $MainCategories;
        }
        $MainCategories=MainCategory::where('company_id','=',Auth()->user()->company_id)->orderBy('name','asc')->paginate(100);
        // dd($MainCategories);
        $subcategories=SubCategory::all();
        return view("main_categories/index", compact("MainCategories","subcategories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        //
        $form=[
            "value" => "add",
            "name" => "Add MainCategory",
            "submit" => "Save"
        ];

        // $Users=User::where('company_id',Auth::user()->company_id)->get();
        // foreach($Users as $User){
        //     $Users_list[]=array('id'=>$User->id,'name'=>$User->person->first_name." ".$User->person->last_name);
        // }
        // $Users_list=collect($Users_list);

        return view('main_categories/form',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //
        $this->validate($request, MainCategory::$rules);

        $MainCategory=MainCategory::create($request->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'New Record Successfully Created !');
        $request->session()->flash('message.link', 'main_category/'.$MainCategory->id);

        return redirect('main_category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $MainCategory=MainCategory::find($id);
        $sub_categories=SubCategory::where('company_id', Auth()->user()->company_id)->get();

        return view('main_categories/single',compact('MainCategory','sub_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $MainCategory=MainCategory::find($id);

        $form=[
            "value" => "update",
            "name" => "Update MainCategory",
            "submit" => "Update"
        ];

        return view('main_categories/form',compact('form','MainCategory'));
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
        // dd($request->all());
        //
        $this->validate($request, MainCategory::$rules);
        
        $MainCategory=MainCategory::find($id); 
        $MainCategory->name=$request->name;
        $MainCategory->save();


        $request->session()->flash('message.level', 'warning');
        $request->session()->flash('message.content', 'Record Updated !');
        $request->session()->flash('message.link', 'main_category/'.$id);

        return redirect('main_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        // return redirect('ud');
        $MainCategory=MainCategory::findOrFail($id);
        $MainCategory->delete();

        $request->session()->flash('message.level', 'error');
        $request->session()->flash('message.content', 'Record deleted!');

        return redirect('main_category');
    }

     /**
     * Search specified resource.
     *
     * @param  \App\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return view('under_development');
        $column=$request['column'];
        $keyword=$request['keyword'];

        if($column=='first_name'||$column=='last_name'||$column=='mobile_no'||$column=='email'){
            $MainCategorys = MainCategory::with(['user.person'])->whereHas('user.person', function($query) use($column, $keyword) {
                $query->where($column, 'like', '%'.$keyword.'%');
            })->paginate(20);

            return view("main_categories/index", compact("MainCategorys"));
        }
        else{
            $MainCategorys=MainCategory::where($column, 'LIKE', "%".$keyword."%")->paginate(20);

            return view("main_categories/index", compact("MainCategorys"));
        }
    }
}
