
<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
    </li>
    @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ route('konto') }}">Konto</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('konto.create') }}">Upload</a>
    </li>
    @endauth
</ul>
