
@section('branding')
    <a href="{{ route('admin')}}" class="navbar-brand">
        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
        Eat Again
    </a>
@endsection


@section('navbarLeft')
	@if(Auth::guard('admin')->check())
		<!-- Left Side Of Navbar -->
		<ul class="nav navbar-nav">
		    <li><a href="{{ route('member') }}">Member</a></li>
            <li><a href="{{ route('warung') }}">Warung</a></li>
            <li><a href="{{ route('buydeposite') }}">BuyDeposite</a></li>
            <li><a href="{{ route('selldeposite') }}">SellDeposite</a></li>
            <li><a href="{{ route('payment') }}">Payment</a></li>
            <li><a href="{{ route('pengiriman') }}">Pengiriman</a></li>
		</ul>
	@endif
@endsection

@section('navbarRight')
    <!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guard('admin')->check())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::guard('admin')->user()->nameAdmin }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('admin.logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
        </li>
    @else
    	<li><a href="{{ route('admin.login') }}">Login</a></li>
        <li><a href="{{ route('admin.register') }}">Register</a></li>
        
    @endif
</ul>
@endsection


