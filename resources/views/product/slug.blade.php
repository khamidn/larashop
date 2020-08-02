@extends('layouts.global')

@section('title')  Product @endsection

@section('content')
	@if(session('status'))
		<div class="row">
			<div class="col-md-9">
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			</div>
		</div>
	@endif

	<div class="row mb-3">
		<div class="col-md-4">
			<img class="img-responsive"src="{{asset('storage/'.$book->cover)}}" height=" 421px" width= "328px">
		</div>

		<div class="col-md-5">
			<div class="card">
				<div class="card-body">
					<h1 class="card-title">{{$book->title}}</h1>
					<h3 class="card-title text-muted">{{$book->author}}</h3>
					<h5 class="card-title">Rp. {{$book->price}}</h5>
					
					<hr class="my-3">
					<table class="table table-borderless">
						<tbody>
							<tr>
								<th><b>Publisher</b></th><td>{{$book->publisher}}</td>
							</tr>
							<tr>
								<th><b>Weight</b></th><td>{{$book->weight}} Kg</td>
							</tr>
							<tr>
								<th><b>Stock</b></th><td>{{$book->stock}}</td>
							</tr>
						</tbody>
					</table>
					<small class="text-muted">Categories: 
						@foreach($book->categories as $category)
							{{$category->name}} /
						@endforeach
					</small>
					<div class="text-center p-1">
						<a href="{{route('cart.add',['id' =>$book->id])}}" class="btn btn-primary">Beli Sekarang</a>	
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-9">
			<div class="card">
				<div class="card-body">
					<p class="card-title text-muted">Deskripsi</p>
					<p class="card-text">
						{{$book->description}}
					</p>
				</div>
			</div>
		</div>
	</div>

@endsection