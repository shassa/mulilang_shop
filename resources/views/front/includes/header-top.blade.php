<div class="header-top hidden-sm-down">
    <div class="container">
        <div class="content">
            <div class="row">

                </div>
                <div class="col-lg-6 col-md-6 d-flex justify-content-end align-items-center header-top-right">
                    <div class="register-out">
                        <i class="zmdi zmdi-account"></i>
                        <a class="register" href="http://demo.bestprestashoptheme.com/savemart/ar/تسجيل الدخول?create_account=1" data-link-action="display-register-form">
                            Register
                        </a>
                        <span class="or-text">or</span>
                        <a class="login" href="http://demo.bestprestashoptheme.com/savemart/ar/الحساب الشخصي" rel="nofollow" title="تسجيل الدخول إلى حسابك">Sign in</a>
                    </div>
                   <div id="_desktop_language_selector" class="language-selector groups-selector hidden-sm-down language-selector-dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="main">
                            <span class="expand-more">Languages</span>
                        </div>
                        <div class="language-list dropdown-menu">
                            <div class="language-list-content text-left">
                                 <?php use App\Models\Language;
                                    $langs=Language::all();?>
                                 @foreach ($langs as $lang )
                                <div class="language-item">
                                    <div  >
                                        <a href="{{route('defultLang',$lang->abbr)}}">
                                            <span>{{$lang->abbr}}</span> :: <span>{{$lang->name}}</span>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
