@extends('layouts.global')

@section('title') All product @endsection

@section('content')
<form action="{{route('product.index')}}">
	<div class="row mb-3">
		<div  class="col-md-3">
			<select name="filter" id="keyword" class=form-control>
				<option value="" {{Request::get('filter') == NULL & Request::path() == 'product' ? "selected" : ""}}>All Product</option>
				<option value="terpopuler" {{Request::get('filter') == 'terpopuler' ? "selected" : ""}}>Terpopuler</option>
				<option value="terbaru" {{Request::get('filter') == 'terbaru' ? "selected" : ""}}>Terbaru</option>
				<option value="harga_terendah" {{Request::get('filter') == 'harga_terendah' ? "selected" : ""}}>Harga terendah</option>
				<option value="harga_tertinggi" {{Request::get('filter') == 'harga_tertinggi' ? "selected" : ""}}>Harga tertinggi</option>
			</select>
		</div>
		<div class="col-md-2">
			<input type="submit" value="Filter" class="btn btn-primary">
		</div>
		
	</div>
</form>
	<hr class="my-3">

	<div class="row">
		@foreach($books as $book)
		<div class="col-md-3 p-3">
			
			<div class="card">
				<a href="{{route('product.slug', ['slug' => $book->slug])}}">
				<img class="card-img-top img-fluid" src="{{asset('storage/'.$book->cover)}}" style="height: 300px">
				<div class="card-body">
					<p class="card-text">
						@php
		                    $text = $book->title;
		                    $limit = 24;
		                      if(strlen($text)>$limit){
		                        $word = mb_substr($text, 0,$limit). "...";
		                      }
		                      else {
		                        $word = $text;
		                      }
		                @endphp
		            
		                <b>{{$word}}</b>
						<br>
						<small class="text-muted">{{$book->publisher}}</small>
					</p>
				</a>
					<p class="card-text">Rp. {{$book->price}}</p>
				</div>
			</div>

		</div>
		@endforeach
	</div>

	<div class="row mb-3">
		<div class="col-md-12">
				{{$books->appends(Request::all())->links()}}	
		</div>
	</div>

@endsection