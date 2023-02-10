<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='banks';
    protected $primaryKey='bank_id';
    protected $fillable = [
        'bank_id',
        'bank_name',
        'balance',
        'status'
    ];



}