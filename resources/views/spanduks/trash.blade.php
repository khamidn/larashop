@extends('layouts.global')

@section('title') Trashed Spanduks @endsection

@section('content')

@if(session('status'))
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			</div>
		</div>
	@endif

	<div class="row">
		<div class="col-md-6">
			<form action="{{route('spanduks.index')}}">
				<div class="input-group">
					<input 
						type="text" 
						name="keyword" 
						value="{{Request::get('keyword')}}" 
						class="form-control" 
						placeholder="Filter by name">
						<div class="input-group-append">
							<input type="submit" value="Filter" class="btn btn-primary">
						</div>
				</div>
				
			</form>
		</div>
		<div class="col-md-6">  
			<ul class="nav nav-pills card-header-pills">
				<li class="nav-item">
					<a class="nav-link {{Request::get('status') == NULL & Request::path() == 'spanduks' ? 'active' : ''}}" href="{{route('spanduks.index')}}">All</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{Request::get('status') == 'publish' ? 'active' : ''}}" href="{{route('spanduks.index', ['status' => 'publish'])}}">Publish</a>
				</li>
				<li class="nav-item">  
					<a class="nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}" href="{{route('spanduks.index', ['status' => 'draft'])}}">Draft</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{Request::path() == 'spanduks/trash' ? 'active' : ''}}" href="{{route('spanduks.trash')}}">Trash</a>
				</li>
			</ul>
		</div>
	</div>

	<hr class="my-3">


	<div class="row mb-3">
		<div class="col-md-12 text-right">
			<a 
				href="{{route('spanduks.create')}}"
				class="btn btn-primary">Create spanduk</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th><b>Image</b></th>
						<th><b>Name</b></th>
						<th><b>Creator</b></th>
						<th><b>Category</b></th>
						<th><b>Status</b></th>
						<th><b>Action</b></th>
					</tr>
				</thead>
				<tbody>
					@foreach($spanduks as $spanduk)
					<tr>
						<td>
							@if($spanduk->image)
								<img src="{{asset('storage/'. $spanduk->image)}}" width="96px">
							@endif
						</td>
						<td>{{$spanduk->name}}</td>
						<td>{{$spanduk->creator}}</td>
						<td>
							<ul class="pl-3">
								@foreach(json_decode($spanduk->category) as $category)
									<li>{{$category}}</li>
								@endforeach
							</ul>
						</td>
						<td>
							@if($spanduk->status == "DRAFT")
								<span class="badge badge-dark text-white">{{$spanduk->status}}</span>
							@else
								<span class="badge badge-success">{{$spanduk->status}}</span>
							@endif
						</td>
						<td>
							<form
								method="POST"
								action="{{route('spanduks.restore', ['id' => $spanduk->id])}}"
								class="d-inline">
								@csrf
								<input type="submit" value="Restore" class="btn btn-success">
							</form>

							<form
								onsubmit="return confirm('Move spanduk to trash?')"
								class="d-inline"
								method="POST"
								action="{{route('spanduks.delete-permanent', ['id' => $spanduk->id])}}">
								@csrf

								<input type="hidden" name="_method" value="DELETE">
								<input type="submit" value="Delete" class="btn btn-danger btn-sm">
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td>
							{{$spanduks->appends(Request::all())->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

@endsection