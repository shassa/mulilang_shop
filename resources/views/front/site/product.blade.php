@extends('layouts.site')

@section('content')

<div id="displayTop" class="displaytopthree">
  <div class="container" >
      <div class="row" >
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
                  <div style="display: flex">
                      <div class="col-8" >
                           <img src="{{$product->photo}}">
                      </div>
                      <div class="col-4" >
                            <h3> Name : {{$product->name}}</h3><br>
                            <h3> Price : {{$product->price}} $</h3><br>
                            {{-- <h3>{{$product->category}}</h3> --}}
                            <h3>Brand : {{$product->brand->name}}</h3><br>
                            <h3>Seller : {{$product->brand->vendor->name}}</h3><br>
                      </div>
                  </div>
                  <div>
                    <h2>Full discribtion</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto <br>iure distinctio voluptates quasi, nostrum aliquam inventore numquam voluptate debitis quo sunt quidem autem vitae. Necessitatibus, ipsum consequatur! Labore, architecto repudiandae.</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum iste<br> voluptatibus quo quod omnis. Perferendis vel quos quis voluptates. Officiis qui aperiam dicta optio ipsum quasi nemo ad alias culpa.</p>
                    <h2>qualities   : </h2>
                     <p>  1-Lorem ipsum dolor sit amet<br>
                       2-consectetur adipisicing elit. <br>
                       3-Aliquid animi praesentium, <br>
                       4-accusamus repellendus quidem commodi, <br>
                       5- porro totam aspernatur ad qui dolorem debitis,<br>
                       6- labore veritatis illum corporis nemo nam officiis nobis?</p>
                  </div>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
{{-- ///////////////////////////////////////////// related////////////////////////// --}}
<div style="overflow: hidden">
 <section class="relate-product product-accessories clearfix" >
                  <h3 class="h5 title_block">Related products</h3>

                  <div
                    class="products product_list grid owl-carousel owl-theme"
                    data-autoplay="true"
                    data-autoplayTimeout="6000"
                    data-loop="true" data-items="5"
                    data-margin="0" data-nav="true"
                    data-dots="false" data-items_mobile="2" style="overflow: hidden">
                    @foreach ($category->products->where('translation_lang',getdefultlang()) as $categoryProduct )

        <div class="item  text-center">
			<div class="product-miniature js-product-miniature item-two first_item" data-id-product="1" data-id-product-attribute="40" itemscope itemtype="http://schema.org/Product">
                    <div class="product-cat-content">
                            <div class="category-title"><a href="{{route('category',$category->id)}}">{{$category->name}}</a>
                            </div>
                            <div class="product-title" itemprop="name"><a href="{{route('product',$categoryProduct->id)}}">{{$categoryProduct->name}}</a>
                            </div>
                    </div>
                    <div class="thumbnail-container">

                        <a href="{{route('product',$categoryProduct->id)}}" class="thumbnail product-thumbnail two-image">
                            <img
                            class="img-fluid image-cover"
                            src = "{{$categoryProduct->photo}}"
                            alt = ""
                            data-full-size-image-url = "{{$categoryProduct->photo}}"
                            width="600"
                            height="600"
                            >
                        </a>
                    </div>
                    <div class="product-description">
                        <div class="product-groups">
                            <div class="product-group-price">
                                <div class="product-price-and-shipping">
                                    <span itemprop="price" class="price">{{$categoryProduct->price}} UK£</span>
                                </div>
                            </div>
                            <p class="seller_name">
                                <a title="View seller profile" href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/1_david-james/">
                                    <i class="fa fa-user"></i>
                                    {{$categoryProduct->brand->vendor->name}}
                                </a>
                            </p>

                        </div>
                        <div class="product-buttons d-flex justify-content-center" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <form action="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق" method="post" class="formAddToCart">
                                <input type="hidden" name="token" value="28add935523ef131c8432825597b9928">
                                <input type="hidden" name="id_product" value="4">
                                <a class="add-to-cart" href="#" data-button-action="add-to-cart">
                                    <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-lg"></i>
                                    <span>أضف للسلة</span></a>
                            </form>

                            <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novblockwishlist/novblockwishlist_button.tpl -->

                            <a class="addToWishlist wishlistProd_4" href="#" data-rel="4" onclick="WishlistCart('wishlist_block_list', 'add', '4', false, 1); return false;">
                                <i class="zmdi zmdi-favorite zmdi-hc-lg"></i>
                                <span>Add to Wishlist</span>
                            </a>
                            <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novblockwishlist/novblockwishlist_button.tpl -->

                            <a href="{{route('product',$product->id)}}" class="quick-view hidden-sm-down" data-link-action="quickview">
                                <i class="zmdi zmdi-search zmdi-hc-lg"></i>
                                <span> نظرة سريعة</span>
                            </a>
                        </div>
                    </div>
		    </div>
	    </div>
    @endforeach
    </div><!-- /.modal-content -->
 </section>
</div>
 @endsection
