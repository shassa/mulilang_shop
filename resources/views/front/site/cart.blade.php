@extends('layouts.site')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box" style="padding-left: 20%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main" style="padding-left: 20%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive ">
                        <table class="table thead-dark">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>SubTotal</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @php $total = 0 @endphp
                                 @if(session('cart'))
                                 @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id={{ $id }}>
                                    <td class="thumbnail-img">
                                        <a href="#">
                                       <img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/>
                                    	</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									{{ $details['name'] }}
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>${{ $details['price'] }}</p>
                                    </td>
                                    <td class="quantity-box">
                                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />

                                    </td>
                                    <td class="total-pr">
                                        <p> ${{  $details['quantity'] * $details['price']}}</p>
                                    </td>
                                    <td class="remove-pr">
                                        <button class="btn btn-danger btn-sm remove-from-cart">                                            <i class="zmdi zmdi-delete zmdi-hc-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                 @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4> Total price </h4>
                            <div class="ml-auto font-weight-bold"> $ {{$total}} </div>
                        </div>
                        <div class="d-flex">
                            <h4>Tax</h4>
                            <div class="ml-auto font-weight-bold"> $ 2 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Shipping Cost</h4>
                            <div class="ml-auto font-weight-bold"> Free </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> ${{$total +2}} </div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
@endsection


@section('script')
<script type="text/javascript">

    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>
@endsection
