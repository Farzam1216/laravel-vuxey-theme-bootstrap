<li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : null }}">
    <a class="menu-link" href="{{ route('dashboard') }}">
        {{-- <i class="menu-icon tf-icons ti ti-smart-home"></i> --}}
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18" class="menu-icon" fill="non"
            viewBox="0 0 23 23">
            <defs>
                <style>
                    .cls-1 {
                        fill: #696270;
                    }

                    .cls-2 {
                        fill: #fff;
                    }
                </style>
            </defs>
            <g id="Layer_2" data-name="Layer 2">
                <g id="Layer_1-2" data-name="Layer 1">
                    <path class="cls-1"
                        d="M23,1.67A1.64,1.64,0,0,0,22.31.32a2.61,2.61,0,0,0-.7-.32H13.79c0,.08-.12.06-.17.08a1.67,1.67,0,0,0-1.17,1.59c0,3.36,0,6.72,0,10.08a1.66,1.66,0,0,0,1.65,1.67q3.63,0,7.26,0A1.65,1.65,0,0,0,23,11.75ZM22,11.9c0,.35-.07.41-.44.41H13.88c-.37,0-.42-.05-.42-.39V1.5c0-.34.06-.4.43-.4h7.66c.39,0,.46.06.46.42V11.9Z">
                    </path>
                    <path class="cls-1"
                        d="M10.55,11.32A1.68,1.68,0,0,0,8.9,9.58H1.65A1.68,1.68,0,0,0,.08,10.72c0,.07,0,.15-.08.2V21.61s0,0,0,.06A1.67,1.67,0,0,0,1.78,23h7a2.36,2.36,0,0,0,.38,0,1.69,1.69,0,0,0,1.39-1.69v-10Zm-1,10.2c0,.36-.06.41-.44.41H1.44c-.38,0-.45-.06-.45-.43V11.07c0-.35.07-.41.42-.41H9.13c.36,0,.41.05.41.41Z">
                    </path>
                    <path class="cls-1"
                        d="M9.36.07c-.06,0-.15,0-.2-.07H1.39A1.55,1.55,0,0,0,0,1.35v5c.08,0,.06.12.08.18A1.66,1.66,0,0,0,1.65,7.67H8.9A1.66,1.66,0,0,0,10.55,6c0-1.45,0-2.91,0-4.37A1.69,1.69,0,0,0,9.36.07Zm.07,6.09c0,.34-.06.4-.39.4H1.49c-.32,0-.38-.07-.38-.41V1.51c0-.32.08-.41.38-.41H9c.33,0,.4.07.4.42Z">
                    </path>
                    <path class="cls-1"
                        d="M21.31,15.33H14.15A1.68,1.68,0,0,0,12.45,17q0,2.14,0,4.29A1.68,1.68,0,0,0,14.16,23H21.3A1.66,1.66,0,0,0,23,21.32V17A1.67,1.67,0,0,0,21.31,15.33Zm.7,6.25c0,.39-.08.47-.45.47H13.9c-.39,0-.44-.07-.44-.49v-4.8c0-.41,0-.46.43-.46h7.67c.39,0,.45.06.45.48Z">
                    </path>
                </g>
            </g>
        </svg>
        <span class="menu-title text-truncate">{{ __('Dashboard') }}</span>
    </a>
</li>

@if (Auth::user()->can('permissions.index') || Auth::user()->can('roles.index') || Auth::user()->can('users.index'))
    <li class="menu-header">

        <span class="menu-header-text">{{ __('Administration') }}</span>

    </li>
@endif

