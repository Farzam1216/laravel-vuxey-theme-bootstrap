@extends('layouts/layoutMaster')

{{-- @section('seo-breadcrumb')
<h4 class="fw-bold py-3 mb-4 "><span class="text-muted fw-light">{{ Breadcrumbs::view('breadcrumbs::json-ld',
    'roles.index') }}</span> </h4>

@endsection --}}

@section('title', 'Car Booking Details')

@section('page-vendor')

@endsection

@section('page-css')
    {{--
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css"> --}}
@endsection

@section('page-css')
@endsection

@section('content')
    <p class="mb-2">

    </p>
    <div class="card">
        <div class="card-body">
            <form id="roles-table-form" method="get">
                {{ $dataTable->table() }}
            </form>
        </div>
    </div>

@endsection

@section('vendor-js')

@endsection

@section('page-js')
    {{ $dataTable->scripts() }}

@endsection
