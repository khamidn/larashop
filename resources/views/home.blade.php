@extends('layouts.global')

@section("title") Home @endsection

@section('content')

  <style>
   
    .carousel-inner img {
      width: 100%;
      height: 350px;
    }
  </style>

  <div class="row">
      <div class="col-md-12">
          <div id="demo" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                  @foreach($spanduks as $key => $data)
                    <li data-target="#demo" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                  @endforeach
                </ul>

                <div class="carousel-inner">
                  @foreach($spanduks as $key => $spanduk)
                    <div class="carousel-item {{$key  == 0 ? 'active' : ''}}">
                      <img 
                          src="{{asset('storage/'.$spanduk->image)}}" 
                          alt="{{$spanduk->slug}}"
                          width="1100px" 
                          height="500px">
                    </div>
                  @endforeach
                  
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
          </div>
      </div>
  </div>
  <hr class="my-3">


  <h5 class="text-muted">Paling sering dilihat</h5>
  <div class="row">
      @foreach($books as $book)
      <div class="col-md-3">
          <div class="card">
            <a href="{{route('product.slug',['slug' => $book->slug])}}">
              <img class="card-img-top img-fluid" src="{{asset('storage/'. $book->cover)}}">
              <div class="card-body">
                <p class="card-text">
                  @php
                    $text = $book->title;
                    $limit = 25;
                      if(strlen($text)>$limit){
                        $word = mb_substr($text, 0,$limit). "...";
                      }
                      else {
                        $word = $text;
                      }
                  @endphp
            
                  <b>{{$word}}</b>
                </p>
            </a>
                <p class="card-text">Rp. {{$book->price}}</p>
              </div>
          </div>
      </div>
      @endforeach
  </div>

@endsection