@if (Auth::user()->can('permissions.index') || Auth::user()->can('roles.index'))
    <li
        class="menu-item {{ request()->routeIs('roles.*') || request()->routeIs('permissions.index') || request()->routeIs('users.*')
            ? 'active open'
            : null }}">
        <a class="menu-link menu-toggle " href="javascript:void(0)">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18" viewBox="0 0 21 18" fill="none"
                class="menu-icon">
                <g clip-path="url(#clip0_60_44)">
                    <path d="M14.3 2.70005L16.2 4.60005L20 0.800049" stroke="#686371" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M10.3 0C10.1 0.6 10.2 0.5 10.2 1.2L1.1 1.1V17H17V7.8C17.7 7.8 17.4 7.9 18.1 7.7V17C18.1 17.3 18 17.5 17.8 17.7C17.6 17.9 17.3 18 17 18H1C0.7 18 0.5 17.9 0.3 17.7C0.1 17.5 0 17.3 0 17V1C0 0.7 0.1 0.5 0.3 0.3C0.5 0.1 0.7 0 1 0H10.3Z"
                        fill="#696370" />
                    <path
                        d="M14 12.9C13.8 11.7 13.1 10.8 12 10.4C13.4 8.59995 13 6.29995 11.7 5.09995C10.3 3.79995 8.20001 3.69995 6.70001 4.79995C5.90001 5.29995 5.40001 6.09995 5.20001 7.09995C4.90001 8.29995 5.20001 9.39995 6.00001 10.4H5.90001C4.80001 10.9 4.20001 11.7 4.00001 12.8C3.90001 13.5 4.00001 14.2 4.00001 14.8C4.00001 15.2 4.30001 15.6 4.80001 15.6C5.20001 15.6 5.30001 15.1 5.30001 14.7C5.30001 14.2 5.30001 13.7 5.30001 13.3C5.30001 12.3 6.30001 11.5 7.30001 11.5C8.50001 11.5 9.60001 11.5 10.8 11.5C11.8 11.5 12.8 12.5 12.8 13.5C12.8 14 12.8 14.4 12.8 14.9C12.8 15.3 12.8 15.7 13.2 15.7C13.6 15.7 14 15.4 14 15.1C14.1 14.3 14.1 13.6 14 12.9ZM9.00001 10.8C7.40001 10.8 6.00001 9.39995 6.10001 7.79995C6.10001 6.19995 7.50001 4.89995 9.10001 4.89995C10.7 4.89995 12.1 6.29995 12 7.89995C11.9 9.49995 10.6 10.9 9.00001 10.8Z"
                        fill="#676270" />
                </g>
                <defs>
                    <clipPath id="clip0_60_44">
                        <rect width="20.6" height="18" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span class="menu-title text-truncate">{{ __('Users Roles And Permissions') }}</span>
        </a>
        <ul class="menu-sub">
            @can('roles.index')
                <li
                    class="menu-item {{ request()->routeIs('roles.index') || request()->routeIs('roles.create') || request()->routeIs('roles.edit')
                        ? 'active'
                        : null }}">
                    <a class="menu-link" href="{{ route('roles.index') }}">
                        <span class="menu-title text-truncate">{{ __('Roles') }}</span>
                    </a>
                </li>
            @endcan

            @can('permissions.index')
                <li class="menu-item {{ request()->routeIs('permissions.index') ? 'active' : null }}">
                    <a class="menu-link" href="{{ route('permissions.index') }}">

                        <span class="menu-title text-truncate">{{ __('Permissions') }}</span>
                    </a>
                </li>
            @endcan

            @can('users.index')
                <li
                    class="menu-item {{ request()->routeIs('users.index') ||
                    request()->routeIs('users.create') ||
                    request()->routeIs('users.edit') ||
                    request()->routeIs('users.*')
                        ? 'active'
                        : null }}">
                    <a class="menu-link" href="{{ route('users.index') }}">
                        <span class="menu-title text-truncate">Users</span>
                    </a>
                </li>
            @endcan

        </ul>
    </li>
@endif

@if (Auth::user()->can('car-categories.index') || Auth::user()->can('cars.index'))
    <li class="menu-header">
        <span class="menu-header-text">{{ __('Car Details') }}</span>
    </li>
@endif

