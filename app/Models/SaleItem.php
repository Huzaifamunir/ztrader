<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_id', 
      'product_id',
        'price_per_unit',
      'quantity',
      'sub_total',
      'profit',
  ];

  /**
   * Validation rules.
   *
   * @var array
   */
  public static $rules = [
      'product_id' => 'required|numeric',
    'price_per_unit' => 'required|numeric',
    'quantity' => 'required|numeric',
    'sub_total' => 'required|numeric',
    'profit' => 'nullable',
  ];

  /**
      * Remove Default Timestamps.
      *
      */
  public $timestamps = false;

    /**
   * Many to One Relationship.
   *
   * @var array
   */
    public function sale(){
      return $this->belongsTo('App\Models\Sale');
    }

    public function product(){
    return $this->belongsTo('App\Models\Product','product_id');
  }
}
