<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'shippingdate',
        'containernum',
        'biltynum',
        'qty',
        'product',
        'length',
        'height',
        'width',
        'weight',
        'shipping',
        'tax',
        't_fair',
    ];
}