@can('car-brands.index')
    <li class="menu-item {{ request()->routeIs('car-brands.*') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('car-brands.index') }}">

            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27"
                fill="none">
                <g clip-path="url(#clip0_58_29)">
                    <path
                        d="M23.6 16.5C23.4 16.4 23.1 16.2 22.8 16.1C23.1 15.9 23.4 15.8 23.7 15.6C25.5 14.6 25.4 12.1 23.7 11.1C23.4 10.9 23.1 10.8 22.8 10.6C23.1 10.4 23.3 10.3 23.6 10.1C24.5 9.6 25 8.9 25 7.8C25 6.8 24.5 6 23.6 5.5C20.7 3.9 17.7 2.2 14.8 0.6C14.4 0.4 13.9 0.2 13.4 0.1C13.3 0.1 13.1 0.1 13 0C12.6 0 12.3 0 11.9 0C11.9 0 11.9 0 11.8 0C11.2 0.1 10.6 0.3 10.1 0.6C7.3 2.3 4.4 3.9 1.4 5.5C0.5 6 0 6.2 0 7.2C0 8.3 0.5 9.6 1.4 10.1C1.6 10.2 1.9 10.4 2.2 10.5C1.9 10.7 1.6 10.8 1.4 11C0.5 11.6 0 11.7 0 12.7C0 13.7 0.5 15.1 1.4 15.6C1.7 15.7 1.9 15.9 2.2 16.1C1.9 16.3 1.7 16.4 1.4 16.5C0.5 17 0 17.2 0 18.2C0 19.2 0.5 20.6 1.4 21.1C4.4 22.7 7.3 24.4 10.3 26C11.8 26.8 13.3 26.8 14.8 26C15.3 25.7 15.5 25.3 15.3 24.8C15.1 24.1 14.7 24.3 14.1 24.7C13.3 25.1 12.1 25.1 11.2 24.7C8.3 23.4 5.7 21.3 2.4 19.9C2.2 19.8 1.7 18.9 1.7 18.6C1.7 18.3 1.8 18 2 17.8C2.6 17.3 3.3 16.9 4.2 17.2C4.4 17.3 4.5 17.2 4.6 17.3C6.5 18.4 8.3 19.4 10.2 20.4C11.7 21.3 13.3 21.3 14.8 20.4C16.7 19.4 18.6 18.3 20.4 17.3C20.5 17.3 21 16.9 21.1 16.9C22.1 17.1 22.6 17.4 22.9 17.9C23.1 18.2 23.5 19.1 23.1 19.3C23 19.4 22.4 19.9 22.3 19.9C21 20.6 19.9 21.2 18.6 21.9C18.1 22.2 17.9 22.4 18 22.9C18.2 23.6 18.6 23.7 19.3 23.3C20.7 22.5 22.1 21.7 23.5 21C24.4 20.5 24.9 19.7 24.9 18.7C25 17.8 24.5 17 23.6 16.5ZM1.3 7.9C1.3 7.6 1.3 7.2 1.5 7.1C4.5 5.5 8.3 3.3 11.3 1.7C12.1 1.3 12.7 1.1 13.5 1.6C16.5 3.3 20.4 5.6 23.4 7.3C23.8 7.5 23.6 8.7 23.1 8.9C20.1 10.6 16.9 12.1 14 13.8C13.6 14 12.9 14.3 12.5 14.4C12.1 14.4 11.7 14.2 11.4 14C8.4 12.3 4.7 10.5 1.8 8.9C1.5 8.6 1.3 8.1 1.3 7.9ZM23.2 14.5C20.3 16.2 17.3 17.7 14.4 19.4C14 19.6 12.9 20 12.5 20C12.1 20 11.1 19.6 10.8 19.4C7.8 17.7 4.9 15.8 1.9 14.2C1.4 13.9 1.3 12.6 1.7 12.2C2.3 11.6 2.6 11.6 3.2 11.5C3.4 11.5 4.5 11.8 4.6 11.9C6.4 12.9 8.3 14 10.1 15C11.7 15.9 13.3 15.9 14.8 15C16.6 14 18.5 12.9 20.3 11.9C20.5 11.8 21.3 11.6 21.5 11.6C22.4 11.8 23 12.1 23.4 12.4C23.9 12.8 23.8 14.1 23.2 14.5Z"
                        fill="#696270" />
                </g>
                <defs>
                    <clipPath id="clip0_58_29">
                        <rect width="25" height="26.7" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span class="menu-title text-truncate">Car Brands</span>
        </a>
    </li>
@endcan

