@extends('layouts.site')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box" style="padding-left: 20%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Wishlist</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site')}}">Shop</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
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
                    <div style="float:right; margin-top:-100px">
                     <form method="POST" action="{{route('wishlist.store')}}">
                        @csrf

                        <input name="name" id="listname" type="text" style="display: none" class="search_query ui-autocomplete-input form-control" placeholder="Enter wishlist name">

                        <button class="btn btn-secondary effect-btn" type="submit" style="float: right;color:white" id="addwishlist">Add Wishlist</button>
                     </form>
                    </div>
                    @foreach ($wishlists as $wishlist )

                    <div class="table-main table-responsive ">
                        <h2>{{$wishlist->name}}
                            <form method="POST" action="{{route('wishlist.destroy',$wishlist->id)}}" style="display: inline">
                                @csrf
                                @method('delete')
                             <button type="submit" class="btn btn-secondary effect-btn"><i class="zmdi zmdi-delete zmdi-hc-2x"> </i> Delete wishlist</button>
                            </form>
                        </h2>
                        <table class="table">
                            <thead style="background: rgb(93, 71, 192);color:white">
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>To Cart</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlist->products as $product)
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="{{$product->photo}}" alt="" style="width: 100px" />
								         </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
                                            {{$product->name}}
								       </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>${{$product->price}}
                                        </p>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <i class="zmdi zmdi-shopping-cart zmdi-hc-2x"></i>
                                        </a>
                                    </td>
                                    <td class="remove-pr">
                                      <form method="POST" action="{{route('deleteproduct',$wishlist->id)}}">
                                        @csrf
                                        @method('delete')
                                        <input type="text" hidden value="{{$product->id}}" name="product_id">
                                        <button type="submit" style="border: none; background:white">
                                            <i class="zmdi zmdi-delete zmdi-hc-2x"></i>
                                        </button>
                                      </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    @endforeach

                    <button class="btn btn-secondary effect-btn">Add All To Cart</button>

                </div>
            </div>


        </div>
    </div>
    <!-- End Cart -->
    @endsection

    @section('script')
    <script>
      $('#addwishlist').mouseover(function () {
        $('#listname').css("display","block");
      })

      $('#addwishlist').click(function () {
        $('#listname').css("display","none");
      })
      </script>
    @endsection


