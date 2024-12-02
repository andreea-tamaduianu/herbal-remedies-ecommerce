<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function CurrencyView()
    {
        $currencies = Currency::all();
        return view('backend.currency.currency_view', compact('currencies'));
    }

    public function CurrencyStore(Request $request)
    {

        $request->validate([
            'currency_code' => 'required',
            'exchange_rate' => 'required',


        ]);


        Currency::insert([
            'currency_code' => $request->currency_code,
            'exchange_rate' => $request->exchange_rate,
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Currency inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 


    public function CurrencyEdit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('backend.currency.currency_edit', compact('currency'));
    }


    public function CurrencyUpdate(Request $request)
    {


        Currency::findOrFail($request->id)->update([
            'currency_code' => $request->currency_code,
            'exchange_rate' => $request->exchange_rate,


        ]);


        $notification = array(
            'message' => 'Currency updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('currency.manage')->with($notification);
    } // end method


    public function CurrencyDelete($id)
    {

        Currency::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Currency deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method 

    public function CurrencyInactive($id)
    {
        Currency::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Currency is now inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function CurrencyActive($id)
    {
        Currency::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Currency is now active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
