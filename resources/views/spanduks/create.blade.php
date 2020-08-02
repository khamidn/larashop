@extends('layouts.global')

@section('title') Create spanduk @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form
				action="{{route('spanduks.store')}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadow-sm p-3 bg-white">

				@csrf

				<label for="name">Name</label><br>
				<input 
					type="text"
				 	name="name"
				 	class="form-control {{$errors->first('name') ? "is-invalid" : ""}}"
				 	placeholder="Name Spanduk"
				 	value="{{old('name')}}">

				 <div class="invalid-feedback">
				 	{{$errors->first('name')}}
				 </div>
				 <br>

				 <label for="image_spanduk">Image</label>
				 <input 
				 	type="file" 
				 	name="image"
				 	id="image"
				 	class="form-control {{$errors->first('image') ? "is-invalid" : ""}}">

				 <div class="invalid-feedback">
				 	{{$errors->first('image')}}
				 </div>

				  <small class="text-muted">For optimal results use 1920 x 768 pixel image dimensions</small>
				 <br>

				 <label for="creator">Creator</label>
				 <input 
				 	type="text" 
				 	name="creator"
				 	class="form-control {{$errors->first('creator') ? "is-invalid" : ""}}"
				 	placeholder="Nama Creator Spanduk"
				 	value="{{old('creator')}}">

				 <div class="invalid-feedback">
				 	{{$errors->first('creator')}}
				 </div>
				 <br>

				 <label for="categories">Category</label>
				 <select 
				 	name="categories[]"
				 	multiple
				 	id="categories"
				 	class="form-control {{$errors->first('categories') ? "is-invalid" : ""}}">
				 	<option value="Kategori 1">Kategori 1</option>
				 	<option value="Kategori 2">Kategori 2</option>
				 	<option value="Kategori 3">Kategori 3</option>
				 	<option value="Kategori 4">Kategori 4</option>
				 	<option value="Kategory 5">Kategori 5</option>
				 </select>

				 <div class="invalid-feedback">
				 	{{$errors->first('categories')}}
				 </div>
				 <br><br>

				 <label for="description">Description</label>
				 <textarea
				 	class="form-control {{$errors->first('description') ? "is-invalid" : ""}}"
				 	name="description"
				 	id="description"
				 	placeholder="Give a description about this spanduk">{{old('description')}}</textarea>

				 <div class="invalid-feedback">
				 	{{$errors->first('description')}}
				 </div>
				 <br><br>

				 <button 
				 	class="btn btn-primary" 
				 	name="save_action" 
				 	value="PUBLISH">
				 	Publish
				 </button>

				 <button 
				 	class="btn btn-secondary" 
				 	name="save_action" 
				 	value="DRAFT">
				 	Save as draft
				 </button>
			</form>
		</div>
	</div>
@endsection

@section('footer-scripts')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

	<script>
		$(document).ready(function() {
			$('#categories').select2();
		})
	</script>

@endsection