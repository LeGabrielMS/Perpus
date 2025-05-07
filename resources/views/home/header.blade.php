<!-- ***** Preloader Start ***** -->
<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ url('') }}" class="logo">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ url('') }}" class="active">Home</a></li>
                        <li><a href="{{ url('explore') }}">Explore</a></li>
                        <li><a href="{{ url('#') }}">Item Details</a></li>
                        @if (Route::has('login'))
                            @auth

                                <li><a href="{{ url('borrow_history') }}">My History</a></li>

                                <x-app-layout>
                                </x-app-layout>
                            @else
                                <li><a href="{{ route('login') }}">Login</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

<!-- JavaScript files-->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
