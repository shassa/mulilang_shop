<div class="header-bottom hidden-sm-down">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="contentsticky_verticalmenu verticalmenu-main col-lg-3 col-md-1 d-flex" data-textshowmore="Show More" data-textless="Hide" data-desktop_item="4">
                <div class="toggle-nav d-flex align-items-center justify-content-start">
                    <span class="btnov-lines"></span>
                    <span>Shop By Categories</span>
                </div>
                <div class="verticalmenu-content has-showmore show">

                    <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novverticalmenu/views/templates/hook/novverticalmenu.tpl -->
                    <div id="_desktop_verticalmenu" class="nov-verticalmenu block" data-count_showmore="6">
                        <div class="box-content block_content">
                            <div id="verticalmenu" class="verticalmenu" role="navigation">
                                <?php
                                   use App\Models\MainCategories;
                                   $categories=MainCategories::where("translation_lang",getdefultlang())with('subCategoeies')->get()?>
                                <ul class="menu level1">
                                    @foreach ($categories as $category)
                                   <li class="item  parent" >
                                       {{$category->name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novverticalmenu/views/templates/hook/novverticalmenu.tpl -->

                </div>
            </div>

                    <div class="advencesearch_header" style="padding-left: 41%">
                        <span class="toggle-search hidden-lg-up"><i class="zmdi zmdi-search"></i></span>
                        <div id="_desktop_search" class="contentsticky_search">

                            <!-- begin modules/novadvancedsearch/novadvancedsearch-top.tpl -->
                            <!-- Block search module TOP -->
                            <div id="desktop_search_content">

                                <form method="get" action="#" id="searchbox" class="form-novadvancedsearch">

                                    <div class="input-group">
                                        <input type="text" id="search_query_top" class="search_query ui-autocomplete-input form-control" name="search_query" value="" placeholder="Search"/>
                                        <div class="input-group-btn nov_category_tree hidden-sm-down">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" value="" aria-expanded="false">
                                                CATEGORIES
                                            </button>
                                            <ul class="dropdown-menu list-unstyled">
                                                <li class="dropdown-item active" data-value="0"><span>All Categories</span></li>

                                            </ul>
                                        </div>

                                        <span class="input-group-btn">
				                         <button class="btn btn-secondary" type="submit" name="submit_search"><i class="material-icons">search</i></button>
		                             	</span>
                                    </div>

                                </form>
                            </div>
                            <!-- /Block search module TOP -->

                            <!-- end modules/novadvancedsearch/novadvancedsearch-top.tpl -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
