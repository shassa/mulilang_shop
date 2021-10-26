@extends('layouts.site')

@section('content')
    <div id="main">

        <div id="displayTop" class="displaytopthree">
            <div class="container">
                <div class="row">
                    <div class="nov-row  col-lg-12 col-xs-12" ><div class="nov-row-wrap row">
                            <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novpagemanage/views/source/html.tpl -->
                            <div class="nov-html col-xl-3 col-lg-3 col-md-3">
                                <div class="block">
                                    <div class="block_content">

                                    </div>
                                </div>
                            </div>

                            <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novpagemanage/views/source/html.tpl -->

                            <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novpagemanage/views/source/slider.tpl -->
                            <div id="nov-slider" class="slider-wrapper theme-default col-xl-9 col-lg-9 col-md-9 col-md-12"
                                 data-effect="random"
                                 data-slices="15"
                                 data-animSpeed="500"
                                 data-pauseTime="10000"
                                 data-startSlide="0"
                                 data-directionnav="false"
                                 data-controlNav="true"
                                 data-controlNavThumbs="false"
                                 data-pauseOnHover="true"
                                 data-manualAdvance="false"
                                 data-randomStart="false">
                                <div class="nov_preload">
                                    <div class="process-loading active">
                                        <div class="loader">
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nivoSlider">

                                @foreach ($slider as $product)
                                    <a href="#">
                                        <img src="{{$product->photo}}" alt="" title="#htmlcaption_42" />
                                    </a>
                                @endforeach
                            </div>

                            </div>

                            <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novpagemanage/views/source/slider.tpl -->
                        </div></div>
                </div>
            </div>
        </div>
        <section id="content" class="page-home pagehome-three">
            <div class="container">
                <div class="row">
                    @foreach ($brands as $brand)
                    @if($brand->products->count()>0)
                    <div class="nov-productlist  productlist-rows     col-xl-12 col-lg-12 col-md-12 col-xs-12 col-md-12">
                        <div class="block block-product clearfix">
                            <h2 class="title_block">{{$brand->name}}</h2>
                                <div class="block_content">
                                    <div id="productlist1693764381" class="product_list grid owl-carousel owl-theme multi-row" data-autoplay="false" data-autoplayTimeout="6000" data-loop="true" data-margin="30" data-dots="false" data-nav="true" data-items="3" data-items_large="3" data-items_tablet="3" data-items_mobile="1" >


                                            {{-- <div class="item  text-center"> --}}
                                                @foreach ($brand->products as $product)
                                                <div class=" item d-flex flex-wrap align-items-center product-miniature js-product-miniature item-row">
                                                    <div class="col-12 col-w40 pl-0">
                                                        <div class="thumbnail-container">

                                                            <a href="{{route('product',$product->id)}}" class="thumbnail product-thumbnail two-image">
                                                                <img
                                                                    class="img-fluid image-cover"
                                                                    src = "{{$product->photo}}"
                                                                    alt = ""
                                                                    data-full-size-image-url = "{{route('product',$product->id)}}"
                                                                    width="600"
                                                                    height="600"
                                                                >
                                                                <img
                                                                    class="img-fluid image-secondary"
                                                                    src = "{{$product->photo}}"
                                                                    alt = ""
                                                                    data-full-size-image-url = "{{route('product',$product->id)}}"
                                                                    width="600"
                                                                    height="600"
                                                                >
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w60 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/jmarketplace/views/templates/hook/product-list.tpl -->
                                                                <p class="seller_name">
                                                                    <a title="View seller profile" href="{{route('product',$product->id)}}">
                                                                        <i class="zmdi zmdi-account-circle "></i>
                                                                        {{$brand->vendor->name}}
                                                                    </a>
                                                                </p>

                                                                <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/jmarketplace/views/templates/hook/product-list.tpl -->


                                                                <div class="product-title" itemprop="name"><a href="{{route('product',$product->id)}}">
                                                                     {{$product->name}}
                                                                </a></div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price" class="price">{{$product->price}} $</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="product-buttons d-flex justify-content-center" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                                                                    <a class="add-to-cart addToWishlist" href="{{route('add.to.cart',$product->id)}}">
                                                                        <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-lg"></i>
                                                                        <span>أضف للسلة</span></a>


                                                                    @auth
                                                                    @if(App\Wishlist::where('user_id',Auth::user()->id)->get() -> count() > 0)
                                                                    <form action="{{route('addproduct',$product->id)}}" method="post" class="formAddToCart">
                                                                        @csrf
                                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                    <select name="wishlist_id" class="select2 form-control" style="position:absolute;top:-30px;display:none">
                                                                        <optgroup label="من فضلك أختر القائمة ">
                                                                                @foreach(App\Wishlist::where('user_id',Auth::user()->id)->get() as $wishlist)
                                                                                    <option
                                                                                        value="{{$wishlist -> id }}">{{$wishlist -> name}}</option>
                                                                                @endforeach
                                                                        </optgroup>
                                                                    </select>
                                                                    <button style="border:none" class="addToWishlist wishlistProd_4" type="submit">
                                                                        <i class="zmdi zmdi-favorite zmdi-hc-lg"></i>
                                                                        <span>Add to Wishlist</span>
                                                                        </button>
                                                                     </form>
                                                                    @endif

                                                                    @if(App\Wishlist::where('user_id',Auth::user()->id)->get()->count() == 0)
                                                                    {{-- <div > --}}
                                                                     <form method="post" action="{{route('addtonew',$product->id)}}">
                                                                        @csrf
                                                                        <input type="text" placeholder="Add New List Name" name="name" style="position:absolute;top:-30px;left:50px">
                                                                        <button style="border:none" class="addToWishlist wishlistProd_4" type="submit">
                                                                            <i class="zmdi zmdi-favorite zmdi-hc-lg"></i>
                                                                            <span>Add to Wishlist</span>
                                                                        </button>
                                                                     </form>
                                                                    {{-- </div> --}}

                                                                   @endif
                                                                    @endauth
                                                                    @guest

                                                                    <a href="{{route('wishlist.index')}}" style="border:none" class="addToWishlist wishlistProd_4">
                                                                        <i class="zmdi zmdi-favorite zmdi-hc-lg"></i>
                                                                        <span>Add to Wishlist</span>
                                                                    </a>
                                                                    @endguest

                                                                <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novblockwishlist/novblockwishlist_button.tpl -->

                                                                <a href="{{route('product',$product->id)}}" class="addToWishlist">
                                                                    <i class="zmdi zmdi-search zmdi-hc-lg"></i>
                                                                    <span> نظرة سريعة</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            {{-- </div> --}}
                                    </div>
                                </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
               </div>
            </div>
        </section>
    </div>


 @endsection

 @section('script')
 <script>
    $('.addToWishlist').mouseover(function () {
      $('.select2').css("display","block");
    });

    // $('.addToWishlist').click(function () {
    //   $('.select2').css("display","none");
    // });

    // $('.add').mouseover(function () {
    //   $('.addlist').css("background","red");
    // });

    // $('#add').click(function () {
    //   $('#addlist').css("display","none");
    // });
    </script>
 @endsection
