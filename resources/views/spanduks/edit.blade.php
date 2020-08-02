@extends('layouts.global')

@section('title') Edit Spanduk @endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form 
				enctype="multipart/form-data"
				method="POST"
				action="{{route('spanduks.update', ['id' => $spanduk->id])}}"
				class="p-3 shadow-sm bg-white">

				@csrf

				<input type="hidden" name="_method" value="PUT">

				<label for="name">Name</label><br>
				<input 
					type="text"
					class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" 
					name="name"
					value="{{old('name') ? old('name') : $spanduk->name}}">

				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br>

				<label for="image">Image</label><br>
				<small>Current cover</small><br>
				@if($spanduk->image)
					<img src="{{asset('storage/'. $spanduk->image)}}" width="96px">
				@endif
				<br><br>
				<input 
					type="file" 
					name="image"
					class="form-control {{$errors->first('image') ? "is-invalid" : ""}}">
				<small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>

				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br><br>

				<label for="slug">Slug</label><br>
				<input 
					type="text" 
					name="slug"
					class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}"
					value="{{old('slug') ? old('slug') : $spanduk->slug}}"
					placeholder="enter-a-slug">

				<div class="invalid-feedback">
					{{$errors->first('slug')}}
				</div>
				<br>
				
				<label for="creator">Creator</label>
				<input 
					type="text" 
					name="creator"
					class="form-control {{$errors->first('creator') ? "is-invalid" : ""}}"
					value="{{old('creator') ? old('creator') : $spanduk->creator}}">

				<div class="invalid-feedback">
					{{$errors->first('creator')}}
				</div>
				<br>
				<label for="categories">Categories</label>
				<select
					multiple
					class="form-control {{$errors->first('categories') ? "is-invalid" : ""}}"
					name="categories[]"
					id="categories">
					<option value="Kategori 1" {{in_array("Kategori 1", json_decode($spanduk->category)) ? "selected" : ""}}>Kategori 1</option>
				 	<option value="Kategori 2" {{in_array("Kategori 2", json_decode($spanduk->category)) ? "selected" : ""}}>Kategori 2</option>
				 	<option value="Kategori 3" {{in_array("Kategori 3", json_decode($spanduk->category)) ? "selected" : ""}}>Kategori 3</option>
				 	<option value="Kategori 4" {{in_array("Kategori 4", json_decode($spanduk->category)) ? "selected" : ""}}>Kategori 4</option>
				 	<option value="Kategory 5" {{in_array("Kategori 5", json_decode($spanduk->category)) ? "selected" : ""}}>Kategori 5</option>
				</select>

				<div class="invalid-feedback">
					{{$errors->first('categories')}}
				</div>
				<br><br>

				<label for="description">Description</label>
				<textarea
					name="description"
					id="description"
					class="form-control {{$errors->first('description') ? "is-invalid" : ""}}">
						{{old('description') ? old('description') : $spanduk->description}}
					</textarea>

				<div class="invalid-feedback">
					{{$errors->first('description')}}
				</div>
				<br>
				<label for="status">Status</label>
				<select 
					name="status"
					class="form-control {{$errors->first('status') ? "is-invalid" : ""}}">
						<option {{$spanduk->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">PUBLISH</option>
						<option {{$spanduk->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">DRAFT</option>
					</select>

				<div class="invalid-feedback">
					{{$errors->first('status')}}
				</div>
				<br>

				<button class="btn btn-primary" value="PUBLISH">Update</button>
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
		});
	</script>

@endsection