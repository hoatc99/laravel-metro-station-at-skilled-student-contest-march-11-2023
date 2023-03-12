<nav class="navbar navbar-expand-lg sticky-top" style="background-color: gainsboro">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/metro-logo.png') }}" alt="" width="100px" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggle"
            aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggle">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket') }}">Đặt vé</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('searchticket') }}">Tra cứu đặt vé</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
