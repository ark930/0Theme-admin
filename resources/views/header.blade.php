<header>
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}"/>THEME.<span>Admin</span>
    </div>
    <div class="menu">
        <a href="{{ url("/dashboard") }}" class="{{ Request::url() == url("/dashboard") ? 'active' : '' }}">Dashboard</a>
        <a href="{{ url("/themes") }}" class="{{ Request::url() == url("/themes") ? 'active' : '' }}">Themes</a>
        <a href="{{ url("/users") }}" class="{{ Request::url() == url("/users") ? 'active' : '' }}">Users</a>
        <a href="{{ url("/finance") }}" class="{{ Request::url() == url("/finance") ? 'active' : '' }}">Finance</a>
        <a href="{{ url("/settings") }}" class="{{ Request::url() == url("/settings") ? 'active' : '' }}">Settings</a>
    </div>
    <div class="menu tool">
        <a href="{{ url('/logout') }}">Logout</a>
    </div>
</header>