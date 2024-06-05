@extends('layouts/layoutMaster')

@section('title', 'Car Location')

@section('page-vendor')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

@endsection

@section('page-css')
    <style>
        #map {
            height: 400px;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>
@endsection

@section('page-js')

@endsection
@section('custom-js')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Replace YOUR_LATITUDE and YOUR_LONGITUDE with actual values
        // var latitude = 32.9328;
        // var longitude = 72.8630;

        var latitude = '{{ $car->latitude }}';
        var longitude = '{{ $car->longitude }}';

        var map = L.map('map').setView([latitude, longitude], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Marker')
            .openPopup();
    </script>
@endsection
