    <nav class="navbar navbar-default navbar-light bg-light shadow-sm">
      <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>

      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
@guest

        <!-- Authentication Links -->
@if (!Request::is('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
@endif
@if (!Request::is('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
@endif
@else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}</a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" aria-label="Log out button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf

            </form>
          </div>
        </li>
@endguest
      </ul>
    </nav>
