<div class="header-center hidden-sm-down">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div id="_desktop_logo" class="contentsticky_logo d-flex align-items-center justify-content-start col-lg-3 col-md-3">
                   <a href="{{route('site')}}" style="font-size: 20px;color:purple;font-family:cursive;"> Sopda</span>
            </div>
            <div class="col-lg-9 col-md-9 header-menu d-flex align-items-center justify-content-end">
                <div class="data-contact d-flex align-items-center">
                    <div class="title-icon">support<i class="icon-support icon-address"></i></div>
                    <div class="content-data-contact">
                        <div class="support">Call customer services :</div>
                        <div class="phone-support">
                            1234 567 899
                        </div>
                    </div>
                </div>
                <div class="contentsticky_group d-flex justify-content-end">
                    <div class="header_link_myaccount">
                        <a class="login" href="http://demo.bestprestashoptheme.com/savemart/ar/الحساب الشخصي" rel="nofollow" title="تسجيل الدخول إلى حسابك"><i class="zmdi zmdi-account zmdi-hc-2x"></i></a>
                    </div>
                    <div class="header_link_wishlist">
                        <a href="{{route('wishlist.index')}}" title="My Wishlists">
                            <i class="zmdi zmdi-star zmdi-hc-2x"></i>
                        </a>
                    </div>

                    <!-- begin module:ps_shoppingcart/ps_shoppingcart.tpl -->
                    <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_shoppingcart/ps_shoppingcart.tpl --><div id="_desktop_cart">
                        <div class="blockcart cart-preview active" data-refresh-url="//demo.bestprestashoptheme.com/savemart/ar/module/ps_shoppingcart/ajax">
                            <div class="header-cart">
                                <div class="cart-left">
                                    <div ><i class="zmdi zmdi-shopping-cart zmdi-hc-2x"></i></div>
                                    <div class="cart-products-count">{{ count((array) session('cart')) }}</div>
                                </div>
                                <div class="cart-right d-flex flex-column align-self-end ml-13">
                                    <span class="title-cart">سلة الشراء</span>
                                    <span class="cart-item"> items</span>
                                </div>
                            </div>
                            <div class="cart_block ">
                                <div class="cart-block-content">
                                    <div class="items">
                                        @php $total = 0 @endphp
                                        @foreach((array) session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                        @endforeach
                                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                            <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                                        </div>
                                    </div>
                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            <div class="row cart-detail">
                                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                    <img src="{{ $details['image'] }}" width="100px"/>
                                                </div>
                                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                    <p>{{ $details['name'] }}</p>
                                                    <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_shoppingcart/ps_shoppingcart.tpl -->
                    <!-- end module:ps_shoppingcart/ps_shoppingcart.tpl -->

                </div>
            </div>
        </div>
    </div>
</div>
