<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if (auth()->user()->can('users-list') || auth()->user()->can('users-create') || auth()->user()->can('roles-list'))
                <li class="nav-item"><a href=""><i class="la la-user"></i><span class="menu-title"
                            data-i18n="nav.dash.main">Users</span></a>
                    <ul class="menu-content">

                        @can('users-create')
                            <li class="">
                                <a class="menu-item" href="{{ route('users.create') }}" data-i18n="nav.dash.ecommerce">Add
                                    User</a>
                            </li>
                        @endcan
                        @can('users-list')
                            <li class="">
                                <a class="menu-item" href="{{ route('users.index') }}" data-i18n="nav.dash.ecommerce">View
                                    Users</a>
                            </li>
                        @endcan
                        @can('roles-list')
                            <li class="">
                                <a class="menu-item" href="{{ route('roles.index') }}" data-i18n="nav.dash.ecommerce">roles
                                    Management</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('routes-create') || auth()->user()->can('routes-list'))
                <li class="nav-item"><a href="{{ request()->routeIs('routes.index') ? 'active' : '' }}"><i
                            class="la la-road"></i><span class="menu-title" data-i18n="nav.dash.main">Routes</span></a>
                    <ul class="menu-content">

                        @can('routes-create')
                            <li class="{{ request()->routeIs('routes.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route('routes.create') }}" data-i18n="nav.dash.ecommerce">Add
                                    Route</a>
                            </li>
                        @endcan
                        @can('routes-list')
                            <li class="{{ request()->routeIs('routes.index') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route('routes.index') }}" data-i18n="nav.dash.ecommerce">View
                                    Routes</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('vehicles-create') || auth()->user()->can('vehicles-list'))
                <li class="nav-item"><a href=""><i class="la la-car"></i><span class="menu-title"
                            data-i18n="nav.dash.main">Vehicles</span></a>
                    <ul class="menu-content">
                        @can('vehicles-create')
                            <li class="">
                                <a class="menu-item" href="{{ route('vehicles.create') }}"
                                    data-i18n="nav.dash.ecommerce">Add
                                    Vehicle</a>
                            </li>
                        @endcan
                        @can('vehicles-list')
                            <li class="">
                                <a class="menu-item" href="{{ route('vehicles.index') }}"
                                    data-i18n="nav.dash.ecommerce">View
                                    Vehicles</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif


            @if (auth()->user()->can('transports-create') || auth()->user()->can('transports-list'))
                <li class="nav-item"><a href="{{ request()->routeIs('transports.index') ? 'active' : '' }}"><i
                            class="la la-car"></i><span class="menu-title"
                            data-i18n="nav.dash.main">Transport</span></a>
                    <ul class="menu-content">
                        @can('transports-create')
                            <li class="{{ request()->routeIs('transports.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route('transports.create') }}"
                                    data-i18n="nav.dash.ecommerce">Add
                                    Transport</a>
                            </li>
                        @endcan
                        @can('transports-list')
                            <li class="{{ request()->routeIs('transports.index') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route('transports.index') }}"
                                    data-i18n="nav.dash.ecommerce">View
                                    Transport</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('hotels-create') ||
                    auth()->user()->can('hotels-list') ||
                    auth()->user()->can('add-weekends-days'))
                <li class="nav-item"><a href=""><i class="la la-hotel"></i><span class="menu-title"
                            data-i18n="nav.dash.main">Hotel</span></a>
                    <ul class="menu-content">
                        @can('hotels-create')
                            <li class="">
                                <a class="menu-item" href="{{ route('hotels.create') }}" data-i18n="nav.dash.ecommerce">Add
                                    Hotel</a>
                            </li>
                        @endcan
                        @can('hotels-list')
                            <li class="">
                                <a class="menu-item" href="{{ route('hotels.index') }}" data-i18n="nav.dash.ecommerce">View
                                    Hotels</a>
                            </li>
                        @endcan
                        @can('add-weekends-days')
                            <li class="{{ request()->routeIs('weekends.index') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route('weekends.index') }}"
                                    data-i18n="nav.dash.ecommerce">Add
                                    Weekend Days</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif


            @if (auth()->user()->can('packages-create') || auth()->user()->can('packages-list'))
                <li class="nav-item"><a href=""><i class="la la-calendar-o"></i><span class="menu-title"
                            data-i18n="nav.dash.main">Predefine Packages</span></a>
                    <ul class="menu-content">
                        @can('packages-create')
                            <li class="">
                                <a class="menu-item" href="{{ route('packages.create') }}"
                                    data-i18n="nav.dash.ecommerce">Add
                                    Predefine Packages</a>
                            </li>
                        @endcan
                        @can('packages-list')
                            <li class="">
                                <a class="menu-item" href="{{ route('packages.index') }}"
                                    data-i18n="nav.dash.ecommerce">View
                                    Predefine Packages</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
            
            @if (auth()->user()->can('tours-create') || auth()->user()->can('tours-list'))
                <li class="nav-item"><a href=""><i class="la la-calendar-o"></i><span class="menu-title"
                            data-i18n="nav.dash.main">Tours</span></a>
                    <ul class="menu-content">
                        @can('tours-create')
                            <li class="">
                                <a class="menu-item" href="{{ route('tours.create') }}"
                                    data-i18n="nav.dash.ecommerce">Add
                                    Tours</a>
                            </li>
                        @endcan
                        @can('tours-list')
                            <li class="">
                                <a class="menu-item" href="{{ route('tours.index') }}"
                                    data-i18n="nav.dash.ecommerce">View
                                   Tours</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            @can('contacts-view')
                <li class="nav-item"><a href="{{ route('contacts.index') }}"><i class="la la-phone"></i><span
                            class="menu-title" data-i18n="nav.dash.main">View User Contacts</span></a>
                </li>
            @endcan

            {{-- This is dummy and will be changed by mudassir --}}
            @if (auth()->user()->can('routes-create') || auth()->user()->can('routes-list'))
                <li class="nav-item"><a href="{{ request()->routeIs('routes.index') ? 'active' : '' }}"><i
                            class="la la-pencil-square"></i><span class="menu-title"
                            data-i18n="nav.dash.main">Maktab</span></a>
                    <ul class="menu-content">

                        @can('routes-create')
                            <li class="{{ request()->routeIs('maktab.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route('maktab.create') }}"
                                    data-i18n="nav.dash.ecommerce">Add Maktab</a>
                            </li>
                        @endcan
                        @can('routes-list')
                            <li class="{{ request()->routeIs('maktab.index') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route('maktab.index') }}"
                                    data-i18n="nav.dash.ecommerce">View Maktabs</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif


            @can('visa-charges')
                <li class="nav-item"><a href="{{ route('admin.visa_charges') }}"><i class="la la-money"></i><span
                            class="menu-title" data-i18n="nav.dash.main">Visa Charges</span></a>
                </li>
            @endcan
            @can('packages-calculation')
                <!-- <li class="nav-item"><a href="{{ route('admin.custom_package') }}"><i class="la la-hotel"></i><span
                                                                                                            class="menu-title" data-i18n="nav.dash.main">Package Calculation</span></a>
                                                                                                </li> -->
            @endcan
            @can('currencys-conversion')
                <li class="nav-item"><a href="{{ route('admin.currency_conversion') }}"><i
                            class="la la-dollar"></i><span class="menu-title" data-i18n="nav.dash.main">Currency
                            Conversion</span></a>
                </li>
            @endcan
            <li class="nav-item"><a href="{{ route('testimonials.index') }}"><i class="la la-thumbs-o-up"></i><span
                        class="menu-title" data-i18n="nav.dash.main">Testimonials</span></a>
            </li>
        </ul>
    </div>
</div>
