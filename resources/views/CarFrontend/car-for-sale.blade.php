<!DOCTYPE html>
<html lang="en">

    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
            rel="stylesheet">
        <!-- {{ asset('assets/img/favicon/favicon.ico') }} -->
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
                                <li class="nav-item "><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                            @endcan
                            <li class="nav-item "><a href="{{ route('user-bookings') }}" class="nav-link">Booking
                                    Details</a>
                            </li>
                            <li class="nav-item "><a href="{{ route('car-for-sale') }}" class="nav-link">
                                    Cars For Sale</a>
                            </li>
                            <li class="nav-item "><a href="{{ route('logout-user') }}" class="nav-link">Logout</a>
                            </li>

                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        @else
                            <li class="nav-item "><a
                                    href="{{ Route::has('register') ? route('register') : 'javascript:void(0)' }}"
                                    class="nav-link">Register</a>
                            </li>
                            <li class="nav-item "><a
                                    href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}"
                                    class="nav-link">Login</a>
                            </li>

                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        @endif

                        {{-- <li class="nav-item active"><a href="#" class="nav-link">Home</a></li> --}}
                        {{-- <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li>
	          <li class="nav-item"><a href="pricing.html" class="nav-link">Pricing</a></li>
	          <li class="nav-item"><a href="car.html" class="nav-link">Cars</a></li>
	          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li> --}}
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav -->

        <div class="hero-wrap ftco-degree-bg" style="background-image: url('car-theme/images/bg_3.jpg');"
            data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                    <div class="col-lg-8 ftco-animate">
                        <div class="text w-100 text-center mb-md-5 pb-md-5">
                            <h1 class="mb-4">Cars For Sale</h1>
                            <p style="font-size: 18px;">For sale purchase please visit our office.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row">
                    @php
                        $cars = App\Models\Car::where('available_for_sale', 'yes')->paginate(9);
                    @endphp
                    @foreach ($cars as $car)
                        @php
                            if (isset($car->getMedia('photo_attachment')[0])) {
                                $imageUrl = $car->getMedia('photo_attachment')[0]->getUrl();
                            } else {
                                $imageUrl =
                                    'https://ui-avatars.com/api/?background=eae8fd&color=7367f0&name=' . $car->name;
                            }

                        @endphp

                        <div class="col-md-4">
                            <div class="car-wrap rounded ftco-animate">
                                <a href="{{ $imageUrl }}" target="_blank">
                                    <div class="img rounded d-flex align-items-end"
                                        style="background-image: url({{ $imageUrl }}); height: 200px; width: 100%; background-size: cover; background-position: center;">
                                    </div>
                                </a>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">{{ ucfirst($car->name) }}</a></h2>
                                    <div class="d-flex mb-3">
                                        <span class="cat">{{ $car->category->name ?? '-' }} -
                                            {{ $car->brand->name ?? '-' }}</span>

                                        <p class="price ml-auto">${{ numberFormat($car->full_day_rate_with_fuel) }}
                                            <span>/day</span>
                                        </p>
                                    </div>
                                    {{-- <p class="d-flex mb-0 d-block"><a
                                            href="{{ route('car-booking', ['id' => $car->id]) }}"
                                            class="btn btn-primary py-2 mr-1">Book now</a></p> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col text-center">
                        {{ $cars->links('pagination::bootstrap-4') }}
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
                  {{-- <div class="col-md">
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
                  </div> --}}
                  {{-- <div class="col-md">
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
                  </div> --}}
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

    </body>

</html>
