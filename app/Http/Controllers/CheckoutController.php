<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CheckoutController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){

    	$user = Auth::user();
    	
    	return view('checkout.index', ['user' => $user]);
    }
}
