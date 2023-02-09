<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
         'sub_category_id',
         
         'company_id',
        //  'name',
          'model',
         'purchase_price',
         'sale_price',
         'current_stock',
        //   'min_stock_value',
          'image',
          'comment',
      ];

      public static $rules = [
        'sub_category_id' => ['required','string'],
        // 'name'            => ['required','string'],
        'model'           => ['required','string'],
        'sale_price'      => ['nullable','numeric'],
        'min_stock_value' => ['nullable','numeric'],
        'image'           => ['nullable','image'],
        'comment'         => ['nullable','string'],
      ];

      public function sub_category(){
        return $this->hasMany('App\Models\SubCategory');
      }

    //   public function sales(){
    //     return $this->hasMany('App\Models\SaleItems');
    //   }
}
