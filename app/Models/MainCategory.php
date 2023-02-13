<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
  /**
   * Validation rules.
   *
   * @var array
   */
  public static $rules = [
    'name' => ['required','string'],
    // 'company_id' => ['required','string'],
  ];


    protected $fillable = [
       'name',
       'company_id'
     ];

    public function subcategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }
}
