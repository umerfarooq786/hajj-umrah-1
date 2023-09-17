<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
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
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">View Hotel</a>
                    </li>
                    <li class="{{ request()->routeIs('weekends.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('weekends.index')}}" data-i18n="nav.dash.ecommerce">Add Weekend Days</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>