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
use Illuminate\Http\Request;
use App\Core\HelperFunction;

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
        // if($request->ajax()){
        //     //$books = App\Book::with(['author', 'publisher'])->get();
        //     $Payments=Payment::with(['person'])->get();

        //     return $Payments;
        // }
        $i=1;
        $Payments = Payment::orderBy('updated_at','desc')->get();

        // $bank = Bank::where('bank_name', )->get();
        
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
        // dd($request->all());

        $client = $request->client_id;
        // dd($client);

        $input = $request->all();

        // $input = Payment::create([
        //     'receiver_id' => $request->receiver_id,
        //     'payer_id' => $request->client_id,
        //     'transaction_mode' => $request->transaction_mode,
        //     'amount' => $request->amount,
        //     'remarks' => $request->remarks,
        //     'company_id' => Auth::user()->company_id,
        //     'payer_id' => $request->payer_id,
        // ]);

        // dd($input);

        $client = User::find($request->client_id);

        // dd($client);

        $user = $client->id;

        // dd($user);

        
        // Client current balance update
        if($client['current_bal']<$input['amount']){

            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'You cannot pay more than '.$client['current_bal']);

            return redirect::back();                        
        }

        $new_bal = $client['current_bal']-$input['amount'];

        // dd($new_bal);
       
        $client->update(['current_bal' => $new_bal]);
        
        // $input['payer_id'] = $user['id'];
        
        $Payment = Payment::create($input);

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
        $Payment=Payment::with('payer.client')->find($id);
        
        return view('payment/single')->with(['Payment'=>$Payment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {   
        $form=[
            "value" => "update",
            "name" => "Edit Payment",
            "submit" => "Save"
        ];

        $clients_list = Client::all();        

        return view('payment/form',compact('form','clients_list','payment'));
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
        
        $client = Client::find($input['client_id']);
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
        
        $input['payer_id'] = $user['id'];

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
    public function destroy(Payment $payment)
    {   
        
        return redirect('ud');
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