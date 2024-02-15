<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item"><a href=""><i class="la la-user"></i><span class="menu-title" data-i18n="nav.dash.main">Users</span></a>
                <ul class="menu-content">
                    @can('user-create')
                    <li class="">
                        <a class="menu-item" href="{{ route('users.create') }}" data-i18n="nav.dash.ecommerce">Add User</a>
                    </li>
                    @endcan
                    @can('user-list')
                    <li class="">
                        <a class="menu-item" href="{{ route('users.index') }}" data-i18n="nav.dash.ecommerce">View Users</a>
                    </li>
                    @endcan
                    @can('role-list')
                    <li class="">
                        <a class="menu-item" href="{{ route('roles.index') }}" data-i18n="nav.dash.ecommerce">Role Management</a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item"><a href="{{ request()->routeIs('routes.index') ? 'active' : '' }}"><i class="la la-car"></i><span class="menu-title" data-i18n="nav.dash.main">Routes</span></a>
                <ul class="menu-content">

                    @can('route-create')
                    <li class="{{ request()->routeIs('routes.create') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('routes.create')}}" data-i18n="nav.dash.ecommerce">Add Route</a>
                    </li>
                    @endcan
                    @can('route-list')
                    <li class="{{ request()->routeIs('routes.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('routes.index') }}" data-i18n="nav.dash.ecommerce">View Routes</a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item"><a href="{{ request()->routeIs('transports.index') ? 'active' : '' }}"><i class="la la-car"></i><span class="menu-title" data-i18n="nav.dash.main">Transport</span></a>
                <ul class="menu-content">
                    @can('transport-create')
                    <li class="{{ request()->routeIs('transports.create') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('transports.create')}}" data-i18n="nav.dash.ecommerce">Add Transport</a>
                    </li>
                    @endcan
                    @can('transport-list')
                    <li class="{{ request()->routeIs('transports.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('transports.index') }}" data-i18n="nav.dash.ecommerce">View Transport</a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-hotel"></i><span class="menu-title" data-i18n="nav.dash.main">Hotel</span></a>
                <ul class="menu-content">
                    @can('hotel-create')
                    <li class="">
                        <a class="menu-item" href="{{ route('hotels.create')}}" data-i18n="nav.dash.ecommerce">Add Hotel</a>
                    </li>
                    @endcan
                    @can('hotel-list')
                    <li class="">
                        <a class="menu-item" href="{{ route('hotels.index')}}" data-i18n="nav.dash.ecommerce">View Hotels</a>
                    </li>
                    @endcan
                    @can('add-weekend-days')
                    <li class="{{ request()->routeIs('weekends.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('weekends.index')}}" data-i18n="nav.dash.ecommerce">Add Weekend Days</a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-user"></i><span class="menu-title" data-i18n="nav.dash.main">Predefine Packages</span></a>
                <ul class="menu-content">
                    @can('package-create')
                    <li class="">
                        <a class="menu-item" href="{{ route('packages.create')}}" data-i18n="nav.dash.ecommerce">Add Predefine Packages</a>
                    </li>
                    @endcan
                    @can('package-list')
                    <li class="">
                        <a class="menu-item" href="{{ route('packages.index')}}" data-i18n="nav.dash.ecommerce">View Predefine Packages</a>
                    </li>
                    @endcan
                </ul>
            </li>
            <!-- <li class="nav-item"><a href="{{ route('contacts.index') }}"><i class="la la-hotel"></i><span class="menu-title" data-i18n="nav.dash.main">View User Contacts</span></a>
            </li> -->
           
            <li class="nav-item"><a href="{{ route('admin.visa_charges') }}"><i class="la la-hotel"></i><span class="menu-title" data-i18n="nav.dash.main">Visa Charges</span></a>
            </li>
            @can('package-calculation')
            <li class="nav-item"><a href="{{ route('admin.custom_package') }}"><i class="la la-hotel"></i><span class="menu-title" data-i18n="nav.dash.main">Package Calculation</span></a>
            </li>
            @endcan
            @can('currency-conversion')
            <li class="nav-item"><a href="{{ route('admin.currency_conversion') }}"><i class="la la-dollar"></i><span class="menu-title" data-i18n="nav.dash.main">Currency Conversion</span></a>
            </li>
            @endcan
            <li class="nav-item"><a href="{{ route('admin.visa_charges') }}"><i class="la la-dollar"></i><span class="menu-title" data-i18n="nav.dash.main">Visa Charges</span></a>
            </li>
            
            
        </ul>
    </div>
</div>