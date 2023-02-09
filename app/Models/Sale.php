<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
    	'client_id', 
    	'seller_id',
        'payment_id',
        'company_id',
    	'total_sets',
    	'total_amount',
        'total_profit',
        'client_balance',
    ];

    public static $rules = [
    	'client_id'    => ['required'], 
    	'seller_id'    => ['required'],
        'total_sets'   => ['required'],
    	'total_amount' => ['required'],
        'total_profit' => ['nullable'],
        'client_balance' => ['nullable'],
	];

  	public function user(){
    	return $this->belongsTo('App\Models\User');
  	}

  	// public function seller(){
    // 	return $this->belongsTo('App\Models\User');
  	// }

    public function payment(){
        return $this->belongsTo('App\Models\Payment');
    }

    public function items(){
        return $this->hasMany('App\Models\SaleItem');
    }
}