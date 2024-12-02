<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    //
    public function ChangeCurrency($code){
        session()->get('currency');
        session()->forget('currency');
        Session::put('currency',$code);
        return redirect()->back();
    }
 
 
 
}
