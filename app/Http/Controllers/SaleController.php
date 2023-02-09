<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Sale;
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

        return view('sale/form',compact('form','Cities', 'client'));
    }

  public function store(Request $request)
    {   
        
//         $input = Sale::create([
//             'client_id' => $request->client_id,
//             'seller_id' => $request->seller_id,
//             'payment_id' => $request->payment_id,
//             'company_id' => Auth::user()->company_id,
//             'total_sets' => $request->total_sets,
//             'total_amount' => $request->total_amount,
//             'total_profit' => $request->total_profit,
//             'client_balance' => $request->client_balance,
//         ]);
//         $total_profit = 0;
//         $sale_items = [];

//         if($input['user_type']=='WC'){
//             $person = Person::create($input);

//             $user = $person->user()->create($input);

//             $client = $user->client()->create($input);

//             $input['client_id'] = $client['id'];
//         }

//         foreach($input['product_id'] as $key => $item){
//             $product = Product::find($input['product_id'][$key]);
//             $profit = ($input['price_per_unit'][$key]-$product['purchase_price'])*$input['quantity'][$key];
//             $total_profit+=$profit;

//             $sale_items[] = [
//                 'product_id' => $input['product_id'][$key],
//                 'price_per_unit' => $input['price_per_unit'][$key],
//                 'quantity' => $input['quantity'][$key],
//                 'sub_total' => $input['sub_total'][$key],
//                 'profit' => $profit,
//             ];
// $result=$input['sub_total'];
//     $sum=0;        
// for($i=0;$i<count($result);$i++)
// {
//     $sum=$sum+$result[$i];
// }
//             // update stock
//             $product->decrement('current_stock',$input['quantity'][$key]);
//         }
        
//         // Client balance update check
//         $client = Client::find($input['client_id']);
//         $balance = $input['total_amount']-$input['payment'];
//         if($balance>0){
//             $client->increment('current_bal',$balance);
//         }

//         // Add payment
//         if($input['payment']>0){
//             $payment_input = [
//                 'receiver_id' => $input['seller_id'],
//                 'payer_id' => $client['user_id'],
//                 'date' => Carbon::Now(),
//                 'transaction_mode' => 'Cash',
//                 'amount' => $input['payment'],
//                 'remarks' => 'Payment with sale.',
//             ];
//             $payment = Payment::create($payment_input);

//             $input['payment_id'] = $payment['id'];
//             // dd($input['payment_id']);
//             $pay=Payment::where('id',$input['payment_id'])->first();
//             // dd($pay->amount);
//         }
        
//         $input['total_profit']=$total_profit;
//         $input['client_balance']=$client['current_bal'];
//         $Sale = Sale::create($input);
        
//         $Sale->items()->createMany($sale_items);

//         $request->session()->flash('message.level', 'success');
//         $request->session()->flash('message.content', 'Sale Successfully Created !');
//         $request->session()->flash('message.link', 'sale/'.$Sale->id);
//         $user_ph=Person::where('id',$client['user_id'])->first();
//         $number=$user_ph->mobile_no;
//         // dd($number);
//         $user=Person::where('id',$client['user_id'])->first();

//       $message="Dear ".$user->first_name.",\nBill No:".$Sale->id."\nBill Amount: ".$sum."Rs\nOld Balance:".$balance."Rs\nNew Balance: ".$client->current_bal."Rs\nFrom: ZR Erorex\nThanks";
        
//         $sms=HelperFunction::send_sms($number,$message);  

//         return redirect('sale');


        
$input =  $request->all();



$total_profit = 0;
$sale_items = [];

// if($input['user_type']=='WC'){
//     $person = Person::create($input);

//     $user = $person->user()->create($input);

//     $client = $user->client()->create($input);

//     $input['client_id'] = $client['id'];
// }

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
$client = User::find($input['client_id']);

$balance = $input['total_amount']-$input['payment'];
if($balance>0){
    $client->increment('current_bal',$balance);
}

// Add payment
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
    // dd($input['payment_id']);
    $pay=Payment::where('id',$input['payment_id'])->first();
    // dd($pay->amount);
}

$input['total_profit']=$total_profit;
$input['client_balance']=$client['current_bal'];
$Sale = Sale::create($input);
$update=Sale::where('id',$Sale->id)->first();
$update->company_id= Auth::user()->company_id;
$update->save();
$Sale->items()->createMany($sale_items);

$request->session()->flash('message.level', 'success');
$request->session()->flash('message.content', 'Sale Successfully Created !');
$request->session()->flash('message.link', 'sale/'.$Sale->id);
    // $user_ph=User::where('id',$client['user_id'])->first();
    // $number=$user_ph->mobile_no;
// dd($number);
// $user=User::where('id',$client['user_id'])->first();

// $message="Dear ".$user->first_name.",\nBill No:".$Sale->id."\nBill Amount: ".$sum."Rs\nOld Balance:".$balance."Rs\nNew Balance: ".$client->current_bal."Rs\nFrom: ZR Erorex\nThanks";

// $sms=HelperFunction::send_sms($number,$message);  

return redirect('sale');
}

    

    public function show($id)
    {   
        $Sale = Sale::with('items.product','client','seller','payment')->find($id);
        
        return view('sale/print', compact('Sale'));
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
        
        return view('sale/form',compact('form','Sale','Cities'));
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
        
        // delete old items
        foreach ($old_items as $key => $item) {
            // add product back to stock
            $product = Product::find($item['product_id']);
            $new_stock = $product['current_stock']+$item['quantity'];
            $product->update(['current_stock'=>$new_stock]);

            // delete item
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


        // Client balance update check
        if($Sale['payment']!=null){
            $previous_bill = $Sale['total_amount']-$Sale['payment']['amount'];  
        }
        else{
            $previous_bill = $Sale['total_amount'];
        }
        //return $previous_bill;
        if($previous_bill!=null){
            $client->decrement('current_bal',$previous_bill);
        }
        $Sale->payment()->delete();

        // Payment Update
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
        //  return redirect('ud');
        $Sale=Sale::findOrFail($id);
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
}