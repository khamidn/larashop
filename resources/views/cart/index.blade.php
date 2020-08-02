@extends('layouts.global')

@section('title') Cart list @endsection

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
		<div class="col-md-12">
			<table id="cart" class="table table-hover table-considensed">
				<thead>
					<tr>
						<th width="40%">Product</th>
						<th width="10%">Price</th>
						<th width="8%">Quantity</th>
						<th width="22%" class="text-center">Subtotal</th>
						<th width="20%"></th>
					</tr>
				</thead>
				<tbody>

					@php $total = 0 @endphp

					@if(session('cart'))
						@foreach(session('cart') as $id =>$details)
							@php $total += $details['price'] * $details['quantity'] @endphp
							<tr>
								<td data-th="Product">
									<div class="row">
										<div class="col-sm-4 hidden-xs">
											<img src="{{asset('storage/'. $details['image'])}}" width="109" height="140" class="img-responsive">
										</div>
										<div class="col-sm-8">
											<h4 class="nomargin">{{$details['title']}}</h4>
											{{-- <p>
												Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.
											</p> --}}
										</div>
									</div>
								</td>
								<td data-th="Price">Rp. {{$details['price']}}</td>
								<td data-th="Quantity">
									<input type="number" min=1 class="form-control quantity" value="{{$details['quantity']}}">
								</td>
								<td data-th="Subtotal" class="text-center">Rp. {{$details['price']*$details['quantity']}}</td>
								<td class="actions" data-th="">
									<button class="btn btn-info btn-sm update-cart" data-id="{{$id}}">Refresh</button>
									<button class="btn btn-danger btn-sm remove-from-cart" data-id="{{$id}}">Hapus</button>
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
				<tfoot>
					<tr>
						<td><a href="{{route('product.index')}}" class="btn btn-warning">Continue shopping</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td class="hidden-xs text-center"><strong>Total Rp. {{$total}}</strong></td>
						<td><a href="{{route('checkout.index')}}" class="btn btn-primary btn-block">Checkout</a></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

@endsection

@section('footer-scripts')
	<script type="text/javascript">
		$(".update-cart").click(function(e){
			e.preventDefault();

			var ele = $(this);

			$.ajax({
				url:'{{route('cart.update')}}',
				method: "patch",
				data: {
					_token: '{{ csrf_token() }}', 
					id: ele.attr("data-id"), 
					quantity: ele.parents("tr").find(".quantity").val()
				},
				success: function(response){
					window.location.reload();
				}
			});
		});

		$(".remove-from-cart").click(function (e) {
			e.preventDefault();

			var ele = $(this);

			if(confirm("Are you sure")) {
					$.ajax({
	                    url: '{{ route('cart.remove') }}',
	                    method: "DELETE",
	                    data: {
	                    	_token: '{{ csrf_token() }}', 
	                    	id: ele.attr("data-id")
	                    },
	                    success: function (response) {
	                        window.location.reload();
                    }
                });
			}
		});
	</script>
@endsection