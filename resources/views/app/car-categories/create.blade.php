@extends('layouts/layoutMaster')

@section('title', 'Create Car Category')

@section('page-vendor')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/signature-pad/css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/signature-pad/css/signature.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/libs/intel-tel-input/intlTelInput.css') }}">

@endsection
@section('page-css')

    <style>
        .iti {
            width: 100%;
        }

        .intl-tel-input {
            display: table-cell;
        }

        .intl-tel-input .selected-flag {
            z-index: 4;
        }

        .intl-tel-input .country-list {
            z-index: 5;
        }

        .kbw-signature {
            width: 760px;
            height: auto;
        }

        #sig canvas {
            width: 760px !important;
            height: auto;
        }
    </style>
@endsection

{{-- @section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Create User</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('car-categories.create', encryptParams($site_id)) }}
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@section('content')
    <form id="userForm" class="form form-vertical" class="signature-form" enctype="multipart/form-data"
        action="{{ route('car-categories.store') }}" method="POST">
        <input type="hidden" id="signer_id" name="signer_id">
        <input type="hidden" name="method" value="sign_now">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 position-relative">

                @csrf
                {{ view('app.car-categories.form-fields', [

                ]) }}

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 position-relative">
                <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                    <div class="card-body">


                        @can('car-categories.store')
                            <button type="submit" id="SaveUserBtn"
                                class="btn w-100 btn-outline-success waves-effect waves-float waves-light buttonToBlockUI mb-2">
                                <i data-feather='save'></i>
                                Save
                            </button>
                        @endcan
                        <a href="{{ route('car-categories.index') }}"
                            class="btn w-100 btn-outline-danger waves-effect waves-float waves-light mb-2">
                            <i data-feather='x'></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection

@section('vendor-js')

@endsection

@section('page-js')

    <script src="{{ asset('assets/vendor/libs/jquery/validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/intel-tel-input/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/intel-tel-input/utils.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/signature-pad/js/jquery-ui.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/libs/signaturePad/signature-pad.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/libs/signature-pad/js/signature_pad.js') }}"></script> --}}
@endsection

@section('custom-js')
    <script></script>
@endsection
