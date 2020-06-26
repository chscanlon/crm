<div class=" m-4">
    @if (Route::has('login'))
        @auth
            <div>
                <a
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class=
                    "
                        font-medium
                        text-indigo-600
                        hover:text-indigo-500
                        focus:outline-none
                        focus:underline
                        transition ease-in-out duration-150
                    "
                >
                    Log out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            <x-nav.sidebar-link href="/">Landing</x-nav.sidebar-link>

            <x-nav.sidebar-group groupTitle="Data Import">
                <x-nav.sidebar-link href="/customerImports/create">Customers</x-nav.sidebar-link>
                <x-nav.sidebar-link href="/scheduleImports/create">Appointments</x-nav.sidebar-link>
                <x-nav.sidebar-link href="/invoiceImports/create">Invoices</x-nav.sidebar-link>
            </x-nav.sidebar-group>

            <x-nav.sidebar-group groupTitle="Customer">
                <x-nav.sidebar-link href="/customer">Customer List</x-nav.sidebar-link>
            </x-nav.sidebar-group>


            {{ $slot }}

        @else
            <x-nav.sidebar-link href="/login">Log in</x-nav.sidebar-link>

            @if (Route::has('register'))
                <x-nav.sidebar-link href="/register">Register</x-nav.sidebar-link>
            @endif

        @endauth

    @endif


</div>