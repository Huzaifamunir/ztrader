<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
       return view('client.index');
    }
}