@can('car-categories.index')
    <li class="menu-item {{ request()->routeIs('car-categories.*') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('car-categories.index') }}">

            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27"
                fill="none">
                <g clip-path="url(#clip0_58_29)">
                    <path
                        d="M23.6 16.5C23.4 16.4 23.1 16.2 22.8 16.1C23.1 15.9 23.4 15.8 23.7 15.6C25.5 14.6 25.4 12.1 23.7 11.1C23.4 10.9 23.1 10.8 22.8 10.6C23.1 10.4 23.3 10.3 23.6 10.1C24.5 9.6 25 8.9 25 7.8C25 6.8 24.5 6 23.6 5.5C20.7 3.9 17.7 2.2 14.8 0.6C14.4 0.4 13.9 0.2 13.4 0.1C13.3 0.1 13.1 0.1 13 0C12.6 0 12.3 0 11.9 0C11.9 0 11.9 0 11.8 0C11.2 0.1 10.6 0.3 10.1 0.6C7.3 2.3 4.4 3.9 1.4 5.5C0.5 6 0 6.2 0 7.2C0 8.3 0.5 9.6 1.4 10.1C1.6 10.2 1.9 10.4 2.2 10.5C1.9 10.7 1.6 10.8 1.4 11C0.5 11.6 0 11.7 0 12.7C0 13.7 0.5 15.1 1.4 15.6C1.7 15.7 1.9 15.9 2.2 16.1C1.9 16.3 1.7 16.4 1.4 16.5C0.5 17 0 17.2 0 18.2C0 19.2 0.5 20.6 1.4 21.1C4.4 22.7 7.3 24.4 10.3 26C11.8 26.8 13.3 26.8 14.8 26C15.3 25.7 15.5 25.3 15.3 24.8C15.1 24.1 14.7 24.3 14.1 24.7C13.3 25.1 12.1 25.1 11.2 24.7C8.3 23.4 5.7 21.3 2.4 19.9C2.2 19.8 1.7 18.9 1.7 18.6C1.7 18.3 1.8 18 2 17.8C2.6 17.3 3.3 16.9 4.2 17.2C4.4 17.3 4.5 17.2 4.6 17.3C6.5 18.4 8.3 19.4 10.2 20.4C11.7 21.3 13.3 21.3 14.8 20.4C16.7 19.4 18.6 18.3 20.4 17.3C20.5 17.3 21 16.9 21.1 16.9C22.1 17.1 22.6 17.4 22.9 17.9C23.1 18.2 23.5 19.1 23.1 19.3C23 19.4 22.4 19.9 22.3 19.9C21 20.6 19.9 21.2 18.6 21.9C18.1 22.2 17.9 22.4 18 22.9C18.2 23.6 18.6 23.7 19.3 23.3C20.7 22.5 22.1 21.7 23.5 21C24.4 20.5 24.9 19.7 24.9 18.7C25 17.8 24.5 17 23.6 16.5ZM1.3 7.9C1.3 7.6 1.3 7.2 1.5 7.1C4.5 5.5 8.3 3.3 11.3 1.7C12.1 1.3 12.7 1.1 13.5 1.6C16.5 3.3 20.4 5.6 23.4 7.3C23.8 7.5 23.6 8.7 23.1 8.9C20.1 10.6 16.9 12.1 14 13.8C13.6 14 12.9 14.3 12.5 14.4C12.1 14.4 11.7 14.2 11.4 14C8.4 12.3 4.7 10.5 1.8 8.9C1.5 8.6 1.3 8.1 1.3 7.9ZM23.2 14.5C20.3 16.2 17.3 17.7 14.4 19.4C14 19.6 12.9 20 12.5 20C12.1 20 11.1 19.6 10.8 19.4C7.8 17.7 4.9 15.8 1.9 14.2C1.4 13.9 1.3 12.6 1.7 12.2C2.3 11.6 2.6 11.6 3.2 11.5C3.4 11.5 4.5 11.8 4.6 11.9C6.4 12.9 8.3 14 10.1 15C11.7 15.9 13.3 15.9 14.8 15C16.6 14 18.5 12.9 20.3 11.9C20.5 11.8 21.3 11.6 21.5 11.6C22.4 11.8 23 12.1 23.4 12.4C23.9 12.8 23.8 14.1 23.2 14.5Z"
                        fill="#696270" />
                </g>
                <defs>
                    <clipPath id="clip0_58_29">
                        <rect width="25" height="26.7" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span class="menu-title text-truncate">Car Categories</span>
        </a>
    </li>
@endcan

