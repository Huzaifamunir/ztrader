<?php

namespace App\Http\Controllers;

use Auth;
use Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon\Carbon::now();

        $clients = User::role('Client')->where('company_id',Auth::user()->company_id)->orderBy('current_bal','Desc')->limit(7)->get();
       
       
        $sales = Sale::with('user')->where('company_id',Auth::user()->company_id)
            ->whereBetween('created_at', [$date->format('Y-m-d')." 00:00:00", $date->format('Y-m-d')." 23:59:59"])
            ->limit(8)
            ->get();
            
           
        $payments = Payment::where('company_id',Auth::user()->company_id)->with('receiver','payer')
            ->whereBetween('created_at', [$date->format('Y-m-d')." 00:00:00", $date->format('Y-m-d')." 23:59:59"])
            ->limit(8)
            ->get();
           
 $hot_sales = DB::table('sale_items')
            ->select('product_id', DB::raw('sum(sub_total) as total_sale'))
            ->groupBy('product_id')
            ->orderBy('total_sale','desc')
            ->limit(10)->get();
       
        $hot_products = [];
        foreach($hot_sales as $item){
            $product = Product::find($item->product_id);

            $hot_products[] = [
                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'total_sales' => $item->total_sale,
            ];
        }
        
        return view('admin.dashboard',compact('clients','sales','payments','hot_products'));
      
    }

    public function today_sale(Request $request)
    {
       
        if($request->ajax()){
           
            $date = Carbon\Carbon::now();
            
            $total_sales = Sale::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date->format('Y-m-d')." 00:00:00", $date->format('Y-m-d')." 23:59:59"])
                ->sum('total_amount');
                
            $total_payments = Payment::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date->format('Y-m-d')." 00:00:00", $date->format('Y-m-d')." 23:59:59"])
                ->sum('amount');
                
            $data = [
                'total_sales' => $total_sales,
                'total_payments' => $total_payments,
                'total' => $total_sales+$total_payments,
            ];
            
            return $data;
        }

        $date1 = Carbon\Carbon::now();
        $date2 = Carbon\Carbon::now();

        $report_date = Carbon\Carbon::now()->format('Y-M-d');

        $sales = Sale::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])->get();
        $total_sales = Sale::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])
            ->sum('total_amount');

        $payments = Payment::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])->get();
        $total_payments = Payment::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])->sum('amount');

        // return $today_payments;
        return view("admin/sale_payment", compact('report_date','sales','total_sales','payments','total_payments'));
    }

    public function profit_loss(Request $request)
    {
        
        $input = $request->all();

        if(!isset($input['date1'])){
            return view('admin.profit_loss');
        }

        $date1 = Carbon\Carbon::parse($input['date1']);
        $date2 = Carbon\Carbon::parse($input['date2']);
        
        $sales = Sale::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])
            ->get();
        $total_sales = Sale::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])
            ->sum('total_amount');
        $total_profit = Sale::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])
            ->sum('total_profit');
        
        return view("admin/profit_loss", compact('date1','date2','sales','total_sales','total_profit'));
    }

    public function date_sales(Request $request)
    {
        $date = $request->input('date');

        $date1 = Carbon\Carbon::parse($date);
        $date2 = Carbon\Carbon::parse($date);

        $report_date = Carbon\Carbon::parse($date)->format('Y-M-d');
        
        $sales = Sale::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])->get();
        $total_sales = Sale::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])
            ->sum('total_amount');

        $payments = Payment::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])->get();
        $total_payments = Payment::where('company_id',Auth::user()->company_id)->whereBetween('created_at', [$date1->format('Y-m-d')." 00:00:00", $date2->format('Y-m-d')." 23:59:59"])->sum('amount');

        //return $sales;
        return view("admin/sale_payment", compact('report_date','sales','total_sales','payments','total_payments'));
    }

    public function current_stock()
    {

        $products = Product::where('company_id', Auth::user()->company_id)->get();

        $total_products = Product::sum('current_stock');
    

        return view('admin/stock', compact('products','total_products'));
    }


    public function report()
    {

        $Clients = User::role('Client')->where('company_id', Auth::user()->company_id)->get();

        $total_products = User::sum('current_bal');

        return view('admin/report', compact('Clients', 'total_products'));
    }


}
