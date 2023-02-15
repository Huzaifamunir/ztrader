<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transiction;
use App\Models\User;
use App\Models\City;
use PDF;
class LedgerController extends Controller
{
    public function index(Request $request,$id)
    {
        
        if($request->has('download'))
        {
            
        }
        $user = User::where('id', $id)->first();
        $city = City::where('id', $user->city_id)->first();
        $id=$id;
        if($request->has('search'))
        {
            $from=$request->input('fdate');
            $to=$request->input('tdate'); 
            $showtranfilter=Transiction::where('client_id',$id)->whereBetween('trans_date', [$from, $to])->get();
            $totalcreditfilter=Transiction::where('client_id',$id)->where('trans_operator','+')->whereBetween('trans_date', [$from, $to])->sum('amount');
            $totaldebitfilter=Transiction::where('client_id',$id)->where('trans_operator','-')->whereBetween('trans_date', [$from, $to])->sum('amount');
            $totalbalfilter=$totalcreditfilter-$totaldebitfilter;
            return view('ledger.index',compact('totalcreditfilter','totaldebitfilter','totalbalfilter','showtranfilter','id', 'user', 'city'));
        }
        $showtran=Transiction::where('client_id',$id)->get();
        $totalcredit=Transiction::where('client_id',$id)->where('trans_operator','+')->sum('amount');
        $totaldebit=Transiction::where('client_id',$id)->where('trans_operator','-')->sum('amount');
        $totalbal=$totalcredit-$totaldebit;
        view()->share(['id'=>$id,'user'=>$user,'showtran'=>$showtran,'totalcredit'=>$totalcredit,'totalbal'=>$totalbal,'city'=>$city,'totaldebit'=>$totaldebit]);
        if($request->has('download'))
        {
            $pdf = PDF::loadView('ledger.index');
            return $pdf->download('pdfview.pdf');
        }
        
        return view('ledger.index');
    }

  
}
