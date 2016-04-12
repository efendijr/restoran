
@section('branding')
    @if (Auth::guest())
        <a href="{{ route('home')}}" class="navbar-brand">
    @else 
        <a href="{{ route('home.login')}}" class="navbar-brand">
    @endif
            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
            Eat Again
        </a>
@endsection
@if(Auth::user())
    @section('navbarLeft')
    	<!-- Left Side Of Navbar -->
		<ul class="nav navbar-nav">
		    <li><a href="{{ route('makan') }}">Makanan</a></li>
		</ul>
    @endsection
@endif

@section('navbarRight')
    <!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        <li><a href="{{ url('/login') }}">Login</a></li>
        <li><a href="{{ url('/register') }}">Register</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->alias }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
        </li>
    @endif
</ul>
@endsection