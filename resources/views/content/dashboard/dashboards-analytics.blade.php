@extends('layouts/layoutMaster')

@section('title', 'Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}">
    <style>
        /* .car-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        } */
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')

    {{-- <div class="container">
        <h1 class="text-center my-4">Choose Your Car for Rent</h1>
        <div class="row">
            @foreach ($cars as $car)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">

                        <img class="card-img-top" src="{{ $image }}" alt="{{ $car->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="card-text">{{ $car->description }}</p>
                            <p class="card-text"><strong>Price per day:</strong> ${{ $car->price }}</p>
                            <form method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Rent This Car</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}

    <div class="container">
        <h1 class="text-center my-4">Choose Your Car for Rent</h1>
        <div class="row">
            @foreach ($cars as $car)
                @php
                    if (isset($car->getMedia('photo_attachment')[0])) {
                        $image = $car->getMedia('photo_attachment')[0]->getUrl();
                    } else {
                        $image = 'https://ui-avatars.com/api/?background=eae8fd&color=7367f0&name=' . $car->name;
                    }
                @endphp
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="card-img-top car-image" src="{{ $image }}" alt="{{ $car->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="card-text">{{ $car->description }}</p>
                            <p class="card-text"><strong>Price per day:</strong> ${{ $car->price }}</p>
                            <button type="button" class="btn btn-secondary mb-2" data-toggle="modal"
                                data-target="#viewImagesModal{{ $car->id }}">
                                View More Images
                            </button>
                            <form method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Rent This Car</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal for viewing more images -->
                <div class="modal fade" id="viewImagesModal{{ $car->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="viewImagesModalLabel{{ $car->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewImagesModalLabel{{ $car->id }}">More Images of
                                    {{ $car->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="carousel{{ $car->id }}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($car->getMedia('other_attachments') as $index => $additional_image)
                                            <div class="carousel-item @if ($index === 0) active @endif">
                                                <img class="d-block w-100" src="{{ $additional_image->getUrl() }}"
                                                    alt="Image {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel{{ $car->id }}" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel{{ $car->id }}" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
