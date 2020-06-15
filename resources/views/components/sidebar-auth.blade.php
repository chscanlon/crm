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

            <div>
                <a
                    href="/"
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
                        Landing
                </a>
            </div>


            {{ $slot }}

        @else
            <div>
                <a
                    href="{{ route('login') }}"
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
                    Log in
                </a>
            </div>

            @if (Route::has('register'))
                <div class="">
                    <a
                        href="{{ route('register') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                    >
                        Register
                    </a>
                </div>
            @endif

        @endauth

    @endif


</div>