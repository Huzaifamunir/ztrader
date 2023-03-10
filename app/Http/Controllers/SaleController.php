<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Sale;
use App\Models\Bank;
use App\Models\Item;
use App\Models\Person;
use App\Models\Client;
use App\Models\Voucher;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Salesman;
use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Core\HelperFunction;
use App\Models\Transiction;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $i=1;
        $Sales=Sale::where('company_id',Auth::user()->company_id)->orderBy('id','desc')->get();
        
        return view("sale/index", compact("Sales","i"));
    }

    public function create()    
    {
        $form=[
            "value" => "add",
            "name" => "Add Sale",
            "submit" => "Save"
        ];

        $Cities = City::where('company_id', '=', Auth::user()->company_id)->get();

        $client = User::where('company_id', '=', Auth::user()->company_id)->get();

        $banks = bank::all();

        return view('sale/form',compact('form','Cities', 'client', 'banks'));
    }

  public function store(Request $request)
    {   
        
      

       if($request->client_id==1)
       {
        $request->session()->flash('message.level', 'error');
        $request->session()->flash('message.content', 'Please Select Client !');
        return back();
       }
        
        $client = User::find($request->client_id);
     
       
        $input =  $request->all();

        $get_old_bal=Sale::where('client_id',$input['client_id'])->latest()->first();

        if($get_old_bal==null)
        {
            $old_bal=0;
        }else {
            $old_bal= $get_old_bal->old_sale_balance + $input['total_amount'];
        }

        $total_profit = 0;
        $sale_items = [];


foreach($input['product_id'] as $key => $item){
    $product = Product::find($input['product_id'][$key]);
    $profit = ($input['price_per_unit'][$key]-$product['purchase_price'])*$input['quantity'][$key];
    $total_profit+=$profit;

    $sale_items[] = [
        'product_id' => $input['product_id'][$key],
        'price_per_unit' => $input['price_per_unit'][$key],
        'quantity' => $input['quantity'][$key],
        'sub_total' => $input['sub_total'][$key],
        'profit' => $profit,
    ];
$result=$input['sub_total'];
$sum=0;        
for($i=0;$i<count($result);$i++)
{
$sum=$sum+$result[$i];
}
    // update stock
    $product->decrement('current_stock',$input['quantity'][$key]);
}

// Client balance update check


$balance = $input['total_amount']-$input['payment'];

if($balance>0){
    $client->increment('current_bal',$balance);
}

// Add payment
if($input['payment']>0){
    $payment_input = [
        'receiver_id' => $input['seller_id'],
        'payer_id' => $request->client_id,
        'date' => Carbon::Now(),
        'company_id'=>Auth::user()->company_id,
        'transaction_mode' => $request->transaction_mode,
        'amount' => $input['payment'],
        'remarks' => 'Payment with sale.',
    ];
    $payment = Payment::create($payment_input);

    $input['payment_id'] = $payment['id'];
    // dd($input['payment_id']);
    $pay=Payment::where('id',$input['payment_id'])->first();
    // dd($pay->amount);
}

$input['total_profit']=$total_profit;
$input['client_balance']=$client['current_bal'];
$input['old_sale_balance']=$old_bal;
$Sale = Sale::create($input);
$update=Sale::where('id',$Sale->id)->first();
$update->company_id= Auth::user()->company_id;
$update->save();

$bill=str_pad($Sale->id, 3, "0", STR_PAD_LEFT);

$add_tra=Transiction::create([
    'bank_id'=>$request->transaction_mode,
    'trans_date'=>date('y-m-d'),
    'trans_operator'=>'-',
    'amount'=>$request->total_amount,
    'sale_id'=>$Sale->id,
    'trans_description'=>'Invoice ZR_'.$bill,
    'client_id'=>$request->client_id,
]);

$Sale->items()->createMany($sale_items);

$request->session()->flash('message.level', 'success');
$request->session()->flash('message.content', 'Sale Successfully Created !');
$request->session()->flash('message.link', 'sale/'.$Sale->id);


return redirect('sale');
}

    

    public function show($id)
    {       
      
        $Sale=Sale::find($id);
        $sale_item=SaleItem::where('sale_id',$Sale->id)->get();
        return view('sale/print', compact('Sale','sale_item'));
    }
    public function edit($id)
    {   
        $Sale=Sale::with('items.product')->find($id);

        $form=[
            "value" => "update",
            "name" => "Update Sale",
            "submit" => "Update"
        ];

        $Cities = City::where('company_id','=', Auth::user()->company_id)->get();

        $banks = Bank::all();
        
        return view('sale/form',compact('form','Sale','Cities', 'banks'));
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, Sale::$rules);
        $input = $request->all();

        $Sale = Sale::find($id);
        $client = User::find($input['client_id']);

        $total_profit = 0;
        $old_items = $Sale['items'];
        $new_items = [];
        
        foreach ($old_items as $key => $item) {
            $product = Product::find($item['product_id']);
            $new_stock = $product['current_stock']+$item['quantity'];
            $product->update(['current_stock'=>$new_stock]);

            $sale_item = SaleItem::find($item['id']);        
            $sale_item->delete();
        }

        foreach($input['product_id'] as $key => $item) {
            $product = Product::find($input['product_id'][$key]);
            $profit = ($input['price_per_unit'][$key]-$product['purchase_price'])*$input['quantity'][$key];
            $total_profit+=$profit;

            $new_items[] = [
                'product_id' => $item,
                'price_per_unit' => $input['price_per_unit'][$key],
                'quantity' => $input['quantity'][$key],
                'sub_total' => $input['sub_total'][$key],
                'profit' => $profit,
            ];                                

            $new_stock = $product['current_stock']-$input['quantity'][$key];
            $product->update(['current_stock'=>$new_stock]);
        }


        if($Sale['payment']!=null){
            $previous_bill = $Sale['total_amount']-$Sale['payment']['amount'];  
        }
        else{
            $previous_bill = $Sale['total_amount'];
        }

        if($previous_bill!=null){
            $client->decrement('current_bal',$previous_bill);
        }
        $Sale->payment()->delete();


        if($input['payment']>0){
            $payment_input = [
                'receiver_id' => $input['seller_id'],
                'payer_id' => $client['user_id'],
                'date' => Carbon::Now(),
                'transaction_mode' => 'Cash',
                'amount' => $input['payment'],
                'remarks' => 'Payment with sale.',
            ];
            $payment = Payment::create($payment_input);


            $input['payment_id'] = $payment['id'];
        }
        
        // client new balance
        $client = User::find($input['client_id']);
        $balance = $input['total_amount']-$input['payment'];
        if($balance>0){
            $client->increment('current_bal',$balance);
        }

        $input['total_profit']=$total_profit;
        $input['client_balance']=$client['current_bal'];
        $Sale->update($input);
        $Sale->items()->createMany($new_items);

        $request->session()->flash('message.level', 'warning');
        $request->session()->flash('message.content', 'Record Updated !');
        $request->session()->flash('message.link', 'sale/'.$id);
        
        return redirect('sale');
    }

    public function destroy(Request $request, $id)
    {  
        

        $Sale=Sale::findOrFail($id);

        $update_current_bal=User::where('id',$Sale->client_id)->first();

        $bal=$update_current_bal->current_bal - $Sale->total_amount;
        
        $update_current_bal->current_bal=$bal;
        $update_current_bal->save();
        $Sale->delete();

        $request->session()->flash('message.level', 'error');
        $request->session()->flash('message.content', 'Record deleted!');
        
        return redirect('sale');
    }

    public function search(Request $request)
    {   
        $input = $request->all();
        if($request['column']=='bill_no'){
            $input['keyword'] = str_replace('ZR_00','',$input['keyword']);
            $input['keyword'] = str_replace('ZR_0','',$input['keyword']);
            $input['keyword'] = str_replace('ZR_','',$input['keyword']);
            $input['column'] = 'id';
        }

        $Sales=Sale::where($input['column'], 'LIKE', "%".$input['keyword']."%")->paginate(10);
        
        return view("sale/index", compact("Sales"));
    }

    public function print_sale($id)
    {
        $Sale=Sale::with('payment')->Find($id);
        
        return view('sale.print')->with(['Sale'=>$Sale]);
    }

    public function get_cash_user($id)
    {
        
        $client = User::find($id);
        
        $get_Client_name=explode('.',$client->name);
       
        return response()->json([
            "cash_user"=> $get_Client_name[0]
         ],200);
    }


}