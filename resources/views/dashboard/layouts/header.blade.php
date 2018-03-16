<header class="main-header">
    <a href="{{ url('/admin') }}" class="logo">
        <span class="logo-mini"><b>K</b>A</span>
        <span class="logo-lg"><b>Administrator</b></span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('assets/pictures/profile.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('assets/pictures/profile.jpg') }}" class="img-circle" alt="User Image">
                            <p>{{ Auth::user()->name }}</p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{ route('logout-admin') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout-admin') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>