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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                            <li class="nav-item "><a href="{{ route('car-for-sale') }}" class="nav-link">Booking
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

                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav -->

        @php
            // if (isset($car->getMedia('photo_attachment')[0])) {
            //     $imageUrl = $car->getMedia('photo_attachment')[0]->getUrl();
            // } else {
            $imageUrl = asset('car-theme/images/bg_3.jpg');
            // }
        @endphp

        <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ $imageUrl }}');"
            data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                    <div class="col-md-9 ftco-animate pb-5">
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                        class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i
                                    class="ion-ios-arrow-forward"></i></span></p>
                        <h1 class="mb-3 bread">Car Details</h1>
                    </div>
                </div>

            </div>
        </section>

        <section class="ftco-section ftco-no-pt bg-light">
            <div class="container">

                <div class="row no-gutters">
                    <div class="col-md-12 featured-top">
                        <div class="row no-gutters">
                            <div class="col-md-4 d-flex align-items-center">
                                <form action="{{ route('store-car-booking') }}" method="post"
                                    class="request-form ftco-animate bg-primary">
                                    @csrf
                                    <h2>Make your trip</h2>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="car_id" value="{{ $car->id }}">

                                    <div class="form-group">
                                        <label for="" class="label">User Name</label>
                                        <input type="text" readonly class="form-control"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">User Email</label>
                                        <input type="text" readonly class="form-control"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">User Mobile No.</label>
                                        <input type="text" readonly class="form-control"
                                            value="{{ Auth::user()->mobile_no }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Select Rent Type</label>
                                        <select name="rent_type" id="rent_type" class="form-control">
                                            <option value="per_day">Per Day</option>
                                            <option value="per_km">Per Km</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="km_group" style="display: none;">
                                        <label for="" class="label">Enter Kilometer</label>
                                        <input type="number" name="total_km" id="total_km" class="form-control"
                                            placeholder="Enter Kilometers">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="label">Rent Rate</label>
                                        <input readonly type="number" name="car_rate" id="car_rate"
                                            class="form-control" value="{{ $car->full_day_rate_with_fuel }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Pick-up location</label>
                                        <input type="text" class="form-control" name="pickup_location"
                                            placeholder="City, Airport, Station, etc">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Drop-off location</label>
                                        <input type="text" class="form-control" name="dropoff_location"
                                            placeholder="City, Airport, Station, etc">
                                    </div>
                                    <div class="d-flex">
                                        {{-- <div class="form-group mr-2">
                                            <label for="" class="label">Pick-up date</label>
                                            <input type="date" class="form-control" id="book_pick_date"
                                                name="pick_up_date">
                                        </div>
                                        <div class="form-group ml-2">
                                            <label for="" class="label">Drop-off date</label>
                                            <input type="date" class="form-control" id="book_off_date"
                                                name="drop_off_date">
                                        </div> --}}
                                        <div class="form-group mr-2">
                                            <label for="" class="label">Pick-up date</label>
                                            <input type="text" class="form-control" id="book_pick_date_flatpicker"
                                                name="pick_up_date">
                                        </div>
                                        <div class="form-group ml-2">
                                            <label for="" class="label">Drop-off date</label>
                                            <input type="text" class="form-control" id="book_off_date_flatpicker"
                                                name="drop_off_date">
                                        </div>
                                    </div>
                                    <div class="form-group" id="days_group" style="display: none;">
                                        <label for="" class="label">Total Number of Days</label>
                                        <input type="number" readonly id="total_days" class="form-control">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="" class="label">Pick-up time</label>
                                        <input type="time" class="form-control" id="time_pick"
                                            name="pickup_time">
                                    </div> --}}
                                    <div class="form-group" id="discount_group" style="display: none;">
                                        <label for="" class="label">Discount (%)</label>
                                        <input type="number" readonly id="discount" class="form-control"
                                            value="10">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Total Fare</label>
                                        <input readonly type="number" id="total_fare" name="total_fare"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Rent A Car Now"
                                            class="btn btn-secondary py-3 px-4">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8 d-flex align-items-center">
                                <div class="services-wrap rounded-right w-100">
                                    <h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
                                    <div class="row d-flex mb-4">
                                        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                            <div class="services w-100 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="flaticon-route"></span>
                                                </div>
                                                <div class="text w-100">
                                                    <h3 class="heading mb-2">Choose Your Pickup Location</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                            <div class="services w-100 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="flaticon-handshake"></span>
                                                </div>
                                                <div class="text w-100">
                                                    <h3 class="heading mb-2">Select the Best Deal</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                            <div class="services w-100 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="flaticon-rent"></span>
                                                </div>
                                                <div class="text w-100">
                                                    <h3 class="heading mb-2">Reserve Your Rental Car</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <p><a href="#" class="btn btn-primary py-3 px-4">Reserve Your Perfect Car</a></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

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

        @php
            if (isset($car->getMedia('photo_attachment')[0])) {
                $imageUrl = $car->getMedia('photo_attachment')[0]->getUrl();
            } else {
                $imageUrl = asset('car-theme/images/bg_3.jpg');
            }
        @endphp
        <section class="ftco-section ftco-car-details">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="car-details">
                            <div class="img rounded" style="background-image: url({{ $imageUrl }});"></div>
                            <div class="text text-center">
                                <span class="subheading">{{ $car->name }}</span>
                                <h2>{{ $car->category->name ?? '-' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services">
                            <div class="media-body py-md-4">
                                <div class="d-flex mb-3 align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-dashboard"></span></div>
                                    <div class="text">
                                        <h3 class="heading mb-0 pl-3">
                                            Mileage
                                            <span>40,000</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services">
                            <div class="media-body py-md-4">
                                <div class="d-flex mb-3 align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-pistons"></span></div>
                                    <div class="text">
                                        <h3 class="heading mb-0 pl-3">
                                            Transmission
                                            <span>Manual</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services">
                            <div class="media-body py-md-4">
                                <div class="d-flex mb-3 align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-car-seat"></span></div>
                                    <div class="text">
                                        <h3 class="heading mb-0 pl-3">
                                            Seats
                                            <span>5 Adults</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services">
                            <div class="media-body py-md-4">
                                <div class="d-flex mb-3 align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-backpack"></span></div>
                                    <div class="text">
                                        <h3 class="heading mb-0 pl-3">
                                            Luggage
                                            <span>4 Bags</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services">
                            <div class="media-body py-md-4">
                                <div class="d-flex mb-3 align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-diesel"></span></div>
                                    <div class="text">
                                        <h3 class="heading mb-0 pl-3">
                                            Fuel
                                            <span>Petrol</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pills">
                        <div class="bd-example bd-example-tabs">
                            <div class="d-flex justify-content-center">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                    {{-- <li class="nav-item">
                                        <a class="nav-link active" id="pills-description-tab" data-toggle="pill"
                                            href="#pills-description" role="tab"
                                            aria-controls="pills-description" aria-expanded="true">Features</a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill"
                                            href="#pills-manufacturer" role="tab"
                                            aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-review-tab" data-toggle="pill"
                                            href="#pills-review" role="tab" aria-controls="pills-review"
                                            aria-expanded="true">Review</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" id="pills-tabContent">
                                {{-- <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                                    aria-labelledby="pills-description-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <ul class="features">
                                                <li class="check"><span
                                                        class="ion-ios-checkmark"></span>Airconditions</li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Child Seat
                                                </li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>GPS</li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Luggage</li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Music</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="features">
                                                <li class="check"><span class="ion-ios-checkmark"></span>Seat Belt
                                                </li>
                                                <li class="remove"><span class="ion-ios-close"></span>Sleeping Bed
                                                </li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Water</li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Bluetooth
                                                </li>
                                                <li class="remove"><span class="ion-ios-close"></span>Onboard computer
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="features">
                                                <li class="check"><span class="ion-ios-checkmark"></span>Audio input
                                                </li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Long Term
                                                    Trips</li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Car Kit</li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Remote
                                                    central locking</li>
                                                <li class="check"><span class="ion-ios-checkmark"></span>Climate
                                                    control</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="tab-pane fade show active" id="pills-manufacturer" role="tabpanel"
                                    aria-labelledby="pills-manufacturer-tab">
                                    <p>Even the all-powerful Pointing has no control about the blind texts it is an
                                        almost unorthographic life One day however a small line of blind text by the
                                        name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                    <p>When she reached the first hills of the Italic Mountains, she had a last view
                                        back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet
                                        Village and the subline of her own road, the Line Lane. Pityful a rethoric
                                        question ran over her cheek, then she continued her way.</p>
                                </div>

                                <div class="tab-pane fade" id="pills-review" role="tabpanel"
                                    aria-labelledby="pills-review-tab">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <h3 class="head">23 Reviews</h3>
                                            <div class="review d-flex">
                                                <div class="user-img"
                                                    style="background-image: url({{ asset('images/person_1.jpg') }})">
                                                </div>
                                                <div class="desc">
                                                    <h4>
                                                        <span class="text-left">Jacob Webb</span>
                                                        <span class="text-right">14 March 2018</span>
                                                    </h4>
                                                    <p class="star">
                                                        <span>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                        </span>
                                                        <span class="text-right"><a href="#" class="reply"><i
                                                                    class="icon-reply"></i></a></span>
                                                    </p>
                                                    <p>When she reached the first hills of the Italic Mountains, she had
                                                        a last view back on the skyline of her hometown Bookmarksgrov
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="review d-flex">
                                                <div class="user-img"
                                                    style="background-image: url({{ asset('images/person_2.jpg') }})">
                                                </div>
                                                <div class="desc">
                                                    <h4>
                                                        <span class="text-left">Jacob Webb</span>
                                                        <span class="text-right">14 March 2018</span>
                                                    </h4>
                                                    <p class="star">
                                                        <span>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                        </span>
                                                        <span class="text-right"><a href="#" class="reply"><i
                                                                    class="icon-reply"></i></a></span>
                                                    </p>
                                                    <p>When she reached the first hills of the Italic Mountains, she had
                                                        a last view back on the skyline of her hometown Bookmarksgrov
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="review d-flex">
                                                <div class="user-img"
                                                    style="background-image: url({{ asset('images/person_3.jpg') }})">
                                                </div>
                                                <div class="desc">
                                                    <h4>
                                                        <span class="text-left">Jacob Webb</span>
                                                        <span class="text-right">14 March 2018</span>
                                                    </h4>
                                                    <p class="star">
                                                        <span>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                        </span>
                                                        <span class="text-right"><a href="#" class="reply"><i
                                                                    class="icon-reply"></i></a></span>
                                                    </p>
                                                    <p>When she reached the first hills of the Italic Mountains, she had
                                                        a last view back on the skyline of her hometown Bookmarksgrov
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="rating-wrap">
                                                <h3 class="head">Give a Review</h3>
                                                <div class="wrap">
                                                    <p class="star">
                                                        <span>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            (98%)
                                                        </span>
                                                        <span>20 Reviews</span>
                                                    </p>
                                                    <p class="star">
                                                        <span>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            (85%)
                                                        </span>
                                                        <span>10 Reviews</span>
                                                    </p>
                                                    <p class="star">
                                                        <span>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            (70%)
                                                        </span>
                                                        <span>5 Reviews</span>
                                                    </p>
                                                    <p class="star">
                                                        <span>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            (10%)
                                                        </span>
                                                        <span>0 Reviews</span>
                                                    </p>
                                                    <p class="star">
                                                        <span>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            <i class="ion-ios-star"></i>
                                                            (0%)
                                                        </span>
                                                        <span>0 Reviews</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pt">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                        <span class="subheading">Choose Car</span>
                        <h2 class="mb-2">Related Cars</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($cars as $item)
                        @php
                            if (isset($item->getMedia('photo_attachment')[0])) {
                                $imageUrl = $item->getMedia('photo_attachment')[0]->getUrl();
                            } else {
                                $imageUrl =
                                    'https://ui-avatars.com/api/?background=eae8fd&color=7367f0&name=' . $car->name;
                            }
                        @endphp
                        <div class="col-md-4">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end"
                                    style="background-image: url({{ $imageUrl }});">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">{{ ucfirst($item->name) }}</a></h2>
                                    <div class="d-flex mb-3">
                                        <span class="cat">{{ $item->category->name ?? '-' }}</span>
                                        <p class="price ml-auto">${{ numberFormat($item->full_day_rate_with_fuel) }}
                                            <span>/day</span>
                                        </p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a
                                            href="{{ route('car-booking', ['id' => $item->id]) }}"
                                            class="btn btn-primary py-2 mr-1">Book now</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-5">
                        <div class="col text-center">
                            {{ $cars->links('pagination::bootstrap-4') }}
                        </div>
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

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Flatpickr
                flatpickr("#book_pick_date_flatpicker", {
                    dateFormat: "Y-m-d",
                    onChange: calculateFare
                });
                flatpickr("#book_off_date_flatpicker", {
                    dateFormat: "Y-m-d",
                    onChange: calculateFare
                });

                const rentTypeSelect = document.getElementById('rent_type');
                const kmGroup = document.getElementById('km_group');
                const daysGroup = document.getElementById('days_group');
                const totalKmInput = document.getElementById('total_km');
                const carRateInput = document.getElementById('car_rate');
                const totalFareInput = document.getElementById('total_fare');
                const pickUpDateInput = document.getElementById('book_pick_date_flatpicker');
                const dropOffDateInput = document.getElementById('book_off_date_flatpicker');
                const totalDaysInput = document.getElementById('total_days');
                const discountGroup = document.getElementById('discount_group');
                const discountInput = document.getElementById('discount');

                const perDayRate = {{ $car->full_day_rate_with_fuel }};
                const perKmRate = {{ $car->per_km_rate_with_fuel }};
                const discountPercentage = {{ $user->disount_percentage }}; // Example discount percentage

                const rentalCount = {{ $rentalCount }}; // Dynamically passed from the controller
                // Assuming this is passed from the controller
                const dicount_on_number_of_bookings_per_month = {{ $user->dicount_on_number_of_bookings_per_month }};

                function calculateFare() {
                    const rentType = rentTypeSelect.value;
                    let totalFare = 0;
                    let totalDays = 0;
                    let discount = 0;

                    const pickUpDate = new Date(pickUpDateInput.value);
                    const dropOffDate = new Date(dropOffDateInput.value);

                    if (!isNaN(pickUpDate) && !isNaN(dropOffDate) && pickUpDate <= dropOffDate) {
                        const timeDiff = Math.abs(dropOffDate - pickUpDate);
                        totalDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    }

                    if (rentType === 'per_day') {
                        totalFare = totalDays * perDayRate;
                        totalDaysInput.value = totalDays;
                        daysGroup.style.display = 'block';
                    } else if (rentType === 'per_km') {
                        const totalKm = parseFloat(totalKmInput.value) || 0;
                        totalFare = totalKm * perKmRate;
                        daysGroup.style.display = 'none';
                    }

                    if (rentalCount >= dicount_on_number_of_bookings_per_month) {
                        discount = (totalFare * discountPercentage) / 100;
                        discountGroup.style.display = 'block';
                        discountInput.value = discountPercentage;
                    } else {
                        discountGroup.style.display = 'none';
                    }

                    totalFare = totalFare - discount;
                    totalFareInput.value = totalFare.toFixed(2);
                }

                rentTypeSelect.addEventListener('change', function() {
                    if (this.value === 'per_km') {
                        kmGroup.style.display = 'block';
                    } else {
                        kmGroup.style.display = 'none';
                    }
                    calculateFare();
                });

                totalKmInput.addEventListener('input', calculateFare);
                pickUpDateInput.addEventListener('input', calculateFare);
                dropOffDateInput.addEventListener('input', calculateFare);

                calculateFare();
            });
        </script>
