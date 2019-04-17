<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('layout.checkout')->with([
            'discount' => $this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax' => $this->getNumbers()->get('newTax'),
            'newTotal' => $this->getNumbers()->get('newTotal'),
           /*return view samen met deze data van cart in checkout*/


        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug.', '.$item->qty;
        })->values()->toJson();
        /*als item in checkout return data en hoeveelheid  */

        try {
          $charge = Stripe::charges()->create([
              'amount' => $this->getNumbers()->get('newTotal') / 100, /*price in centen gedeeld door 100*/
              'currency' => 'EUR', /*valuta*/
              'source' => $request->stripeToken, /*betaal api*/
              'description' => 'Order',
              'receipt_email' => $request->email,
              'metadata' => [

                  'contents' => $contents, /*geeft order detials door aan stripe*/
                  'discount' => collect(session()->get('coupon'))->toJson(), /*geeft order coupon door aan stripe*/
                  'quantity' => Cart::instance('default')->count(), /*geeft order hoeveelheid door aan stripe*/
              ],
          ]);

            Cart::instance('default')->destroy(); //maakt winkelmand leeg na succesvole betaling
            session()->forget('coupon');

            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!'); /*na correcte betaling haal data op uit controller confirmation*/
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage()); /*anders een error*/
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100; /*subtotal / 100*/
        $discount = session()->get('coupon')['discount'] ?? 0; /*get coupon*/
        $newSubtotal = (Cart::subtotal() - $discount); /*subtotal - korting*/
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax); /*total bedrag+tax*/

        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,


        ]);
    }


}
