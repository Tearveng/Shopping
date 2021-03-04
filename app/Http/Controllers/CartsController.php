<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $value = DB::table('carts')->pluck('price');
        $qty = DB::table('carts')->pluck('qty');
        $total[count($value)] = 0;

        $vat = 0;

        $ship = 2;

        for ($i = 0; $i < count($value); $i++) {
            $total[$i] = $value[$i] * $qty[$i];

            $vat +=$total[$i];
        }


        $totalVat = $vat * 0.1;
        $totalPro = $totalVat + $vat + $ship;

        return view('carts.index')
            ->with('carts', (auth()->user())? auth()->user()->carts: Cart::all())
            ->with('subTotal', $vat)
            ->with('vat', $totalVat)
            ->with('total', $totalPro);
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
    public function store(AddToCartRequest $request)
    {
        

        $cart1 = DB::table('carts')->pluck('title');

        $cartQty = DB::table('carts')->pluck('qty');

        $id = DB::table('carts')->pluck('id');

        $user_id = DB::table('carts')->pluck('user_id');

        $cart2 = DB::table('carts')->pluck('option');

        for ($i = 0; $i < count($cart1); $i++) {
            if ($cart1[$i] == $request->title && $cart2[$i] == $request->option && $user_id[$i] == auth()->user()->id) {
                $cartQty[$i] += $request->qty;

                $cart = Cart::find($id[$i]);

                $cart->update([
                    'qty' => $cartQty[$i]
                ]);

                Alert::success('Your Add To Cart Successfully');

                return redirect()->back();
            }
        }

        auth()->user()->carts()->create([
            'user_id' =>auth()->user()->id,
            'image' => $request->image,
            'title' => $request->title,
            'qty' => $request->qty,
            'option' => $request->option,
            'price' => $request->price,
        ]);

        Alert::success('Your Add To Cart Successfully');

        return redirect()->back();
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
    public function destroy(Cart $cart)
    {
        $cart->forceDelete();

        return redirect()->back();
    }
}
