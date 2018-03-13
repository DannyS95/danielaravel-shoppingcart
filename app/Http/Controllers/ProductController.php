<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Mockery\Exception;
use Session;
use App\Cart;
use Stripe\Charge;
use Stripe\Stripe;
use App\Order;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->add($product, $product->id);

        Session::put('cart', $cart);

        return redirect('/');
    }

    public function getShoppingCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shoppingCart', ['products' => $cart->items, 'totalPrice' =>
            $cart->totalPrice]);

    }

    public function reduceQty($id)
    {
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->reduce($id);
        Session::put('cart', $cart);
        $this->clearCartIfEmpty($cart);

        return redirect()->route('shopping_cart');
    }

    function removeItem($id)
    {
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->removeItem($id);
        $this->clearCartIfEmpty($cart);

        return redirect()->route('shopping_cart');
    }

    public function verifyCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function sendCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return view('shop.shoppingCart');
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);

        try {
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            Stripe::setApiKey("sk_test_WHKhbRFEMikAIwheXMOO4syW");

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $_POST['stripeToken'];
            // Charge the user's card:
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "description" => "My app charging your cash",
                "source" => $token,

            ));

            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->address;
            $order->name = $request->name;
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
        } catch (Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');

        return redirect()->route('products')->with('success', 'Purchase Successful.');
    }

    public function clearCartIfEmpty(Cart $cart)
    {
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
    }
}
