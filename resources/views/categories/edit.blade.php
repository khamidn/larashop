@extends('layouts.global')

@section('title') Edit Category @endsection

@section('content')
	<div class="col-md-8">
		@if(session('status'))
			<div class="alert alert-success">
				{{session('status')}}
			</div>
		@endif

		<form
			action="{{route('categories.update',['id' =>$category->id])}}"
			enctype="multipart/form-data"
			method="POST"
			class="bg-white shadows-sm p-3">

			@csrf

			<input 
				type="hidden" 
				name="_method"
				value="PUT">

			<label>Category name</label><br>
			<input 
				type="text" 
				name="name" 
				class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" 
				value="{{old('name') ? old('name') : $category->name}}">

			<div class="invalid-feedback">
				{{$errors->first('name')}}
			</div>
			<br><br>

			<label>Category slug</label>
			<input 
				type="text" 
				name="slug" 
				class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}" 
				value="{{old('slug') ? old('slug') : $category->slug}}">
			
			<div class="invalid-feedback">
				{{$errors->first('slug')}}
			</div>
			<br><br>

			<label>Category image</label>
			@if($category->image)
				<span>Current image</span><br>
				<img src="{{asset('storage/'.$category->image)}}" width="120px">
				<br><br>
			@endif
			<input 
				type="file" 
				name="image" 
				class="form-control">
			<small>Kosongkan jika tidak ingin mengubah gambar</small>
			<br><br>

			<input type="submit" class="btn btn-primary" value="Update">
			
		</form>
	</div>

@endsection