@can('cars.index')
    <li class="menu-item {{ request()->routeIs('cars.*') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('cars.index') }}">

            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27"
                fill="none">
                <g clip-path="url(#clip0_58_29)">
                    <path
                        d="M23.6 16.5C23.4 16.4 23.1 16.2 22.8 16.1C23.1 15.9 23.4 15.8 23.7 15.6C25.5 14.6 25.4 12.1 23.7 11.1C23.4 10.9 23.1 10.8 22.8 10.6C23.1 10.4 23.3 10.3 23.6 10.1C24.5 9.6 25 8.9 25 7.8C25 6.8 24.5 6 23.6 5.5C20.7 3.9 17.7 2.2 14.8 0.6C14.4 0.4 13.9 0.2 13.4 0.1C13.3 0.1 13.1 0.1 13 0C12.6 0 12.3 0 11.9 0C11.9 0 11.9 0 11.8 0C11.2 0.1 10.6 0.3 10.1 0.6C7.3 2.3 4.4 3.9 1.4 5.5C0.5 6 0 6.2 0 7.2C0 8.3 0.5 9.6 1.4 10.1C1.6 10.2 1.9 10.4 2.2 10.5C1.9 10.7 1.6 10.8 1.4 11C0.5 11.6 0 11.7 0 12.7C0 13.7 0.5 15.1 1.4 15.6C1.7 15.7 1.9 15.9 2.2 16.1C1.9 16.3 1.7 16.4 1.4 16.5C0.5 17 0 17.2 0 18.2C0 19.2 0.5 20.6 1.4 21.1C4.4 22.7 7.3 24.4 10.3 26C11.8 26.8 13.3 26.8 14.8 26C15.3 25.7 15.5 25.3 15.3 24.8C15.1 24.1 14.7 24.3 14.1 24.7C13.3 25.1 12.1 25.1 11.2 24.7C8.3 23.4 5.7 21.3 2.4 19.9C2.2 19.8 1.7 18.9 1.7 18.6C1.7 18.3 1.8 18 2 17.8C2.6 17.3 3.3 16.9 4.2 17.2C4.4 17.3 4.5 17.2 4.6 17.3C6.5 18.4 8.3 19.4 10.2 20.4C11.7 21.3 13.3 21.3 14.8 20.4C16.7 19.4 18.6 18.3 20.4 17.3C20.5 17.3 21 16.9 21.1 16.9C22.1 17.1 22.6 17.4 22.9 17.9C23.1 18.2 23.5 19.1 23.1 19.3C23 19.4 22.4 19.9 22.3 19.9C21 20.6 19.9 21.2 18.6 21.9C18.1 22.2 17.9 22.4 18 22.9C18.2 23.6 18.6 23.7 19.3 23.3C20.7 22.5 22.1 21.7 23.5 21C24.4 20.5 24.9 19.7 24.9 18.7C25 17.8 24.5 17 23.6 16.5ZM1.3 7.9C1.3 7.6 1.3 7.2 1.5 7.1C4.5 5.5 8.3 3.3 11.3 1.7C12.1 1.3 12.7 1.1 13.5 1.6C16.5 3.3 20.4 5.6 23.4 7.3C23.8 7.5 23.6 8.7 23.1 8.9C20.1 10.6 16.9 12.1 14 13.8C13.6 14 12.9 14.3 12.5 14.4C12.1 14.4 11.7 14.2 11.4 14C8.4 12.3 4.7 10.5 1.8 8.9C1.5 8.6 1.3 8.1 1.3 7.9ZM23.2 14.5C20.3 16.2 17.3 17.7 14.4 19.4C14 19.6 12.9 20 12.5 20C12.1 20 11.1 19.6 10.8 19.4C7.8 17.7 4.9 15.8 1.9 14.2C1.4 13.9 1.3 12.6 1.7 12.2C2.3 11.6 2.6 11.6 3.2 11.5C3.4 11.5 4.5 11.8 4.6 11.9C6.4 12.9 8.3 14 10.1 15C11.7 15.9 13.3 15.9 14.8 15C16.6 14 18.5 12.9 20.3 11.9C20.5 11.8 21.3 11.6 21.5 11.6C22.4 11.8 23 12.1 23.4 12.4C23.9 12.8 23.8 14.1 23.2 14.5Z"
                        fill="#696270" />
                </g>
                <defs>
                    <clipPath id="clip0_58_29">
                        <rect width="25" height="26.7" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span class="menu-title text-truncate">Car Details</span>
        </a>
    </li>
@endcan

