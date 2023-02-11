<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
     /**
     * Validation rules.
     *
     * @var array
     */
  public static $rules = [
   
    'name' => ['required','string'],
  ];

    protected $fillable = [ 
      'name', 
      'main_category_id',
      'company_id' 
    ];


    public function MainCategory()
    {
        return $this->belongsTo('App\Models\MainCategory');
    }
    public function products(){
        return $this->hasMany('App\Models\Product');
      }
}
