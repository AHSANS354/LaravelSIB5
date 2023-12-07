<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Alert;

class ShopController extends Controller
{
    //
    public function index()
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();
        return view('shop', compact('produk'));
    }

    public function cart()
    {
        // panggil produk yang di cart
        $produk = Produk::all();
        $cart = session()->get('cart');
        //hitung total harga
        $total = 0;
        if($cart){
            foreach ($cart as $item => $produk) {
                $total += $produk['harga_jual'] * $produk['quantity'];
            }
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                // 'order_id' => $products->id,
                'order_id' => rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('cart', compact('snapToken','total','cart'));
        }
        return view('shop', compact('produk'));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $produk = Produk::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nama" => $produk->nama,
                "quantity" => 1,
                "harga_jual" => $produk->harga_jual,
                "foto" => $produk->foto
            ];
        }
        toast('Berhasil ditambahkan ke Cart!', 'success');
        session()->put('cart', $cart);
        return redirect()->back();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            toast('Berhasil update Cart!', 'success');
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
