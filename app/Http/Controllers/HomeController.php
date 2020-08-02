<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Spanduk;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $books = Book::where('status','PUBLISH')
                ->orderBy('views', 'DESC')
                ->limit(4)
                ->get();

        $spanduks = Spanduk::where('status', 'PUBLISH')
                    ->orderBy('id','DESC')
                    ->get();

        return view('home', ['books' => $books, 'spanduks' =>$spanduks]);
    }
}
