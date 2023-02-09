<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  	'country_id', 
  	'name'
  ];

  /**
   * Validation rules.
   *
   * @var array
   */
  public static $rules = [
  	'country_id' => ['required','numeric'],
	  'name' => ['required','string']
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
	public function country(){
  	return $this->belongsTo('App\Models\Country');
	}  

  /**
   * One to Many Relationship.
   *
   * @var array
   */
  public function cities(){
    return $this->hasMany('App\Models\City');
  }  
}