<nav class="navbar navbar-dark bg-dark">

    <div class="container-fluid">

        <span class="navbar-brand">Laravel Assignment</span>

        <div>
@auth
            <span class="text-white me-3">
                {{ Auth::user()->name }}
            </span>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                class="btn btn-sm btn-danger">

                Logout

            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                @csrf

            </form>
            @endauth

        </div>

    </div>

</nav>
