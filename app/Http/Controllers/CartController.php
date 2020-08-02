<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class CartController extends Controller
{
	public function index(){
        return view('cart.index');
    }

    public function addToCart($id){
        $book = Book::findOrFail($id);

        if(!$book){
            abort(404);
        }

        $cart = session()->get('cart');

        if(!$cart){
            $cart = [
                $id => [
                    "title" => $book->title,
                    "quantity" => 1,
                    "price" => $book->price,
                    "image" => $book->cover
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('status','Product added to cart successfully');
        }

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);

            return redirect()->back()->with('status', 'Product added to cart successfully');
        }

        $cart[$id] = [
            "title" => $book->title,
            "quantity" => 1,
            "price" => $book->price,
            "image" => $book->cover
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('status', 'Product added to cart successfully');
    }

    public function updateCart(Request $request){
        if($request->id and $request->quantity){
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);
            session()->flash('status', 'Cart updated successfully');
        }
    }

    public function removeCart(Request $request){
        if($request->id){
            $cart = session()->get('cart');

            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart',$cart);
            }

            session()->flash('status', 'Product removed successfully');
        }
    }
}
