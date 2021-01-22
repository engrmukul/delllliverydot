<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <h2 class="text-center text-light">DD</h2>
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
                <div class="logo-element">
                    DD
                </div>
            </li>

            <li class="@if(in_array(Route::current()->getName(), array('dashboard.index'))) active @else  @endif"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-list"></i>{{ trans('sidebar.dashboard')}}</a></li>

            <li>
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">{{ trans('sidebar.restaurant')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
{{--                    <li class="@if(in_array(Route::current()->getName(), array('restaurants.index', 'restaurants.create', 'restaurants.edit')))  @else  @endif"><a href="{{ route('restaurants.requested') }}"><i class="fa fa-list"></i>{{ trans('sidebar.restaurant_requested')}}</a></li>--}}
                    <li class="@if(in_array(Route::current()->getName(), array('restaurants.index', 'restaurants.create', 'restaurants.edit'))) active @else  @endif"><a href="{{ route('restaurants.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.restaurants')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('restaurants.index', 'restaurants.create', 'restaurants.edit')))  active @else  @endif"><a href="{{ route('restaurants.reviews') }}"><i class="fa fa-list"></i>{{ trans('sidebar.restaurant_reviews')}}</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">{{ trans('sidebar.food')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array(Route::current()->getName(), array('categories.index', 'categories.create', 'categories.edit'))) active @else  @endif"><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.category')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('foods.index', 'foods.create', 'foods.edit')))  active @else  @endif"><a href="{{ route('foods.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.foods')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('groups.index', 'groups.create', 'groups.edit')))  active @else  @endif"><a href="{{ route('groups.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.groups')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('extras.index', 'extras.create', 'extras.edit')))  active @else  @endif"><a href="{{ route('extras.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.extras')}}</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">{{ trans('sidebar.order')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array(Route::current()->getName(), array('orders.index', 'orders.create', 'orders.edit')))  active @else  @endif"><a href="{{ route('orders.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.orders')}}</a></li>
                </ul>
            </li>

            <li class="@if(in_array(Route::current()->getName(), array('coupons.index', 'coupons.create', 'coupons.edit')))  @else  @endif"><a href="{{ route('coupons.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.coupons')}}</a></li>
            <li class="@if(in_array(Route::current()->getName(), array('customers.index', 'customers.create', 'customers.edit')))  @else  @endif"><a href="{{ route('customers.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.customers')}}</a></li>
            <li class="@if(in_array(Route::current()->getName(), array('riders.index', 'riders.create', 'riders.edit')))  @else  @endif"><a href="{{ route('riders.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.riders')}}</a></li>

            <li>
                <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">{{ trans('sidebar.settings')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array(Route::current()->getName(), array('helpandsupports.index', 'helpandsupports.create', 'helpandsupports.edit'))) active @else  @endif"><a href="{{ route('helpandsupports.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.help&supports')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('termsandconditions.index', 'termsandconditions.create', 'termsandconditions.edit')))  active @else  @endif"><a href="{{ route('termsandconditions.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.terms&conditions')}}</a></li>
                </ul>
            </li>


        </ul>

    </div>
</nav>

@push('scripts')
<script>

    jQuery('.active').parent().parent('li').addClass('active');


</script>
@endpush
