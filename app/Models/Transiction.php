<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transiction extends Model
{
    use HasFactory;
    protected $primaryKey = 'trans_id';
    public $timestamps = false;
    protected $table='transictions';
    protected $fillable = [
        'trans_id',
        'client_id',
        'bank_id',
        'sale_id',
        'trans_date',
        'trans_operator',
        'amount',
        'trans_description'
        

    ];



}
