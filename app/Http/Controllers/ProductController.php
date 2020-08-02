<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {

        $filter = $request->get('filter');

        if($filter == 'terpopuler'){
            $books = Book::where('status', 'PUBLISH')->orderBy('views','DESC')->paginate(12);
            return view('product.index', ['books' => $books]);
        }

        elseif ($filter == 'terbaru') {
            $books = Book::where('status', 'PUBLISH')->orderBy('created_at','DESC')->paginate(12);
            return view('product.index', ['books' => $books]);
        }

        elseif ($filter == 'harga_terendah') {
            $books = Book::where('status', 'PUBLISH')->orderBy('price','ASC')->paginate(12);
            return view('product.index', ['books' => $books]);
        }

        elseif ($filter == 'harga_tertinggi') {

            $books = Book::where('status','PUBLISH')->orderBy('price','DESC')->paginate(12);
            return view('product.index', ['books' => $books]);
        }

        else {

            $books = Book::where('status', 'PUBLISH')->paginate(12);
            return view('product.index', ['books' => $books]);
        }

        
    }

    public function slug($slug){
        $book = Book::where('slug',$slug)
                ->with('categories')
                ->first();
        return view('product.slug', ['book' =>$book]);
    }

    



    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
