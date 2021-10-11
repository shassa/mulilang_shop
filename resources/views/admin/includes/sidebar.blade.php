<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item"><a href=""><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">لغات الموقع </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{activelang()->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.language')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.language.create')}}" data-i18n="nav.dash.crypto">أضافة
                            لغة جديده </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسيه </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\MainCategories::where('translation_lang',getdefultlang())->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.main_categories')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.main_categories.create')}}" data-i18n="nav.dash.crypto">أضافة
                             قسم جديد </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                <span class="menu-title" data-i18n="nav.dash.main">الاقسام الفرعية </span>
                <span
                    class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\SubCategories::where('translation_lang',getdefultlang())->count()}}</span>
            </a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{route('admin.sub_categories')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
                <li><a class="menu-item" href="{{route('admin.sub_categories.create')}}" data-i18n="nav.dash.crypto">أضافة
                         قسم جديد </a>
                </li>
            </ul>
        </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">التجار  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Vendors::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.vendors')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.vendors.create')}}" data-i18n="nav.dash.crypto">أضافة
                            متجر  </a>
                    </li>
                </ul>
            </li>


        <li class="nav-item"><a href=""><i class="la la-group"></i>
                <span class="menu-title" data-i18n="nav.dash.main"> المركات التجارية </span>
                <span
                    class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Brands::where('translation_lang',getdefultlang())->count()}}</span>
            </a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{route('brands.index')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
                <li><a class="menu-item" href="{{route('brands.create')}}" data-i18n="nav.dash.crypto">أضافة
                         مركة جديد </a>
                </li>
            </ul>
        </li>


            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات  </span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Models\Product::where('translation_lang',getdefultlang())->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('products.index')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('products.create')}}" data-i18n="nav.dash.crypto">أضافة
                            منتج </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                <span class="menu-title" data-i18n="nav.dash.main">المخازن  </span>
                <span
                    class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Models\Store::count()}}</span>
            </a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{route('stores.index')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
                <li><a class="menu-item" href="{{route('stores.create')}}" data-i18n="nav.dash.crypto">أضافة
                        مخزن </a>
                </li>
            </ul>
        </li>

            <li class=" nav-item">
                <a href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/documentation"><i
                        class="la la-text-height"></i>
                    <span class="menu-title" data-i18n="nav.support_documentation.main">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</div>
