<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            <!-- {{ trans('panel.site_title') }} -->
            <img src="/img/logo.png"  width="250"/>
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('city_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.cities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-archway c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.city.title') }}
                </a>
            </li>
        @endcan
        @can('type_event_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/categories*") ? "c-show" : "" }} {{ request()->is("admin/types*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.typeEvent.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cubes c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.category.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/types") || request()->is("admin/types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-boxes c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.type.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('slider_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-images c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.slider.title') }}
                </a>
            </li>
        @endcan
        @can('artist_tag_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/artists*") ? "c-show" : "" }} {{ request()->is("admin/tags*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.artistTag.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('artist_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.artists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/artists") || request()->is("admin/artists/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.artist.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tags") || request()->is("admin/tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bars c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tag.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('event_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.events.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.event.title') }}
                </a>
            </li>
        @endcan
        @can('zone_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.zones.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/zones") || request()->is("admin/zones/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-dice-six c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.zone.title') }}
                </a>
            </li>
        @endcan
        @can('customer_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.customers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/customers") || request()->is("admin/customers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-user-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.customer.title') }}
                </a>
            </li>
        @endcan
        @can('ticket_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.tickets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tickets") || request()->is("admin/tickets/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-check-double c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.ticket.title') }}
                </a>
            </li>
        @endcan
        @can('carpooling_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.carpoolings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/carpoolings") || request()->is("admin/carpoolings/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-taxi c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.carpooling.title') }}
                </a>
            </li>
        @endcan
        @can('carpooling_request_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.carpooling-requests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/carpooling-requests") || request()->is("admin/carpooling-requests/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-calendar-check c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.carpoolingRequest.title') }}
                </a>
            </li>
        @endcan
        @can('contact_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.contacts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contacts") || request()->is("admin/contacts/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-envelope c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contact.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>