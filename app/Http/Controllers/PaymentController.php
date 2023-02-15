<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Redirect;
use App\Models\Client;
use App\Models\Person;
use App\Models\Voucher;
use App\Models\Payment;
use App\Models\Bank;
use App\Models\Transiction;
use Illuminate\Http\Request;
use App\core\HelperFunction;

class PaymentController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i=1;
        $Payments = Payment::where('company_id',Auth::user()->company_id)->orderBy('updated_at','desc')->get();

        
        
        return view("payment/index", compact("Payments","i"));
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
            "name" => "Add Payment",
            "submit" => "Save"
        ];
        $banks=Bank::all();
        
        $clients_list = User::role('Client')->where('company_id', '=', Auth::user()->company_id)->get();        

        return view('payment/form',compact('form','clients_list','banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
       

$bank_name=Bank::where('bank_id',$request->transaction_mode)->first();
        $add_tra=Transiction::create([
            'bank_id'=>$request->transaction_mode,
            'trans_date'=>date('y-m-d'),
            'trans_operator'=>'+',
            'amount'=>$request->amount,
            'trans_description'=>$bank_name->bank_name,
            'client_id'=>$request->client_id,
        ]);

        $client = $request->client_id;
        

        $input = $request->all();
  

        $client = User::find($request->client_id);

        $user = $client->id;

        if($client['current_bal']<$input['amount']){

            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'You cannot pay more than '.$client['current_bal']);

            return redirect::back();                        
        }

        $new_bal = $client['current_bal']-$input['amount'];
       
        $client->update(['current_bal' => $new_bal]);

        
        $Payment = Payment::create($input);

        $update=Payment::where('id',$Payment->id)->first();
        $update->payer_id=$request->client_id;
        $update->save();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'New Record Successfully Created !');
        $request->session()->flash('message.link', 'payment/'.$Payment->id);
        $cli=User::where('id',$input['client_id'])->first();
        $user=User::where('id',$cli->id)->first();
        
        $number=$user->mobile_no;
      $message="Dear ".$user->first_name.",\nWe Have Received: ".$input['amount']."Rs\nNew Balance:".$new_bal."Rs\nFrom: ZR Erorex\nThanks";
        
        $sms=HelperFunction::send_sms($number,$message);  
        
        return redirect('payment');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $Payment=Payment::find($id);
     
        $balance = User::role('Client')->where('id', $Payment->payer_id)->first();
        
        return view('payment/single', compact('balance', 'Payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {   

        // dd($payment->id);
        $form=[
            "value" => "update",
            "name" => "Edit Payment",
            "submit" => "Save"
        ];

        $clients_list = User::role('Client')->where('company_id', Auth::user()->company_id)->get();
        $banks = Bank::all();

        return view('payment/form',compact('form','clients_list','payment', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {   
        $input = $request->all();
        
        $client = User::find($input['client_id']);
        $user = $client->user;
        
        // Remove old payment
        $new_bal = $client['current_bal']+$payment['amount'];
        $client->update(['current_bal' => $new_bal]);
        
        // Client current balance update
        if($client['current_bal']<$input['amount']){
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'You cannot pay more than '.$client['current_bal']);

            return redirect::back();                        
        }

        $new_bal = $client['current_bal']-$input['amount'];
        $client->update(['current_bal' => $new_bal]);
        
        // $input['payer_id'] = $user['id'];

        $payment->update($input);

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'New Record Successfully Created !');
        $request->session()->flash('message.link', 'payment/'.$payment->id);

        return redirect('payment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment,Request $request)
    {   
        
        $payment=Payment::findOrFail($payment->id);
        $update_current_bal=User::where('id',$payment->payer_id)->first();
        // dd($update_current_bal->current_bal);
        $bal=$update_current_bal->current_bal + $payment->amount;
        
        $update_current_bal->current_bal=$bal;
        $update_current_bal->save();
        $payment->delete();

        $request->session()->flash('message.level', 'error');
        $request->session()->flash('message.content', 'Record deleted!');

        return redirect('payment');
    }

    /**
     * Search the specified resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {   
        $input = $request->all();
        if($request['column']=='id'){
            $input['keyword'] = str_replace('ZR_00','',$input['keyword']);
            $input['keyword'] = str_replace('ZR_0','',$input['keyword']);
            $input['keyword'] = str_replace('ZR_','',$input['keyword']);
        }

        $Payments = Payment::where($input['column'], 'LIKE', "%".$input['keyword']."%")->paginate(10);
        
        return view("payment/index", compact("Payments"));
    }
}