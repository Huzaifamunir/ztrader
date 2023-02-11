<?php

namespace App\Http\Controllers;

use Redirect;
use App\Item;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
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
        // dd($request->all());

        if($request->ajax()){
            $Products=Product::where('company_id','=',Auth()->user()->company_id)->get();
            return $Products;
        }

        $Products=Product::where('company_id','=',Auth()->user()->company_id)->orderBy('name','asc')->paginate(100);

        

        return view("product/index", compact("Products"));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsubcategories(Request $request)
    {
        if($request->ajax()){
            $Products=SubCategory::where('main_category_id','=',$request->id)->get();
            $products2=json_encode($Products);
            return json_decode($products2);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form=[
            "value" => "add",
            "name" => "Add Product",
            "submit" => "Save"
        ];


        return view('product/form',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $input = $request->all();
        $this->validate($request, Product::$rules);

        // dd($request->all());
        if(isset($input['image'])){

            $image = $request->image;
            $destinationPath = public_path('/img/product/');
            $image_name = time()."_gtl.".$image->getClientOriginalExtension();
            $image->move($destinationPath,$image_name);
            $input['image'] = $image_name;

        }

        $Product = Product::create($input);
        
        $update=Product::where('id',$Product->id)->first();
        $update->company_id=Auth::user()->company_id;
        $update->save();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'New Record Successfully Created !');
        $request->session()->flash('message.link', 'product/'.$Product->id);

        return Redirect('product');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        if($request->ajax()){
            $Product = Product::find($id)->toArray();
            return $Product;
        }

        // $Product = Product::with('sub_category.main_category')->find($id);
        $Product = Product::where('id','=',$id)->first();
        // dd($Product);
        $subcategory=SubCategory::where('id','=',$Product->sub_category_id)->first();
        // dd($subcategory);
        $maincategory=MainCategory::where('id','=',$subcategory->main_category_id)->first();

        return view('product/single', compact('Product','maincategory','subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Product=Product::find($id);
        
         $subcategory=SubCategory::where('id','=',$Product->sub_category_id)->first();
         
         $main_category_id=$subcategory->main_category_id;
         $subcategorys=SubCategory::where('company_id','=',Auth()->user()->company_id);
         $maincategorys=MainCategory::where('company_id','=',Auth()->user()->company_id);
         $form=[
            "value" => "update",
            "name" => "Update Product",
            "submit" => "Update"
         ];

        return view('product/form',compact('form','Product','main_category_id','subcategorys','maincategorys'));
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
        $input = $request->all();
        $update_rules=Product::$rules;
        $update_rules['model']='required|string|unique:products,model,'.$id;
        $this->validate($request, $update_rules);

        if(isset($input['image'])){
            $image = $request->image;
            $destinationPath = public_path('/img/product/');
            $image_name = time()."_gtl.".$image->getClientOriginalExtension();
            $image->move($destinationPath,$image_name);
            $input['image'] = $image_name;
        }

        $Product=Product::find($id);
        $Product->name=$request->name;
        if($request->sub_category_id !== null){
        $Product->sub_category_id=$request->sub_category_id;
        }
        $Product->model=$request->model;
        $Product->purchase_price=$request->purchase_price;
        $Product->sale_price=$request->sale_price;
        $Product->current_stock=$request->current_stock;
        $Product->min_stock_value=$request->min_stock_value;

        $Product->save();
        // $Product->update($input);

        $request->session()->flash('message.level', 'warning');
        $request->session()->flash('message.content', 'Record Updated !');
        $request->session()->flash('message.link', 'product/'.$id);

        return Redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $Product = Product::findOrFail($id);

        
            $Product->delete();

            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Record deleted!');

            return redirect('product');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $Products=Product::where($request['column'], 'LIKE', "%".$request['keyword']."%")->paginate(10);

        return view("product/index", compact("Products"));
    }
}
