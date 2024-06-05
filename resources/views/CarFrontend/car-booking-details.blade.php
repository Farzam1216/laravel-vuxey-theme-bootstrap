<!DOCTYPE html>
<html lang="en">

    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('car-theme/css/open-iconic-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/aos.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/bootstrap-datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/jquery.timepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/icomoon.css') }}">
        <link rel="stylesheet" href="{{ asset('car-theme/css/style.css') }}">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand"
                    href="{{ route('frontend') }}"><span>{{ config('app.name', 'Laravel') }}</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>

                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        @if (Auth::check())
                            <li class="nav-item active"><a href="#" class="nav-link">{{ Auth::user()->name }}</a>
                            </li>
                            @can('dashboard')
                                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
                            @endcan
                            <li class="nav-item"><a href="{{ route('user-bookings') }}" class="nav-link">Booking
                                    Details</a></li>
                            <li class="nav-item"><a href="{{ route('logout-user') }}" class="nav-link"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        @else
                            <li class="nav-item"><a
                                    href="{{ Route::has('register') ? route('register') : 'javascript:void(0)' }}"
                                    class="nav-link">Register</a></li>
                            <li class="nav-item"><a
                                    href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}"
                                    class="nav-link">Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav -->

        @php
            $imageUrl = asset('car-theme/images/bg_3.jpg');
            $bookings = App\Models\CarBooking::with('car')->where('user_id', Auth::id())->get();
        @endphp

        <section class="ftco-section ftco-no-pt bg-light">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </section>
        <section class="ftco-section ftco-booking-details">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @foreach ($bookings as $booking)
                            <div class="booking-details mb-5">
                                <h2>Booking #{{ $booking->id }}</h2>
                                <p><strong>Car Name:</strong> {{ $booking->car->name }}</p>
                                <p><strong>Pick-up Location:</strong> {{ $booking->pickup_location }}</p>
                                <p><strong>Drop-off Location:</strong> {{ $booking->dropoff_location }}</p>
                                <p><strong>Pick-up Date:</strong> {{ $booking->pick_up_date }}</p>
                                <p><strong>Drop-off Date:</strong> {{ $booking->drop_off_date }}</p>
                                {{-- <p><strong>Pick-up Time:</strong> {{ $booking->pickup_time }}</p> --}}
                                <p><strong>Rent Type:</strong> {{ $booking->rent_type }}</p>
                                @if ($booking->rent_type === 'per_km')
                                    <p><strong>Total KM:</strong> {{ $booking->total_km }}</p>
                                @endif
                                <p><strong>Car Rate:</strong> ${{ $booking->car_rate }}</p>
                                <p><strong>Total Fare:</strong> ${{ $booking->total_fare }}</p>
                                {{-- <p><strong>Features:</strong></p> --}}
                                {{-- <ul>
                                @foreach ($booking->car->features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <footer class="ftco-footer ftco-bg-dark ftco-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2"><a href="#"
                                    class="logo"><span>{{ config('app.name', 'Laravel') }}</span></a></h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a>
                                </li>
                                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a>
                                </li>
                                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4 ml-md-5">
                            <h2 class="ftco-heading-2">Information</h2>
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">About</a></li>
                                <li><a href="#" class="py-2 d-block">Services</a></li>
                                <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                                <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                                <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Customer Support</h2>
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                                <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                                <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                                <li><a href="#" class="py-2 d-block">How it works</a></li>
                                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Have a Questions?</h2>
                            <div class="block-23 mb-3">
                                <ul>
                                    <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St.
                                            Mountain View, San Francisco, California, USA</span></li>
                                    <li><a href="#"><span class="icon icon-phone"></span><span
                                                class="text">+2 392 3929 210</span></a></li>
                                    <li><a href="#"><span class="icon icon-envelope"></span><span
                                                class="text">info@yourdomain.com</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">

                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="icon-heart color-danger" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        @php
            $user = Auth::user();
        @endphp

        <!-- loader -->
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
                <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                    stroke="#eeeeee" />
                <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                    stroke-miterlimit="10" stroke="#F96D00" />
            </svg></div>

        <script src="{{ asset('car-theme/js/jquery.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/jquery-migrate-3.0.1.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/popper.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/jquery.easing.1.3.js') }}"></script>
        <script src="{{ asset('car-theme/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/jquery.stellar.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/aos.js') }}"></script>
        <script src="{{ asset('car-theme/js/jquery.animateNumber.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('car-theme/js/jquery.timepicker.min.js') }}"></script>
        <script src="{{ asset('car-theme/js/scrollax.min.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="{{ asset('car-theme/js/google-map.js') }}"></script>
        <script src="{{ asset('car-theme/js/main.js') }}"></script>
        <script></script>

    </body>

</html>
