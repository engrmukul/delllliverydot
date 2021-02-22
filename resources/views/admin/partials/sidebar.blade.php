<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
{{--                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">--}}
{{--                        <span class="block m-t-xs font-bold">{{ auth()->user()->name  }}</span>--}}
{{--                    </a>--}}
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="#"><i
                                        class="fa fa-key"></i>{{ trans('sidebar.change_password')}}</a></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                <i class="fa fa-sign-out"></i> {{ trans('sidebar.logout')}}
                            </a>
                            <form id="frm-logout" action="#" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element"></div>
            </li>
            <?php
                //$arrowIcon = '<span class="fa fa-angle-right "></span>';
                $arrowIcon = '<span class="fa arrow"></span>';
                $menuLists = array(
                    // Dashboard
                    'Dashboard' => array(
                        'trans' => 'admin.dashboard',
                        'icon' => '<img src="'. asset('public/img/icons/10dashboard32.png') .'" class="menu_icon"/>',
                        'activeClass' => array('dashboard.index', 'admin.dashboard',),
                        'sub' => array(),
                    ),

                    // Restaurant Menu
                    'Restaurant' => array(
                        'trans' => 'sidebar.restaurant',
                        'icon' => '<img src="'. asset('public/img/icons/20restaurants32.png') .'" class="menu_icon"/>',
                        'activeClass' => array('restaurants.reviews', 'restaurants.index', 'restaurants.create', 'restaurants.edit'),
                        'sub' => array(
                            'Restaurants' => array(
                                'trans' => 'restaurants.index',
                                'icon' => '<img src="'. asset('public/img/icons/20restaurants32.png') .'" class="menu_icon"/>',
                                'activeClass' => array('restaurants.index', 'restaurants.create', 'restaurants.edit'),
                            ),
                            'Restaurants Review' => array(
                                'trans' => 'restaurants.reviews',
                                'icon' => '<img src="'. asset('public/img/icons/21review32.png') .'" class="menu_icon"/>',
                                'activeClass' => array('restaurants.reviews', 'reviews.index', 'reviews.create', 'reviews.edit'),
                            ),
                        ),
                    ),

                    // Food
                    'Food' => array(
                        'trans' => 'sidebar.food',
                        'icon' => '<img src="'. asset('public/img/icons/30food32.png') .'" class="menu_icon"/>',
                        'activeClass' => array(
                            'categories.index', 'categories.create', 'categories.edit', 'foods.index', 'foods.create', 'foods.edit',
                        ),
                        'sub' => array(
                            'Foods' => array(
                                'trans' => 'foods.index',
                                'icon' => '<img src="'. asset('public/img/icons/30food32.png') .'" class="menu_icon"/>',
                                'activeClass' => array('foods.index', 'foods.create', 'foods.edit'),
                            ),
                            'Category' => array(
                                'trans' => 'categories.index',
                                'icon' => '<img src="'. asset('public/img/icons/31review32.png') .'" class="menu_icon"/>',
                                'activeClass' => array('categories.index', 'categories.create', 'categories.edit'),
                            ),
                        ),
                    ),

                    // Order
                    'Order' => array(
                        'trans' => 'sidebar.order',
                        'icon' => '<img src="'. asset('public/img/icons/40orders32.png') .'" class="menu_icon"/>',
                        'activeClass' => array('orders.index', 'orders.create', 'orders.edit'),
                        'sub' => array(
                            'Orders' => array(
                                'trans' => 'orders.index',
                                'icon' => '<img src="'. asset('public/img/icons/40orders32.png') .'" class="menu_icon"/>',
                                'activeClass' => array('orders.index', 'orders.create', 'orders.edit'),
                            ),
                        ),
                    ),

                    // Coupons
                    'Coupons' => array(
                        'trans' => 'coupons.index',
                        'icon' => '<img src="'. asset('public/img/icons/50coupons32.png') .'" class="menu_icon"/>',
                        'activeClass' => array('coupons.index', 'coupons.create', 'coupons.edit',),
                        'sub' => array(),
                    ),

                    // Riders
                    'Rriders' => array(
                        'trans' => 'riders.index',
                        'icon' => '<img src="'. asset('public/img/icons/60riders32.png') .'" class="menu_icon"/>',
                        'activeClass' => array('riders.index', 'riders.create', 'riders.edit',),
                        'sub' => array(),
                    ),
                    
                    // Customers
                    'Customers' => array(
                        'trans' => 'customers.index',
                        'icon' => '<img src="'. asset('public/img/icons/70customers32.png') .'" class="menu_icon"/>',
                        'activeClass' => array('customers.index', 'customers.create', 'customers.edit',),
                        'sub' => array(),
                    ),

                    // Settings
                    'Settings' => array(
                        'trans' => 'sidebar.settings',
                        'icon' => '<img src="'. asset('public/img/icons/90settings32.png') .'" class="menu_icon"/>',
                        'activeClass' => array(
                            'helpandsupports.index', 'helpandsupports.create', 'helpandsupports.edit', 'termsandconditions.index', 'termsandconditions.edit', 'settings.edit'
                        ),
                        'sub' => array(
                            'Settings' => array(
                                'trans' => 'settings.edit',
                                'icon' => '<img src="'. asset('public/img/icons/90settings32.png') .'" class="menu_icon"/>',
                                'activeClass' => array('settings.edit'),
                            ),
                            'Terms & Condition' => array(
                                'trans' => 'termsandconditions.index',
                                'icon' => '<img src="'. asset('public/img/icons/92terms32.png') .'" class="menu_icon"/>',
                                'activeClass' => array('termsandconditions.index', 'termsandconditions.edit'),
                            ),
                            'Help & Supports' => array(
                                'trans' => 'helpandsupports.index',
                                'icon' => '<img src="'. asset('public/img/icons/91heplandsupport32.png') .'" class="menu_icon"/>',
                                'activeClass' => array('helpandsupports.index', 'helpandsupports.create', 'helpandsupports.edit'),
                            ),
                        ),
                    ),
                    
                );

                foreach($menuLists as $menuName => $menuList){
                    $name = $menuName;
                    $sub = $menuList['sub']; 
                    $url = (!empty($sub)) ? '#' : route($menuList['trans']) ;
                    $icon = $menuList['icon'];
                    $active = $menuList['activeClass']; ?>

                    <li class="@if(in_array(Route::current()->getName(), $active )) active @else  @endif">
                        <a href="{{$url}}">
                            <?php echo $icon    ?>
                            <?php 
                                if($url=='#'){
                                    echo '<span class="nav-label">'.$name .'</span>'.$arrowIcon;
                                }else{
                                    echo $name;
                                }
                            ?>
                        </a>
                       
                        <?php
                            if($url=='#'){ ?>
                                <ul class="nav nav-second-level collapse">
                                    <?php foreach($sub as $subMenuName => $subMenuList){
                                        $subName = $subMenuName;
                                        $subUrl = route($subMenuList['trans']);
                                        $subIcon = $subMenuList['icon'];
                                        $subActive = $subMenuList['activeClass']; ?>
                                        <li class="@if(in_array(Route::current()->getName(), $subActive )) active @else  @endif">
                                            <a href="{{ $subUrl }}">
                                                <?php echo $subIcon . $subName ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>  
                    </li>

                <?php }
            ?>

        </ul>

    </div>
</nav>

@push('scripts')
<script>

    jQuery('.active').parent().parent('li').addClass('active');


</script>
@endpush
