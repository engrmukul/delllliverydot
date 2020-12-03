<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <h2 class="text-center text-light">AIT</h2>
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

            <li>
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">{{ trans('sidebar.restaurant')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array(Route::current()->getName(), array('restaurants.index', 'restaurants.create', 'restaurants.edit'))) active @else  @endif"><a href="{{ route('restaurants.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.restaurants')}}</a></li>
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
