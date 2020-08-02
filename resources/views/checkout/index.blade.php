@extends('layouts.global')

@section('title') Checkout @endsection

@section('content')
	<div class="row">
		
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Pengiriman</h5>
					<hr class="my-3">
					<div class="card-text">
						<label>Nama Penerima</label>
						<p class="text-muted">{{$user->name}}</p>

						<label>Alamat</label>
						<p class="text-muted">{{$user->address}}</p>

						<label>No. Telepon</label>
						<p class="text-muted">{{$user->phone}}</p>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Ringkasan pemesanan</h5>
					<hr class="my-3">
					<div class="table-wraper-scroll-y my-custom-scrollbar">
						<table class="table table-bordered table-striped-scrollbar">
							<tbody>
								@php 
									$substotal = 0; 
									$ongkir = 0;
									$asurasi = 0;
									$total = 0;
								@endphp
								@foreach(session('cart') as $id => $details)
									@php 
										$substotal += $details['price'] * $details['quantity'];
										$total = $substotal + $ongkir + $asurasi;
									@endphp
									<tr>
										<td>
											<img src="{{asset('storage/'.$details['image'])}}" width="109" height="140" class="img-responsive"><br>
											<b>{{$details['title']}}</b><br>
											{{-- <small class="text-muted">Nama Penulis</small> --}}
											<br>
											<b>Jumlah: {{$details['quantity']}}</b><b class="ml-5 text-info">Rp. {{$details['price']}}</b>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<hr class="my-3">
					<table class="table table-bordeless">
						<body>
							<tr>
								<th><b>Substotal</b></th><td>Rp. {{$substotal}}</td>
							</tr>
							<tr>
								<th><b>Biaya Kirim</b></th><td>Rp. 0</td>
							</tr>
							<tr>
								<th><b>Biaya Asuransi</b></th><td>Rp. 0</td>
							</tr>
							<tr class="text-info">
								<th><h5>Total</h5></th><td>Rp. {{$total}}</td>
							</tr>
						</body>
					</table>

					<div class="card-text">
						<a href="#" class="btn btn-primary btn-block">Bayar sekarang</a>
					</div>
				</div>
				
			</div>
		</div>
	</div>

@endsection

<style type="text/css">
	.my-custom-scrollbar{
		position:relative;
		height: 200px;
		overflow: auto;
	}

	.table-wraper-scroll-y {
		display: block;
	}

</style>