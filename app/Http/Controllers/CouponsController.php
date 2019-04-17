<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        /*haalt code op uit db*/


        if (!$coupon){
            return redirect()->route('checkout.index')->withErrors('invalid coupon code. please try again.');
        }
        /*als code al gebruikt is of niet werkt geeft error message*/

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal())
            ]);
        /*slaat gegevens coupon code op in session*/

        return redirect()->route('checkout.index')->with('success_message', 'Coupon has been applied.');
        /*geeft success message als coupon met success is verwerkt */
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        /*als geslaagde betaling destory coupon code*/

        return redirect()->route('checkout.index')->with('success_message', 'Coupon has been removed');
        /*als user coupon verwijderd geeft success message */
    }
}