@can('car-bookings.details')
    <li class="menu-item {{ request()->routeIs('car-bookings.details') ? 'active' : null }}">
        <a class="menu-link" href="{{ route('car-bookings.details') }}">

            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27"
                fill="none">
                <g clip-path="url(#clip0_58_29)">
                    <path
                        d="M23.6 16.5C23.4 16.4 23.1 16.2 22.8 16.1C23.1 15.9 23.4 15.8 23.7 15.6C25.5 14.6 25.4 12.1 23.7 11.1C23.4 10.9 23.1 10.8 22.8 10.6C23.1 10.4 23.3 10.3 23.6 10.1C24.5 9.6 25 8.9 25 7.8C25 6.8 24.5 6 23.6 5.5C20.7 3.9 17.7 2.2 14.8 0.6C14.4 0.4 13.9 0.2 13.4 0.1C13.3 0.1 13.1 0.1 13 0C12.6 0 12.3 0 11.9 0C11.9 0 11.9 0 11.8 0C11.2 0.1 10.6 0.3 10.1 0.6C7.3 2.3 4.4 3.9 1.4 5.5C0.5 6 0 6.2 0 7.2C0 8.3 0.5 9.6 1.4 10.1C1.6 10.2 1.9 10.4 2.2 10.5C1.9 10.7 1.6 10.8 1.4 11C0.5 11.6 0 11.7 0 12.7C0 13.7 0.5 15.1 1.4 15.6C1.7 15.7 1.9 15.9 2.2 16.1C1.9 16.3 1.7 16.4 1.4 16.5C0.5 17 0 17.2 0 18.2C0 19.2 0.5 20.6 1.4 21.1C4.4 22.7 7.3 24.4 10.3 26C11.8 26.8 13.3 26.8 14.8 26C15.3 25.7 15.5 25.3 15.3 24.8C15.1 24.1 14.7 24.3 14.1 24.7C13.3 25.1 12.1 25.1 11.2 24.7C8.3 23.4 5.7 21.3 2.4 19.9C2.2 19.8 1.7 18.9 1.7 18.6C1.7 18.3 1.8 18 2 17.8C2.6 17.3 3.3 16.9 4.2 17.2C4.4 17.3 4.5 17.2 4.6 17.3C6.5 18.4 8.3 19.4 10.2 20.4C11.7 21.3 13.3 21.3 14.8 20.4C16.7 19.4 18.6 18.3 20.4 17.3C20.5 17.3 21 16.9 21.1 16.9C22.1 17.1 22.6 17.4 22.9 17.9C23.1 18.2 23.5 19.1 23.1 19.3C23 19.4 22.4 19.9 22.3 19.9C21 20.6 19.9 21.2 18.6 21.9C18.1 22.2 17.9 22.4 18 22.9C18.2 23.6 18.6 23.7 19.3 23.3C20.7 22.5 22.1 21.7 23.5 21C24.4 20.5 24.9 19.7 24.9 18.7C25 17.8 24.5 17 23.6 16.5ZM1.3 7.9C1.3 7.6 1.3 7.2 1.5 7.1C4.5 5.5 8.3 3.3 11.3 1.7C12.1 1.3 12.7 1.1 13.5 1.6C16.5 3.3 20.4 5.6 23.4 7.3C23.8 7.5 23.6 8.7 23.1 8.9C20.1 10.6 16.9 12.1 14 13.8C13.6 14 12.9 14.3 12.5 14.4C12.1 14.4 11.7 14.2 11.4 14C8.4 12.3 4.7 10.5 1.8 8.9C1.5 8.6 1.3 8.1 1.3 7.9ZM23.2 14.5C20.3 16.2 17.3 17.7 14.4 19.4C14 19.6 12.9 20 12.5 20C12.1 20 11.1 19.6 10.8 19.4C7.8 17.7 4.9 15.8 1.9 14.2C1.4 13.9 1.3 12.6 1.7 12.2C2.3 11.6 2.6 11.6 3.2 11.5C3.4 11.5 4.5 11.8 4.6 11.9C6.4 12.9 8.3 14 10.1 15C11.7 15.9 13.3 15.9 14.8 15C16.6 14 18.5 12.9 20.3 11.9C20.5 11.8 21.3 11.6 21.5 11.6C22.4 11.8 23 12.1 23.4 12.4C23.9 12.8 23.8 14.1 23.2 14.5Z"
                        fill="#696270" />
                </g>
                <defs>
                    <clipPath id="clip0_58_29">
                        <rect width="25" height="26.7" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span class="menu-title text-truncate">Car Booking Details</span>
        </a>
    </li>
@endcan
