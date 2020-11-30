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
                    AIT
                </div>
            </li>

            <li>
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">{{ trans('sidebar.course_settings')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array(Route::current()->getName(), array('course-categories.index', 'course-categories.create', 'course-categories.edit'))) active @else  @endif"><a href="{{ route('course-categories.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.course_category')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('courses.index', 'courses.create', 'courses.edit'))) active @else  @endif"><a href="{{ route('courses.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.courses')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('sections.index', 'sections.create', 'sections.edit'))) active @else  @endif"><a href="{{ route('sections.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.sections')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('lessons.index', 'lessons.create', 'lessons.edit'))) active @else  @endif"><a href="{{ route('lessons.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.lessons')}}</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">{{ trans('sidebar.pages_settings')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array(Route::current()->getName(), array('banners.index', 'banners.create', 'banners.edit'))) active @else  @endif"><a href="{{ route('banners.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.banner')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('branches.index', 'branches.create', 'branches.edit'))) active @else  @endif"><a href="{{ route('branches.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.branches')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('pages.index', 'pages.create', 'pages.edit'))) active @else  @endif"><a href="{{ route('pages.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.pages')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('page-contents.index', 'page-contents.create', 'page-contents.edit'))) active @else  @endif"><a href="{{ route('page-contents.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.page-contents')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('faqs.index', 'faqs.create', 'faqs.edit'))) active @else  @endif"><a href="{{ route('faqs.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.faq')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('instructors.index', 'instructors.create', 'instructors.edit'))) active @else  @endif"><a href="{{ route('instructors.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.instructor')}}</a></li>

                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-eraser"></i> <span class="nav-label">{{ trans('sidebar.events_settings')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array(Route::current()->getName(), array('event-categories.index', 'event-categories.create', 'event-categories.edit'))) active @else  @endif"><a href="{{ route('event-categories.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.event-categories')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('events.index', 'events.create', 'events.edit'))) active @else  @endif"><a href="{{ route('events.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.events')}}</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-shopping-bag"></i> <span class="nav-label">{{ trans('sidebar.products_settings')}}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(in_array(Route::current()->getName(), array('product-categories.index', 'product-categories.create', 'product-categories.edit'))) active @else  @endif"><a href="{{ route('product-categories.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.product-categories')}}</a></li>
                    <li class="@if(in_array(Route::current()->getName(), array('products.index', 'products.create', 'products.edit'))) active @else  @endif"><a href="{{ route('products.index') }}"><i class="fa fa-list"></i>{{ trans('sidebar.products')}}</a></li>
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
