<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Transiction;

class BankController extends Controller
{
    public function show_bank(){
       
        $bank = Bank::all();
        
    	return view('bank.Bank',compact('bank'));
    }
    
    
    public function create(Request $request){
       
        $form=[
            "value" => "add",
            "name" => "bank_name",
            "submit" => "Save"
        ];

            return view('bank.form',compact('form'));
        
        
    }

    public function store(Request $request){
       
        $Add_bank = new Bank;
    	$Add_bank->bank_name=$request->name;
    	$Add_bank->status=1;
        $Add_bank->bank_balance=0;
    	$Add_bank->save();
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'New Bank Successfully Created !');
        $request->session()->flash('message.link', 'bank/'.$Add_bank->id);
        return redirect('show_bank');
        
    }

    public function show(Request $request,$bank_id)
    {
        

        if($request->has('search'))
        {
            $from=$request->input('fdate');
            $to=$request->input('tdate'); 
            $showtranfilter=Transiction::where('bank_id',$bank_id)->whereBetween('trans_date', [$from, $to])->get();
            $totalcreditfilter=Transiction::where('bank_id',$bank_id)->where('trans_operator','+')->whereBetween('trans_date', [$from, $to])->sum('amount');
            $totaldebitfilter=Transiction::where('bank_id',$bank_id)->where('trans_operator','-')->whereBetween('trans_date', [$from, $to])->sum('amount');
            $totalbalfilter=$totalcreditfilter-$totaldebitfilter;
            return view('bank.balance_sheet',compact('totalcreditfilter','totaldebitfilter','totalbalfilter','showtranfilter','bank_id'));
        }
        $showtran=Transiction::where('bank_id',$bank_id)->get();
        $totalcredit=Transiction::where('bank_id',$bank_id)->where('trans_operator','+')->sum('amount');
        $totaldebit=Transiction::where('bank_id',$bank_id)->where('trans_operator','-')->sum('amount');
        $totalbal=$totalcredit-$totaldebit;
        
        return view('bank.balance_sheet',compact('showtran','totalcredit','totaldebit','totalbal','bank_id'));
        
    }


    public function edit($id)
    {
        // dd('edit');
        $bank=Bank::find($id);

        $form=[
            "value" => "update",
            "name" => "Update Country",
            "submit" => "Update"
        ];

        return view('bank/edit',compact('form','bank'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        // dd('good');
        $update_bank=Bank::find($id);

        $update_bank->bank_name = $request->name;

        $update_bank->update();
        

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Bank Successfully Updated!');
        $request->session()->flash('message.link', 'bank/'.$update_bank->id);
        
        return redirect('show_bank');
    }



    public function destroy(Request $request, $id)
    {
        // dd('good');
        $bank_del=Bank::findOrFail($id);
        $bank_del->delete();

        $request->session()->flash('message.level', 'error');
        $request->session()->flash('message.content', 'Record deleted!');
        
        return redirect('show_bank');
    }


    public function transiction($id)
    {
        // dd($id)

        $id = Bank::where('bank_id', $id)->first();

        // dd($id);

        return view('bank.transiction', compact('id'));
    }


    public function Add_Transiction(Request $request)
    {
       
        
        $Add_Transiction =new Transiction;
        $Add_Transiction->bank_id = $request->bank_id;
        $Add_Transiction->trans_operator=$request->trans_operator;
        $Add_Transiction->amount=$request->amount;
        $Add_Transiction->trans_date= $request->trans_date;
        $Add_Transiction->trans_description= $request->trans_description;
        $Add_Transiction->save();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Transiction Successfully Created!');
        $request->session()->flash('message.link', 'bank/'.$Add_Transiction->id);
        
        return redirect('show_bank');
        
    }



}
