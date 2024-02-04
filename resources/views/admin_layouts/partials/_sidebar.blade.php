<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item"><a href=""><i class="la la-user"></i><span class="menu-title" data-i18n="nav.dash.main">Users</span></a>
                <ul class="menu-content">
                    <li class="">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">Add User</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">View Users</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{ request()->routeIs('routes.index') ? 'active' : '' }}"><i class="la la-car"></i><span class="menu-title" data-i18n="nav.dash.main">Routes</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('routes.create') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('routes.create')}}" data-i18n="nav.dash.ecommerce">Add Route</a>
                    </li>
                    <li class="{{ request()->routeIs('routes.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('routes.index') }}" data-i18n="nav.dash.ecommerce">View Routes</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{ request()->routeIs('transports.index') ? 'active' : '' }}"><i class="la la-car"></i><span class="menu-title" data-i18n="nav.dash.main">Transport</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('transports.create') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('transports.create')}}" data-i18n="nav.dash.ecommerce">Add Transport</a>
                    </li>
                    <li class="{{ request()->routeIs('transports.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('transports.index') }}" data-i18n="nav.dash.ecommerce">View Transport</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-hotel"></i><span class="menu-title" data-i18n="nav.dash.main">Hotel</span></a>
                <ul class="menu-content">
                    <li class="">
                        <a class="menu-item" href="{{ route('hotels.create')}}" data-i18n="nav.dash.ecommerce">Add Hotel</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{ route('hotels.index')}}" data-i18n="nav.dash.ecommerce">View Hotels</a>
                    </li>
                    <li class="{{ request()->routeIs('weekends.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('weekends.index')}}" data-i18n="nav.dash.ecommerce">Add Weekend Days</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-user"></i><span class="menu-title" data-i18n="nav.dash.main">Predefine Packages</span></a>
                <ul class="menu-content">
                    <li class="">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">Add Predefine Packages</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">View Predefine Packages</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{ route('admin.custom_package') }}"><i class="la la-hotel"></i><span class="menu-title" data-i18n="nav.dash.main">Package Calculation</span></a>
            </li>
            <li class="nav-item"><a href="{{ route('admin.currency_conversion') }}"><i class="la la-dollar"></i><span class="menu-title" data-i18n="nav.dash.main">Currency Conversion</span></a>
            </li>
            
        </ul>
    </div>
</div>