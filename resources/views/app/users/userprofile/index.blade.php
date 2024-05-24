@extends('layouts/layoutMaster')

@section('title', 'User Profile - Profile')

@section('page-vendor')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jstree/jstree.css') }}" />
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')) }}">
    <link rel="stylesheet"
        href="{{ asset(mix('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')) }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/signature-pad/css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/signature-pad/css/signature.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/libs/intel-tel-input/intlTelInput.css') }}">
@endsection
@section('breadcrumb')
    <h4 class="fw-bold"><span class="text-muted fw-light">User /</span> Profile</h4>
@endsection
<!-- Page -->
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('content')
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">

                        @php
                            $avatar = getUserThumbPhoto(Auth::id());
                            if (is_null($avatar)) {
                                $avatar =
                                    'https://ui-avatars.com/api/?background=eae8fd&color=7367f0&name=' .
                                    Auth::user()->name;
                            }
                        @endphp
                        <img src="{{ $avatar }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                        {{-- <span class="text-muted" style="margin-left: 60px">
                            {{ $user->designation ?? '-' }}
                        </span> --}}

                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5 c_flex">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info w-100">
                                <div class="d-flex c_profile_drop mb-3">
                                    <h4 class="">
                                        {{ $user->name }}
                                    </h4>
                                </div>

                                <div class="w-100 c_header_2">
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class="ti ti-user text-heading"></i> <span> {{ $user->name }}</span>
                                        </li>
                                        @if ($user->designation)
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class="ti ti-color-swatch"></i><span>{{ $user->designation }}</span>
                                            </li>
                                        @endif
                                        @if ($user->email)
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class="ti ti-mail"></i><span>{{ $user->email }}</span>
                                            </li>
                                        @endif
                                        @if ($user->contact)
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class="ti ti-phone-call"></i><span>{{ $user->contact }}</span>
                                            </li>
                                        @endif
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class='ti ti-calendar'></i>
                                            {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    {{-- @if (Route::currentRouteName() == 'internal-agents.profile') --}}
    <div class="bs-stepper vertical wizard-vertical-icons-example">
        <div class="bs-stepper-header p-1 m-1">
            <div class="step" data-target="#user-profile-tab">
                <button type="button" class="step-trigger" id="user-profile-tab-btn">
                    <span class="bs-stepper-circle">
                        <i class="tf-icons ti ti-file-analytics"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">User Profile</span>
                        <span class="bs-stepper-subtitle">View User Profile</span>
                    </span>
                </button>
            </div>

            <div class="line"></div>
            <div class="step" data-target="#user-attendance-tab">
                <button type="button" class="step-trigger" id="attendance-tab-btn">
                    <span class="bs-stepper-circle">
                        <i class="fa-solid fa-clipboard-user"></i> </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Attendance</span>
                        <span class="bs-stepper-subtitle">My Attendance</span>
                    </span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#user-salary-tab">
                <button type="button" class="step-trigger" id="user_salary">
                    <span class="bs-stepper-circle">
                        <i class="tf-icons ti ti-file-analytics"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Salary Increment Details</span>
                        <span class="bs-stepper-subtitle">View Salary Increment Details </span>
                    </span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#user-payroll-tab">
                <button type="button" class="step-trigger" id="user_payroll">
                    <span class="bs-stepper-circle">
                        <i class="tf-icons ti ti-file-analytics"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Payroll Details</span>
                        <span class="bs-stepper-subtitle">View Payroll Details </span>
                    </span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#leave-policy-tab">
                <button type="button" class="step-trigger" id="leave_policy">
                    <span class="bs-stepper-circle">
                        <i class="tf-icons ti ti-calendar-off"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Leaves Managment</span>
                        <span class="bs-stepper-subtitle">View Leaves Managment </span>
                    </span>
                </button>
            </div>
            <div class="line"></div>
        </div>

        <div class="bs-stepper-content c_online_payment_tab"
            style="width: 100%;max-width: 79% !important; min-width: 60%;">

            <div id="user-profile-tab" class="content">
                <div class="content-header mb-3">
                    <div class="c_heading_bold_right_stepper">

                        <div class="card mb-1">
                            <div class="card-body">
                                <ul class="nav nav-pills mb-2" id="approvalTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="personal-information" data-bs-toggle="tab"
                                            href="#personal-information-datas" aria-controls="home" role="tab"
                                            aria-selected="true">
                                            <i class="fa-regular fa-user mx-1"></i>
                                            <span class="fw-bold ms-1">Personal Info </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address-datas"
                                            aria-controls="home" role="tab" aria-selected="false">
                                            <i class="fa-solid fa-location-dot mx-1"></i>
                                            <span class="fw-bold">Address Details </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="attachment-tab" data-bs-toggle="tab"
                                            href="#attachment-datas" aria-controls="home" role="tab"
                                            aria-selected="false">
                                            <i class="fa-solid fa-paperclip mx-1"></i> <span class="fw-bold">Attachments
                                            </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="password-tab" data-bs-toggle="tab"
                                            href="#password-datas" aria-controls="home" role="tab"
                                            aria-selected="false">
                                            <i class="fa-solid fa-key mx-1"></i> <span class="fw-bold">Password
                                            </span></a>
                                    </li>

                                </ul>
                                <div class="tab-content">

                                    {{-- Personal Info  --}}
                                    <div class="tab-pane active" id="personal-information-datas"
                                        aria-labelledby="personal-information" role="tabpanel">

                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <form enctype="multipart/form-data" id="MyForm">
                                                    <input type="hidden" name="selected_tab" value="personal">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                    @csrf
                                                    <div class="row mb-1 align-items-end">
                                                        <div class="col-lg-4 col-md-4 position-relative">
                                                            <label class="form-label fs-6" for="name">Full Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control form-control-md fs-6 @error('name') is-invalid @enderror"
                                                                id="name" name="name" placeholder="Full Name"
                                                                value="{{ isset($user) ? $user->name : old('name') }}"
                                                                required />
                                                            <small class="text-muted">Enter Full Name</small>
                                                            @error('name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 position-relative">
                                                            <label class="form-label fs-6" for="father_name">Father /
                                                                Husband
                                                                Name <span
                                                                    class="text-danger showRequired">*</span></label>
                                                            <input type="text"
                                                                class="form-control form-control-md fs-6 @error('father_name') is-invalid @enderror"
                                                                id="father_name" name="father_name"
                                                                placeholder="Father / Husband Name"
                                                                value="{{ isset($user) ? $user->father_name : old('father_name') }}"
                                                                required />
                                                            <small class="text-muted">Enter Father / Husband Name</small>
                                                            @error('father_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                                                            <label class="form-label fs-6" for="cnic">CNIC | Passport
                                                                No |
                                                                ID <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="cp_cnic form-control form-control-md fs-6 @error('cnic') is-invalid @enderror"
                                                                id="cnic" name="cnic"
                                                                placeholder="CNIC Without Dashes"
                                                                value="{{ isset($user) ? $user->cnic : old('cnic') }}"
                                                                required />
                                                            <small class="text-muted">Enter CNIC | Passport No | ID</small>
                                                            @error('cnic')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 position-relative  mt-1">
                                                            <label class="form-label fs-6" for="type_name">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="email"
                                                                class="form-control form-control-md fs-6 @error('email') is-invalid @enderror"
                                                                id="email" name="email" placeholder="Email"
                                                                autocomplete="false"
                                                                value="{{ isset($user) ? $user->email : old('email') }}"
                                                                required />
                                                            <small class="text-muted">Enter Email</small></br>
                                                            @error('email')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 position-relative mt-1">
                                                            <label class="form-label fs-6" for="ntn">NTN </label>
                                                            <input type="number"
                                                                class="form-control form-control-md fs-6 @error('ntn') is-invalid @enderror"
                                                                id="ntn" name="ntn" placeholder="NTN Number"
                                                                value="{{ isset($user) ? $user->ntn : old('ntn') }}" />
                                                            <small class="text-muted">Enter National Tax
                                                                Number</small></br>
                                                            @error('ntn')
                                                                <div class="invalid-feedback ">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 position-relative mt-1">
                                                            <label class="form-label fs-6" for="office_email">Office
                                                                Email</label>
                                                            <input type="email"
                                                                class="form-control form-control-md fs-6 @error('office_email') is-invalid @enderror"
                                                                id="office_email" name="office_email"
                                                                placeholder="Office Email" autocomplete="false"
                                                                value="{{ isset($user) ? $user->office_email : old('office_email') }}" />
                                                            <small class="text-muted">Enter Office Email</small>
                                                            @error('office_email')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 position-relative mt-1">
                                                            <label class="form-label fs-6" for="designation">Designation
                                                            </label>
                                                            <input type="text"
                                                                class="form-control form-control-md fs-6 @error('designation') is-invalid @enderror"
                                                                id="designation" name="designation"
                                                                placeholder="Designation"
                                                                value="{{ isset($user) ? $user->designation : old('designation') }}"
                                                                readonly />
                                                            <small class="text-muted">Enter Designation</small>
                                                            @error('designation')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-lg-4 col-md-4 col-sm-4 mt-1">
                                                            <label class="form-label fs-6" for="contact">Mobile Contact #
                                                                <span class="text-danger">*</span></label>
                                                            <input type="tel"
                                                                class="form-control form-control-md ContactNoError @error('contact') is-invalid @enderror"
                                                                id="contact" name="contact" placeholder=""
                                                                value="{{ isset($user) ? $user->contact : old('contact') }}"
                                                                required />
                                                            <small class="text-muted">Enter Contact Number</small>
                                                            @error('contact')
                                                                <div class="invalid-feedback ">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <input type="hidden" name="countryDetails" id="countryDetails">

                                                        <div class="col-lg-4 col-md-4 col-sm-4 mt-1">
                                                            ( <span class="text-primary" id="change_mobile_number">Same as
                                                                Mobile Number
                                                            </span> ) <input type="checkbox" id="copy_mobile_number" />
                                                            <label class="form-label fs-6" for="contact">Whatsapp Contact
                                                                #<span class="text-danger">*</span></label>
                                                            <input type="tel"
                                                                class="form-control form-control-md OPTContactNoError @error('optional_contact') is-invalid @enderror"
                                                                id="optional_contact" name="optional_contact"
                                                                placeholder=""
                                                                value="{{ isset($user) ? $user->optional_contact : old('optional_contact') }}"
                                                                required />
                                                            <small class="text-muted">Enter Whatsapp Contact Number
                                                            </small>
                                                            @error('optional_contact')
                                                                <div class="invalid-feedback ">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- <div class="col-lg-4 col-md-4 col-sm-5 position-relative my-0">
                                                            <label class="form-label  fs-6" style="font-size: 15px"
                                                                for="employment_status_id">Employment
                                                                Status<span class="text-danger">*</span></label>
                                                            <select class="form-select select2 form-select-lg fs-6"
                                                                id="employment_status_id" name="employment_status_id"
                                                                placeholder="Employment Status">
                                                                <option value="">Select Employment Status</option>
                                                                @foreach ($employmentstatus as $key => $employment)
                                                                    <option value="{{ $employment->id }}"
                                                                        {{ isset($user) && $employment->id == $user->employment_status_id ? 'selected' : '' }}>
                                                                        {{ $employment->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <small class="text-muted">Select Employment Status</small>

                                                            @error('employment_status_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 position-relative ">
                                                            <label class="form-label fs-6" for="hiring_date">Hiring
                                                                Date<span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control form-control-md flatpickr-range flatpickr-input active filter_date_ranger @error('hiring_date') is-invalid @enderror"
                                                                id="hiring_date" name="hiring_date"
                                                                @if (isset($user)) value="{{ $user->hiring_date }}" @endif
                                                                placeholder="YYYY-MM-DD" />
                                                            <small class="text-muted">Select Date of hiring</small>
                                                            @error('hiring_date')
                                                                <div class="invalid-tooltip">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-5 position-relative my-0">
                                                            <label class="form-label  fs-6" style="font-size: 15px"
                                                                for="employment_status_id">Select Pay Schedule
                                                            </label>
                                                            <select class="form-select select2 form-select-lg fs-6"
                                                                id="pay_schedule_id" name="pay_schedule_id"
                                                                placeholder="Employment Status">
                                                                <option value="">Select Pay Schedule</option>
                                                                @foreach ($paySchedules as $key => $paySchedule)
                                                                    <option value="{{ $paySchedule->id }}"
                                                                        {{ isset($user) && $paySchedule->id == $user->pay_schedule_id ? 'selected' : '' }}>
                                                                        {{ $paySchedule->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <small class="text-muted">Select Pay Schedule</small>

                                                            @error('pay_schedule_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div> --}}
                                                        <div class="col-lg-4 col-md-4 col-sm-4 position-relative mt-1">
                                                            <label class="form-label fs-6" for="dob">Date of
                                                                Birth</label>
                                                            <input type="text"
                                                                class="form-control form-control-md  @error('date_of_birth') is-invalid @enderror"
                                                                id="dob" name="date_of_birth"
                                                                @if (isset($user)) value="{{ $user->date_of_birth }}" @endif
                                                                placeholder="YYYY-MM-DD" />
                                                            <small class="text-muted">Select Date of Birth</small>
                                                            @error('date_of_birth')
                                                                <div class="invalid-tooltip">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="d-flex align-items-center justify-content-end">
                                                            <button type="submit"
                                                                onclick="UserUpdated('{{ $user->id }}')"
                                                                class="btn btn-outline-success waves-effect waves-float waves-light me-1">
                                                                <i data-feather='save'></i>
                                                                Update
                                                            </button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Address Details --}}
                                    <div class="tab-pane" id="address-datas" aria-labelledby="address-tab"
                                        role="tabpanel">

                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <form enctype="multipart/form-data" id="AddressForm">
                                                    <input type="hidden" name="selected_tab" value="Address">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    @csrf

                                                    <div class="card-body">

                                                        <div class="row mb-1">
                                                            <div class="col">
                                                                <h4 class="mb-1" id="change_residential_txt"
                                                                    class="change_residential_txt"><u>Residential
                                                                        Address</u></h4>
                                                                <span>‎</span>
                                                                <div class="row">
                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="residential_address_type">Address
                                                                            Type <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <input type="text"
                                                                            class="form-control form-control-md @error('residential.address_type') is-invalid @enderror"
                                                                            id="residential_address_type"
                                                                            name="residential[address_type]"
                                                                            placeholder="Address Type"
                                                                            value="{{ isset($user) ? $user->residential_address_type : old('residential.address_type') }}" />
                                                                        <small class="text-muted">Enter Address
                                                                            Type</small></br>
                                                                        @error('residential.address_type')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="residential_country">Select
                                                                            Country <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <select class="form-select"
                                                                            id="residential_country"
                                                                            name="residential[country]">
                                                                            <option value="0" selected>Select Country
                                                                            </option>
                                                                            @if (isset($country))
                                                                                @foreach ($country as $countryRow)
                                                                                    <option
                                                                                        @if (isset($user) && $user->residential_country_id == $countryRow->id) selected @endif
                                                                                        value="{{ $countryRow->id }}">
                                                                                        {{ $countryRow->name }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                        <small class="text-muted">Select Residential
                                                                            Country</small><br>
                                                                        @error('residential.country')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="residential_state">Select
                                                                            State <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <select class="select2" id="residential_state"
                                                                            name="residential[state]">
                                                                            <option value="0" selected>Select State
                                                                            </option>
                                                                        </select>
                                                                        <small class="text-muted">Select Residential
                                                                            State</small><br>
                                                                        @error('residential.state')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="residential_city">Select City
                                                                            <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <select class="select2" id="residential_city"
                                                                            name="residential[city]">
                                                                            <option value="0" selected>Select City
                                                                            </option>
                                                                        </select>
                                                                        <small class="text-muted">Select Residential
                                                                            City</small><br>
                                                                        @error('residential.city')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="residential_postal_code">Postal
                                                                            Code
                                                                            <span class="text-danger showRequired">*</span>
                                                                        </label>
                                                                        <input type="number"
                                                                            class="form-control form-control-md @error('residential.postal_code') is-invalid @enderror"
                                                                            id="residential_postal_code"
                                                                            name="residential[postal_code]"
                                                                            placeholder="Postal Code"
                                                                            value="{{ isset($user) ? $user->residential_postal_code : old('residential.postal_code') }}" />
                                                                        <small class="text-muted">Enter Postal
                                                                            Code</small><br>
                                                                        @error('residential.postal_code')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative">
                                                                        <label class="form-label fs-6"
                                                                            for="residential_address">Address<span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <textarea class="form-control @error('residential_address') is-invalid @enderror" name="residential[address]"
                                                                            id="residential_address" rows="3" placeholder="Address">{{ isset($user) ? $user->residential_address : old('residential.address') }}</textarea>
                                                                        <small class="text-muted">Enter Residential
                                                                            Address</small><br>
                                                                        @error('residential.address')
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">

                                                                <h4 class="mb-1" id="change_mailing_txt"
                                                                    class="change_mailing_txt">
                                                                    <u>Mailing Address</u>
                                                                </h4>
                                                                ( <span class="text-primary" id="change_mailing_btn">Same
                                                                    as
                                                                    Residential Address </span> ) <input type="checkbox"
                                                                    id="cpyAddress" />

                                                                <div class="row">
                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="mailing_address_type">Address
                                                                            Type <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <input type="text"
                                                                            class="form-control form-control-md @error('occupation') is-invalid @enderror"
                                                                            id="mailing_address_type"
                                                                            name="mailing[address_type]"
                                                                            placeholder="Address Type"
                                                                            value="{{ isset($user) ? $user->mailing_address_type : old('mailing.address_type') }}" />
                                                                        <small class="text-muted">Enter Address
                                                                            Type</small><br>
                                                                        @error('mailing.address_type')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="mailing_country">Select
                                                                            Country <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <select class="select2" id="mailing_country"
                                                                            name="mailing[country]">
                                                                            <option value="0" selected>Select Country
                                                                            </option>
                                                                            @foreach ($country as $countryRow)
                                                                                <option
                                                                                    @if (isset($user) && $user->mailing_country_id == $countryRow->id) selected @endif
                                                                                    value="{{ $countryRow->id }}">
                                                                                    {{ $countryRow->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <small class="text-muted">Select Mailing
                                                                            Country</small><br>
                                                                        @error('mailing.country')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="mailing_state">Select State <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <select class="select2" id="mailing_state"
                                                                            name="mailing[state]">
                                                                            <option value="0" selected>Select State
                                                                            </option>
                                                                        </select>
                                                                        <small class="text-muted">Select Mailing
                                                                            State</small><br>
                                                                        @error('mailing.state')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="mailing_city">Select City <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <select class="select2" id="mailing_city"
                                                                            name="mailing[city]">
                                                                            <option value="0" selected>Select City
                                                                            </option>
                                                                        </select>
                                                                        <small class="text-muted">Select Mailing
                                                                            City</small><br>
                                                                        @error('mailing.city')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative mb-1">
                                                                        <label class="form-label fs-6"
                                                                            style="font-size: 15px"
                                                                            for="mailing_postal_code">Postal Code
                                                                            <span class="text-danger showRequired">*</span>
                                                                        </label>
                                                                        <input type="number"
                                                                            class="form-control form-control-md @error('mailing.postal_code') is-invalid @enderror"
                                                                            id="mailing_postal_code"
                                                                            name="mailing[postal_code]"
                                                                            placeholder="Postal Code"
                                                                            value="{{ isset($user) ? $user->mailing_postal_code : old('mailing.postal_code') }}" />
                                                                        <small class="text-muted">Enter Postal
                                                                            Code</small><br>
                                                                        @error('mailing.postal_code')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-12 col-md-12 col-sm-12 position-relative">
                                                                        <label class="form-label fs-6"
                                                                            for="mailing.mailingAddress">Address <span
                                                                                class="text-danger showRequired">*</span></label>
                                                                        <textarea class="form-control @error('mailingAddress') is-invalid @enderror" name="mailing[mailingAddress]"
                                                                            id="mailing_Address" rows="3" placeholder="Address">{{ isset($user) ? $user->mailingAddress : old('mailing.address') }}</textarea>
                                                                        <small class="text-muted">Enter Mailing
                                                                            Address</small><br>
                                                                        @error('mailing.mailingAddress')
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-lg col-md col-sm position-relative">
                                                                <label class="form-label fs-6"
                                                                    for="comments">Comments</label>
                                                                <textarea class="form-control @error('comments') is-invalid @enderror" name="comments" id="comments"
                                                                    rows="3" placeholder="Comments">{{ isset($user) ? $user->comments : old('comments') }}</textarea>
                                                                <small class="text-muted">Enter Comments</small><br>
                                                                @error('comments')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        <div class="d-flex align-items-center justify-content-end">
                                                            <button type="submit"
                                                                onclick="UserAddressUpdated('{{ $user->id }}')"
                                                                class="btn btn-outline-success waves-effect waves-float waves-light me-1">
                                                                <i data-feather='save'></i>
                                                                Update
                                                            </button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Attachment  --}}
                                    <div class="tab-pane" id="attachment-datas" aria-labelledby="attachment-tab"
                                        role="tabpanel">

                                        <div class="card mb-4">
                                            <div class="card-body">

                                                <form enctype="multipart/form-data" id="attachments">
                                                    <input type="hidden" name="selected_tab" value="attachments">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    @csrf

                                                    <div class="col-lg-12 col-md-12 col-sm-12 position-relative">

                                                        <div class="d-block mb-1">
                                                            <label class="form-label fs-5" for="attachment">Profile
                                                                Photo</label>
                                                            <input id="photo_attachment" type="file"
                                                                class="filepond @error('photo_attachment') is-invalid @enderror"
                                                                name="photo_attachment" accept="image/png, image/jpeg" />
                                                            <small class="text-muted">Upload Profile Photo</small>
                                                            @error('photo_attachment')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <hr>
                                                        <div class="d-block mb-1">
                                                            <label class="form-label fs-5" for="attachment">CV
                                                                Attachment</label>
                                                            <input id="cv_attachment" type="file"
                                                                class="filepond @error('cv_attachment') is-invalid @enderror"
                                                                name="cv_attachment[]" accept="application/pdf" />
                                                            <small class="text-muted">Upload PDF file only</small>
                                                            @error('cv_attachment')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <hr>
                                                        <div class="d-block mb-1">
                                                            <label class="form-label fs-5" for="sign_attachment">Signature
                                                                Attachment </label>
                                                            <input id="sign_attachment" type="file"
                                                                class="filepond @error('sign_attachment') is-invalid @enderror"
                                                                name="sign_attachment" accept="image/png, image/jpeg" />
                                                            <small class="text-muted">Upload Signature Attachment
                                                            </small>
                                                            @error('sign_attachment')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="card-footer">
                                                        <div class="d-flex align-items-center justify-content-end">
                                                            <button type="button"
                                                                onclick="UserAttachmentUpdated('{{ $user->id }}')"
                                                                class="btn btn-outline-success waves-effect waves-float waves-light me-1">
                                                                <i data-feather='save'></i>
                                                                Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    {{-- password  --}}
                                    <div class="tab-pane" id="password-datas" aria-labelledby="password-tab"
                                        role="tabpanel">

                                        <div class="card mb-4">
                                            <div class="card-body">

                                                <form enctype="multipart/form-data" id="password-form">
                                                    <input type="hidden" name="selected_tab" value="password">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    @csrf

                                                    <div class="d-block mb-1">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 position-relative mt-1">
                                                            <label class="form-label fs-6" for="type_name">Password <span
                                                                    class="text-danger">*</span></label>

                                                            <input id="password" type="password"
                                                                class="form-control fs-6 form-control-md @error('password') is-invalid @enderror"
                                                                name="password" id="password" placeholder="Password"
                                                                autocomplete="false">
                                                            <small class="text-muted">Enter Password</small></br>

                                                            @error('password')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 position-relative mt-1">
                                                        <label for="password-confirm" class="form-label fs-6">Confirm
                                                            Password <span class="text-danger">*</span></label>
                                                        <input id="password-confirm"
                                                            class="form-control form-control-md fs-6" type="password"
                                                            class="form-control" placeholder="Confirm Password"
                                                            name="password_confirmation">
                                                        <small class="text-muted">Re-Enter Password</small>
                                                    </div>

                                                    <div class="card-footer">
                                                        <div class="d-flex align-items-center justify-content-end">
                                                            <button type="submit"
                                                                onclick="UserpasswordUpdated('{{ $user->id }}')"
                                                                class="btn btn-outline-success waves-effect waves-float waves-light me-1">
                                                                <i data-feather='save'></i>
                                                                Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                    {{-- end of password --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            {{-- user address end  --}}
            <div id="user-salary-tab" class="content">
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table" id="user_salary_increment_detail">
                        </table>
                    </div>
                </div>
            </div>
            <div id="user-payroll-tab" class="content">
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table" id="user_payroll_detail">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-nowrap">#</th>
                                    <th class="text-nowrap">User</th>
                                    <th class="text-nowrap">Month Year</th>
                                    <th class="text-nowrap">Basic Salary</th>
                                    <th class="text-nowrap">Total Allowance</th>
                                    <th class="text-nowrap">Total Tax</th>
                                    <th class="text-nowrap">Total Bonus</th>
                                    <th class="text-nowrap">Deduction</th>
                                    <th class="text-nowrap">Total Custom Deduction</th>
                                    <th class="text-nowrap">Total Working Days</th>
                                    <th class="text-nowrap">Total Presents</th>
                                    <th class="text-nowrap">Total Leaves</th>
                                    <th class="text-nowrap">Total Holidays</th>
                                    <th class="text-nowrap">Total Weekends</th>
                                    <th class="text-nowrap">Total Payable Days</th>
                                    <th class="text-nowrap">Per Day Salary </th>
                                    <th class="text-nowrap">Net Payable</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">Created At</th>
                                    <th class="text-nowrap">Updated At</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div id="user-attendance-tab" class="content">
                <div class="content-header mb-3">
                    <div class="c_heading_bold_right_stepper ">Attendance</div>
                </div>
                <div class="row">
                    <div class="col-md-4 ps-1 col-lg-4 col-sm-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                Hours Worked Today
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $TodaysAttendance ?? 0 }} hrs

                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="card mb-3">
                            <div class="card-header">

                                Total Weekly Working Time:
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"> {{ $totalWeeklyHours ?? 0 }} hrs</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 pe-0">
                        <div class="card mb-3">
                            <div class="card-header">
                                Hours Worked This Month:
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $totalMonthlyHours ?? 0 }} hrs
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="card mb-3">
                        <h3 class="card-header">Today's Attendance</h3>
                        <div class="card-body">
                            <table class="table" id="toDay_Attendance">
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="card-header">Monthly Attendance</h3>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
            <div id="leave-policy-tab" class="content">
                <div class="content-header mb-3">
                    <h5>
                        <span>Leave Policy</span>
                        {{-- @can('sites.hrm.leave-policy.leave-request') --}}
                        <span class="float-end"><a
                                href="{{ route('leave-request', ['site_id' => encryptParams($site_id), 'id' => $user->id]) }}"
                                class="btn btn-primary btn-sm">
                                {{-- <i class="ti ti-question-mark ti-sm"></i> --}}
                                Request For
                                Leave</a>
                        </span>
                        {{-- @endcan --}}
                    </h5>
                </div>
                <div class="row">
                    <div class="col-md-4 ps-1 col-lg-4 col-sm-12">
                        <div class="card mb-3">
                            <div class="card-header header-elements">
                                <span class=" me-2">Total Leaves</span>
                                <div class="card-header-elements ms-auto">
                                    <a class="text-primary" id="info"
                                        onclick="leaveDetails({{ Auth::id() }}, 'user_profile', 'all_leaves')"
                                        href="javascript:void(0);"><i class="ti ti-info-circle"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $total_leaves }} <small class="text-muted">Days</small> /
                                    {{ $total_leaves_hours }} <small class="text-muted">Working Hours</small>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12 pe-0">
                        <div class="card mb-3">
                            <div class="card-header header-elements">
                                <span class=" me-2">Used Leaves</span>
                                <div class="card-header-elements ms-auto">
                                    <a class="text-primary" id="info"
                                        onclick="leaveDetails({{ Auth::id() }}, 'user_profile', 'used_leaves')"
                                        href="javascript:void(0);"><i class="ti ti-info-circle"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $used_leaves ?? 0 }} <small class="text-muted">Days</small> /
                                    {{ $used_leaves_hours }} <small class="text-muted">Working Hours</small>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="card mb-3">
                            <div class="card-header header-elements">
                                <span class=" me-2">Remaining Leaves</span>
                                <div class="card-header-elements ms-auto">
                                    <a class="text-primary" id="info"
                                        onclick="leaveDetails({{ Auth::id() }}, 'user_profile', 'remaining_leaves')"
                                        href="javascript:void(0);"><i class="ti ti-info-circle"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"> {{ $remaining_leaves ?? 0 }} <small
                                        class="text-muted">Days</small> /
                                    {{ $remaining_leaves_hours }} <small class="text-muted">Working Hours</small>
                                </h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- model of reason of leaving  --}}
    <div class="modal fade" id="LeavingReason" tabindex="-1" aria-labelledby="LeavingReasonLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="reason-form" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="reason" class="col-form-label">Reason for Leaving <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="reason" name="reason" required
                                value="{{ old('reason') }}">
                            <span>
                                @error('reason')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary"
                            onclick="timeOutAttenedance('{{ $site_id }}', '{{ $user->id }}')">Save
                            Reason</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- end of leaveing --}}

    {{-- details --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Leave Details</h3>
                    </div>
                    <div id="modal_details"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset(mix('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')) }}"></script>
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jstree/jstree.js') }}"></script>

@endsection
@section('custom-js')
    <script src="{{ asset('assets/js/pages-profile.js') }}"></script>
    {{ $dataTable->scripts() }}
    @include('app.sites.users.userprofile.userProfiel-script')
@section('page-js')

    <script src="{{ asset('assets/vendor/libs/jquery/validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/intel-tel-input/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/intel-tel-input/utils.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/signature-pad/js/jquery-ui.min.js') }}"></script>
@endsection

<script>
    function leaveDetails(id, type, leave_type) {
        if (id > 0) {
            $.ajax({
                type: "post",
                url: "{{ route('sites.own-user-ajax-details', ['site_id' => $site_id, 'id' => ':id']) }}"
                    .replace(':id', id),
                data: {
                    type: type,
                    leave_type: leave_type,
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#modal_details').empty();
                        $('#modal_details').append(response.view);
                        $('#detailsModal').modal('show');
                    } else {
                        toastr.warning('Something went wrong !', 'Warning');
                    }
                },
                error: function(e) {
                    console.log(e);
                    toastr.error('An Error Occured !', 'Error');
                }
            });
        }
    }

    $(document).ready(function() {
        // MyForm
        $("#MyForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                father_name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                contact: {
                    required: true,

                },
                cnic: {
                    required: true,

                },
                employment_status_id: {
                    required: true
                },
                hiring_date: {
                    required: true,
                    date: true
                },

            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 2 characters long"
                },
                father_name: {
                    required: "Please enter your father's name",
                    minlength: "Father's name must be at least 2 characters long"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                contact: {
                    required: "Please enter your contact number",
                },
                cnic: {
                    required: "Please enter your CNIC",
                },
                employment_status_id: {
                    required: "Please select your employment status"
                },
                hiring_date: {
                    required: "Please enter your hiring date",
                    date: "Please enter a valid date"
                },

            },
            errorClass: 'is-invalid text-danger',
            errorElement: "span",
            wrapper: "div",
            submitHandler: function(form) {
                form.submit();
            }
        });
        // Add validation rules and messages
        $("#password-form").validate({
            rules: {
                password: {
                    required: true,

                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please enter a password.",
                    minlength: "Password must be at least 8 characters long."
                },
                password_confirmation: {
                    equalTo: "Passwords do not match."
                }
            },
            errorClass: 'is-invalid text-danger',
            errorElement: "span",
            wrapper: "div",
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
    $("#hiring_date").flatpickr({
        altInput: !0,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
    // end of valdiation
    var files = [];

    @forelse($images as $image)
        files.push({
            source: '{{ $image->getUrl() }}',
        });
    @empty
    @endforelse

    FilePond.create(document.getElementById('sign_attachment'), {
        files: files,
        styleButtonRemoveItemPosition: 'right',
        imageCropAspectRatio: '1:1',
        acceptedFileTypes: ['image/png', 'image/jpeg'],
        maxFileSize: '100000KB',
        ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
        storeAsFile: false,
        allowMultiple: false,
        checkValidity: true,
        chunkUploads: true,
        chunkSize: '200KB',
        chunkForce: true,
        server: {
            timeout: 7000,
            process: '/files/getUploadId',
            revert: '/files/revertFile',
            patch: '/files/uploadfileChunk?patch=',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        credits: {
            label: '',
            url: ''
        }
    });
    var files = [];
    @forelse($cv as $image)
        files.push({
            source: '{{ $image->getUrl() }}',
        });
    @empty
    @endforelse

    FilePond.create(document.getElementById('cv_attachment'), {
        files: files,
        styleButtonRemoveItemPosition: 'right',
        imageCropAspectRatio: '1:1',
        acceptedFileTypes: ['image/png', 'image/jpeg'],
        maxFileSize: '100000KB',
        ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
        storeAsFile: false,
        allowMultiple: true,
        checkValidity: true,
        chunkUploads: true,
        chunkSize: '200KB',
        chunkForce: true,
        server: {
            timeout: 7000,
            process: '/files/getUploadId',
            revert: '/files/revertFile',
            patch: '/files/uploadfileChunk?patch=',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        credits: {
            label: '',
            url: ''
        }
    });
    var files = [];
    @forelse($photo as $image)
        files.push({
            source: '{{ $image->getUrl() }}',
        });
    @empty
    @endforelse

    FilePond.create(document.getElementById('photo_attachment'), {
        files: files,
        styleButtonRemoveItemPosition: 'right',
        imageCropAspectRatio: '1:1',
        acceptedFileTypes: ['application/pdf'],
        maxFileSize: '100000KB',
        ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
        storeAsFile: false,
        allowMultiple: false,
        checkValidity: true,
        chunkUploads: true,
        chunkSize: '200KB',
        chunkForce: true,
        server: {
            timeout: 7000,
            process: '/files/getUploadId',
            revert: '/files/revertFile',
            patch: '/files/uploadfileChunk?patch=',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        credits: {
            label: '',
            url: ''
        },
    });

    const wizardIconsVertical = document.querySelector('.wizard-vertical-icons-example');
    if (typeof wizardIconsVertical !== undefined && wizardIconsVertical !== null) {
        const verticalIconsStepper = new Stepper(wizardIconsVertical, {
            linear: false
        });
    }

    var firstLoadAttendance = true;
    $(document).on('click', '#attendance-tab-btn', function() {
        if (firstLoadAttendance) {
            todayattendance();
        }
        firstLoadAttendance = false;
        $('select[name="toDay_Attendance_length"]').val(25).trigger('change');
    })

    function todayattendance() {
        $('.rowClickMonthly').trigger('click');
        var id = {{ $user->id }};
        var site_id = {{ $user->site_id }};
        $("#toDay_Attendance").DataTable({
            "pageLength": 10,
            "lengthMenu": [10, 25, 50, 100],
            "serverSide": true,
            "processing": false,
            "scrollX": true,
            "scrollY": '20px',
            "scrollCollapse": true,
            "ajax": {
                "url": "{{ route('sites.hrm.user-attendance.ajax-today-attendance', ['site_id' => ':site_id', 'id' => ':id']) }}"
                    .replace(':id', id),
                "type": "GET",
            },
            "columns": [{
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex",
                    "title": "#",
                    "orderable": false,
                    "searchable": false
                },
                {
                    "data": "date",
                    "name": "date",
                    "title": "date",
                    "orderable": true,
                    "searchable": true
                },
                {
                    "data": "time_in",
                    "name": "time_in",
                    "title": "Time In",
                    "class": "text-nowrap rowClick",
                    "orderable": true,
                    "searchable": true,
                    // "render": function(data, type, row) {
                    //     var lateLabel = row.is_late ?
                    //         '<span class="badge bg-danger">Late</span>' : '';
                    //     return data + ' ' + lateLabel;
                    // }
                },

                {
                    "data": "time_out",
                    "name": "time_out",
                    "title": "Time Out",
                    "orderable": true,
                    "searchable": true
                },
                {
                    "data": "reason_for_leave",
                    "name": "reason_for_leave",
                    "title": "Reason For Leaving",
                    "orderable": true,
                    "searchable": true
                },

            ],
            'dom': '<"card-header pt-0 custom_button_card "<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row custom_datatable_label"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">',
            "language": {
                "sLengthMenu": "_MENU_",
                "search": "",
                "searchPlaceholder": "Search..",
                // "processing": "<img width=\"50\" src=\"assets\/img\/loader.gif\"\/>"
            },
            "select": {
                // Select style
                "style": 'multi'
            },
            "buttons": [

                @if (Auth::user()->can('create_other_users_attendance') || $user->can('create_own_attendance'))
                    {
                        text: '<i class="ti ti-dots-vertical"></i>',
                        className: 'ms-1 btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light custom_more',
                        extend: 'collection',
                        buttons: [
                            @if (
                                !$todayTimeInAttendacneWithoutTimeOut &&
                                    Auth::user()->can('create_other_users_attendance') &&
                                    Auth::id() != $user->id)
                                {
                                    text: '<svg style="margin-right: 13px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_66_53)"><path d="M19 5.79999C16.8 1.09999 11.4 -1.20001 6.60005 0.69999C2.70005 2.09999 0.500049 4.99999 0.100049 9.09999C-0.0999512 11.2 0.300049 13.3 1.50005 15.1C1.60005 15.3 1.60005 15.4 1.50005 15.6C1.00005 16.7 0.600049 17.7 0.200049 18.8C4.88311e-05 19.1 4.88311e-05 19.4 0.200049 19.7C0.400049 20 0.700049 20 1.10005 19.9C2.50005 19.6 3.90005 19.3 5.30005 18.9C5.50005 18.9 5.60005 18.9 5.80005 18.9C7.10005 19.5 8.60005 19.9 10.4 19.9C11.1 19.9 12.1 19.8 13 19.5C18.7 17.7 21.6 11.3 19 5.79999ZM11.7 18.6C9.70005 19 7.80005 18.7 6.00005 17.8C5.60005 17.6 5.30005 17.6 4.90005 17.7C3.90005 18 2.90005 18.2 1.80005 18.4H1.70005C2.00005 17.6 2.30005 16.8 2.70005 16.1C2.90005 15.6 2.90005 15.3 2.60005 14.8C1.50005 13.2 1.10005 11.5 1.20005 9.59999C1.30005 5.79999 4.00005 2.49999 7.80005 1.49999C12.6 0.19999 17.6 3.29999 18.6 8.19999C19.6 13 16.5 17.7 11.7 18.6Z" fill="#6B6371"/><path d="M10.8 7.9C10.8 8.3 10.8 8.7 10.8 9C10.8 9.2 10.8 9.2 11 9.2C11.7 9.2 12.5 9.2 13.2 9.2C13.7 9.2 14 9.5 14 10C14 10.5 13.6 10.8 13.1 10.8C12.4 10.8 11.7 10.8 10.9 10.8C10.7 10.8 10.7 10.8 10.7 11C10.7 11.7 10.7 12.4 10.7 13.1C10.7 13.7 10.4 14 9.9 14C9.4 14 9.1 13.6 9.1 13.1C9.1 12.4 9.1 11.7 9.1 11C9.1 10.8 9.1 10.8 8.9 10.8C8.2 10.8 7.5 10.8 6.8 10.8C6.3 10.8 6 10.5 6 10C6 9.5 6.3 9.2 6.9 9.2C7.6 9.2 8.3 9.2 9 9.2C9.2 9.2 9.2 9.2 9.2 9C9.2 8.3 9.2 7.6 9.2 6.8C9.2 6.3 9.5 6 10 6C10.5 6 10.8 6.4 10.8 6.9C10.8 7.2 10.8 7.5 10.8 7.9Z" fill="#6B6371"/></g><defs><clipPath id="clip0_66_53"><rect width="20" height="20" fill="white"/></clipPath></defs></svg> Time In',
                                    className: 'btn btn-white in-time btn-sm m-0',
                                    action: function(e, dt, node, config) {
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: "Mark Attendance",
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, record it!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                timeInAttenedance(site_id, id);
                                            }
                                        });
                                    }
                                },
                            @endif
                            @if (!$todayTimeInAttendacneWithoutTimeOut && Auth::id() == $user->id && $user->can('create_own_attendance'))
                                {
                                    text: '<svg style="margin-right: 13px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_66_53)"><path d="M19 5.79999C16.8 1.09999 11.4 -1.20001 6.60005 0.69999C2.70005 2.09999 0.500049 4.99999 0.100049 9.09999C-0.0999512 11.2 0.300049 13.3 1.50005 15.1C1.60005 15.3 1.60005 15.4 1.50005 15.6C1.00005 16.7 0.600049 17.7 0.200049 18.8C4.88311e-05 19.1 4.88311e-05 19.4 0.200049 19.7C0.400049 20 0.700049 20 1.10005 19.9C2.50005 19.6 3.90005 19.3 5.30005 18.9C5.50005 18.9 5.60005 18.9 5.80005 18.9C7.10005 19.5 8.60005 19.9 10.4 19.9C11.1 19.9 12.1 19.8 13 19.5C18.7 17.7 21.6 11.3 19 5.79999ZM11.7 18.6C9.70005 19 7.80005 18.7 6.00005 17.8C5.60005 17.6 5.30005 17.6 4.90005 17.7C3.90005 18 2.90005 18.2 1.80005 18.4H1.70005C2.00005 17.6 2.30005 16.8 2.70005 16.1C2.90005 15.6 2.90005 15.3 2.60005 14.8C1.50005 13.2 1.10005 11.5 1.20005 9.59999C1.30005 5.79999 4.00005 2.49999 7.80005 1.49999C12.6 0.19999 17.6 3.29999 18.6 8.19999C19.6 13 16.5 17.7 11.7 18.6Z" fill="#6B6371"/><path d="M10.8 7.9C10.8 8.3 10.8 8.7 10.8 9C10.8 9.2 10.8 9.2 11 9.2C11.7 9.2 12.5 9.2 13.2 9.2C13.7 9.2 14 9.5 14 10C14 10.5 13.6 10.8 13.1 10.8C12.4 10.8 11.7 10.8 10.9 10.8C10.7 10.8 10.7 10.8 10.7 11C10.7 11.7 10.7 12.4 10.7 13.1C10.7 13.7 10.4 14 9.9 14C9.4 14 9.1 13.6 9.1 13.1C9.1 12.4 9.1 11.7 9.1 11C9.1 10.8 9.1 10.8 8.9 10.8C8.2 10.8 7.5 10.8 6.8 10.8C6.3 10.8 6 10.5 6 10C6 9.5 6.3 9.2 6.9 9.2C7.6 9.2 8.3 9.2 9 9.2C9.2 9.2 9.2 9.2 9.2 9C9.2 8.3 9.2 7.6 9.2 6.8C9.2 6.3 9.5 6 10 6C10.5 6 10.8 6.4 10.8 6.9C10.8 7.2 10.8 7.5 10.8 7.9Z" fill="#6B6371"/></g><defs><clipPath id="clip0_66_53"><rect width="20" height="20" fill="white"/></clipPath></defs></svg> Time In',
                                    className: 'btn btn-white in-time btn-sm m-0',
                                    action: function(e, dt, node, config) {
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            // text: "Mark Attendance",
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, record it!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                timeInAttenedance(site_id, id);
                                            }
                                        });
                                    }
                                },
                            @endif
                            @if ($todayTimeInAttendacneWithoutTimeOut)
                                {
                                    text: '<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#LeavingReason">Time Out</button>',
                                    className: 'btn btn-white out-time btn-sm text-sm m-0',
                                    action: function(e, dt, node, config) {}
                                },
                            @endif

                        ],

                        init: function(dt, node, config) {
                            $(node).on('click', function() {
                                $('.in-time').toggle();
                            });
                        }
                    }
                @endif
            ]

        });
        $('.rowClick').trigger('click');
    }

    function timeInAttenedance(site_id, id) {
        var _token = '{{ csrf_token() }}';
        $.ajax({
            url: "{{ route('sites.hrm.user-attendance.ajax-time-in', ['site_id' => ':site_id', 'id' => ':id']) }}"
                .replace(':site_id', site_id)
                .replace(':id', id),
            type: "post",
            dataType: "json",
            data: {
                'user_id': id,
                '_token': _token,
            },
            success: function(data) {
                console.log(data);
                if (data.status) {
                    toastr.success(data.status);
                    $('#UserAttendance-table').DataTable().ajax.reload();
                    location.reload();
                } else {
                    toastr.error(data.error);

                }

            },
        });


    }

    function timeOutAttenedance(site_id, id) {
        var reason = document.getElementById('reason').value;
        var _token = '{{ csrf_token() }}';

        Swal.fire({
            title: "Are you sure?",
            // text: "You will not be able to recover this record!",
            icon: "warning",
            // showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: "No!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "{{ route('sites.hrm.user-attendance.ajax-time-out', ['site_id' => ':site_id', 'id' => ':id']) }}"
                        .replace(':site_id', site_id)
                        .replace(':id', id),
                    type: "post",
                    dataType: "json",
                    data: {
                        'user_id': id,
                        '_token': _token,
                        'reason': reason,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status) {
                            $('#UserAttendance-table').DataTable().ajax.reload();
                            location.reload();
                            toastr.success(data.status);
                        } else {
                            toastr.error(data.error);
                        }
                    },
                });
            }
        });
    }

    $('#copy_mobile_number').on('change', function() {
        if ($(this).is(':checked')) {
            contact = $('#contact').val();
            $('#optional_contact').val($('#contact').val());
        } else {
            $('#optional_contact').val('');
        }
    })

    function UserUpdated(id) {
        var $form = $('#MyForm');
        if (!$form.valid()) {
            // Form is not valid, do not proceed with AJAX call
            return;
        }
        var formData = $('#MyForm').serialize();
        console.log(formData);
        $.ajax({
            url: "{{ route('sites.users.ajax-profile-update', ['site_id' => $site_id, 'id' => ':id']) }}"
                .replace(':id', id),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    toastr.success(response.status);
                    location.reload();
                } else {
                    toastr.error(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                var errors = JSON.parse(xhr.responseText).errors;
                // Display error messages for each field
                $.each(errors, function(key, value) {
                    $("#" + key).addClass(
                        'is-invalid'); // Add is-invalid class to highlight the field
                    $("#" + key).siblings('.invalid-feedback').html(
                        value); // Show the error message
                });
            }
        });
    }

    // user address
    function UserAddressUpdated(id) {
        var $form = $('#AddressForm');
        if (!$form.valid()) {
            return;
        }
        var formData = $('#AddressForm').serialize();
        console.log(formData);
        $.ajax({
            url: "{{ route('sites.users.ajax-profile-update', ['site_id' => $site_id, 'id' => ':id']) }}"
                .replace(':id', id),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    toastr.success(response.status);
                    location.reload();
                } else {
                    toastr.error(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                var errors = JSON.parse(xhr.responseText).errors;
                // Display error messages for each field
                $.each(errors, function(key, value) {
                    $("#" + key).addClass(
                        'is-invalid'); // Add is-invalid class to highlight the field
                    $("#" + key).siblings('.invalid-feedback').html(
                        value); // Show the error message
                });
            }
        });
    }
    // attachments
    function UserAttachmentUpdated(id) {
        var formData = $('#attachments').serialize();
        console.log(formData);
        $.ajax({
            url: "{{ route('sites.users.ajax-profile-update', ['site_id' => $site_id, 'id' => ':id']) }}"
                .replace(':id', id),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    toastr.success(response.status);
                    location.reload();
                } else {
                    toastr.error(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                var errors = JSON.parse(xhr.responseText).errors;
                // Display error messages for each field
                $.each(errors, function(key, value) {
                    $("#" + key).addClass(
                        'is-invalid'); // Add is-invalid class to highlight the field
                    $("#" + key).siblings('.invalid-feedback').html(
                        value); // Show the error message
                });
            }
        });
    }
    // user password
    function UserpasswordUpdated(id) {
        var formData = $('#password-form').serialize();
        console.log(formData);
        $.ajax({
            url: "{{ route('sites.users.ajax-profile-update', ['site_id' => $site_id, 'id' => ':id']) }}"
                .replace(':id', id),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    toastr.success(response.status);
                    location.reload();
                } else {
                    toastr.error(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                var errors = JSON.parse(xhr.responseText).errors;
                // Display error messages for each field
                $.each(errors, function(key, value) {
                    $("#" + key).addClass(
                        'is-invalid'); // Add is-invalid class to highlight the field
                    $("#" + key).siblings('.invalid-feedback').html(
                        value); // Show the error message
                });
            }
        });
    }

    //flatpickr
    $("#dob").flatpickr({
        default: {{ isset($user->date_of_birth) ? $user->date_of_birth : 'today' }},
        maxDate: 'today',
        altInput: !0,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });

    flatpicker_to_date = $("#hiring_date").flatpickr({
        // mode: "range",
        // maxDate: "today",
        altInput: !0,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });


    var cp_state = 0;
    var cp_city = 0;
    var ra_state = 0;
    var ra_city = 0;

    var editImage = "";
    var id = <?php echo $user->id; ?>;

    $(document).ready(function() {
        var input = document.querySelector("#contact");
        intl = window.intlTelInput(input, ({
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            preferredCountries: ["pk"],
            separateDialCode: true,
            autoPlaceholder: 'polite',
            formatOnDisplay: true,
            nationalMode: true
        }));
        @if (is_null($user->countryDetails))
            intl.setCountry('pk');
        @else
            var selectdCountry = {!! $user->countryDetails !!}
            if (selectdCountry['iso2']) {

                intl.setCountry(selectdCountry['iso2']);
                $('#countryDetails').val(JSON.stringify(intl.getSelectedCountryData()))
            } else {
                intl.setCountry('pk');
            }
        @endif
        intl.setNumber('{{ $user->contact }}');

        $('#is_local').on('change', function() {

            if (this.checked) {
                $('#nationality').val(167).change();
            } else {
                $('#nationality').val(0).change();
            }
        });

        $('#cpyAddress').on('change', function() {

            if ($(this).is(':checked')) {

                $('#mailing_address_type').val($('#residential_address_type').val());
                $('#mailing_country').val($('#residential_country').val()).trigger('change');
                cp_state = $('#residential_state').val();
                cp_city = $('#residential_city').val();
                $('#mailing_postal_code').val($('#residential_postal_code').val());
                $('#mailing_Address').val($('#residential_address').val());

            } else {
                $('#mailing_address_type').val('')
                $('#mailing_country').val(0)
                $('#mailing_country').trigger('change')
                $('#mailing_postal_code').val('');
                $('#mailing_address').val('');
            }
        })



        var inputOptional = document.querySelector("#optional_contact");
        intlOptional = window.intlTelInput(
            inputOptional, ({
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                preferredCountries: ["pk"],
                separateDialCode: true,
                autoPlaceholder: 'polite',
                formatOnDisplay: true,
                nationalMode: true
            }));
        intlOptional.setNumber('{{ $user->optional_contact }}');
        @if (is_null($user->OptionalCountryDetails))
            intlOptional.setCountry('pk');
        @else
            var OptionalselectdCountry = {!! $user->OptionalCountryDetails != null ? $user->OptionalCountryDetails : null !!}
            if (OptionalselectdCountry['iso2']) {

                intlOptional.setCountry(OptionalselectdCountry['iso2']);
            } else {
                intlOptional.setCountry('pk');
            }
        @endif
        inputOptional.addEventListener("countrychange", function() {
            $('#OptionalCountryDetails').val(JSON.stringify(intlOptional.getSelectedCountryData()))
        });
        $('#OptionalCountryDetails').val(JSON.stringify(intlOptional.getSelectedCountryData()))

        var firstLoad = true;

        // residential address
        var residential_country = $("#residential_country");
        residential_country.wrap(
            '<div class="position-relative"></div>');
        residential_country.select2({
            width: "100%",
            containerCssClass: "select-md",
        }).change(function() {

            $("#residential_state").empty()
            $('#residential_city').empty();
            $('#residential_state').html('<option value=0>Select State</option>');
            $('#residential_city').html('<option value=0>Select City</option>');
            var _token = '{{ csrf_token() }}';
            let url =
                "{{ route('ajax-get-states', ['countryId' => ':countryId']) }}"
                .replace(':countryId', $(this).val());
            if ($(this).val() > 0) {
                showBlockUI('#stakeholderForm');
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'stateId': $(this).val(),
                        '_token': _token
                    },
                    success: function(response) {
                        if (response.success) {

                            $.each(response.states, function(key, value) {
                                $("#residential_state").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });
                            hideBlockUI('#stakeholderForm');

                            if (firstLoad) {
                                residential_state.val(
                                    '{{ $user->residential_state_id }}');
                                if (residential_state.val() > 0) {
                                    residential_state.trigger('change');
                                } else {
                                    firstLoad = false;
                                }
                            }
                        } else {
                            hideBlockUI('#stakeholderForm');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        hideBlockUI('#stakeholderForm');
                    }
                });
            }
        });
        var residential_state = $("#residential_state");
        residential_state.wrap(
            '<div class="position-relative"></div>');
        residential_state.select2({
            width: "100%",
            containerCssClass: "select-md",
        }).change(function() {
            $("#residential_city").empty()
            $('#residential_city').html('<option value=0>Select City</option>');

            var _token = '{{ csrf_token() }}';
            let url =
                "{{ route('ajax-get-cities', ['stateId' => ':stateId']) }}"
                .replace(':stateId', $(this).val());
            if ($(this).val() > 0) {
                showBlockUI('#stakeholderForm');
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'stateId': $(this).val(),
                        '_token': _token
                    },
                    success: function(response) {
                        if (response.success) {

                            $.each(response.cities, function(key, value) {
                                $("#residential_city").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });
                            hideBlockUI('#stakeholderForm');
                            if (firstLoad) {
                                residential_city.val(
                                    '{{ $user->residential_city_id }}');
                                firstLoad = false;
                            }
                        } else {
                            hideBlockUI('#stakeholderForm');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        hideBlockUI('#stakeholderForm');
                    }
                });
            }
        });

        var residential_city = $("#residential_city");
        residential_city.wrap(
            '<div class="position-relative"></div>');
        residential_city.select2({
            width: "100%",
            containerCssClass: "select-md",
        });

        residential_country.val('{{ $user->residential_country_id }}');
        residential_country.trigger('change');

        // mailing address
        var cp_state = 0;
        var cp_city = 0;

        var mfirstLoad = true;

        var mailing_country = $("#mailing_country");
        mailing_country.wrap(
            '<div class="position-relative"></div>');
        mailing_country.select2({
            width: "100%",
            containerCssClass: "select-md",
        }).change(function() {

            $("#mailing_state").empty()
            $('#mailing_city').empty();
            $('#mailing_state').html('<option value=0>Select State</option>');
            $('#mailing_city').html('<option value=0>Select City</option>');
            let _token = '{{ csrf_token() }}';
            let url =
                "{{ route('ajax-get-states', ['countryId' => ':countryId']) }}"
                .replace(':countryId', $(this).val());
            if ($(this).val() > 0) {
                showBlockUI('#stakeholderForm');
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'stateId': $(this).val(),
                        '_token': _token
                    },
                    success: function(response) {
                        if (response.success) {

                            $.each(response.states, function(key, value) {
                                $("#mailing_state").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });

                            mailing_state.val(cp_state);
                            mailing_state.trigger('change');

                            hideBlockUI('#stakeholderForm');
                            if (mfirstLoad) {
                                mailing_state.val(
                                    '{{ $user->mailing_state_id }}');
                                if (mailing_state.val() > 0) {
                                    mailing_state.trigger('change');
                                } else {
                                    mfirstLoad = false;
                                }
                            }
                        } else {
                            hideBlockUI('#stakeholderForm');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        hideBlockUI('#stakeholderForm');
                    }
                });
            }
        });

        var mailing_state = $("#mailing_state");
        mailing_state.wrap(
            '<div class="position-relative"></div>');
        mailing_state.select2({
            width: "100%",
            containerCssClass: "select-md",
        }).change(function() {
            $("#mailing_city").empty()
            $('#mailing_city').html('<option value=0>Select City</option>');
            let _token = '{{ csrf_token() }}';
            let url =
                "{{ route('ajax-get-cities', ['stateId' => ':stateId']) }}"
                .replace(':stateId', $(this).val());
            if ($(this).val() > 0) {
                showBlockUI('#stakeholderForm');
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'stateId': $(this).val(),
                        '_token': _token
                    },
                    success: function(response) {
                        if (response.success) {

                            $.each(response.cities, function(key, value) {
                                $("#mailing_city").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });
                            mailing_city.val(cp_city);
                            mailing_city.trigger('change');
                            hideBlockUI('#stakeholderForm');
                            if (mfirstLoad) {
                                mailing_city.val(
                                    '{{ $user->mailing_city_id }}');
                                mfirstLoad = false;
                            }
                        } else {
                            hideBlockUI('#stakeholderForm');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        hideBlockUI('#stakeholderForm');
                    }
                });
            }
        });

        var mailing_city = $("#mailing_city");
        mailing_city.wrap(
            '<div class="position-relative"></div>');
        mailing_city.select2({
            width: "100%",
            containerCssClass: "select-md",
        });
        mailing_country.val('{{ $user->mailing_country_id }}');
        mailing_country.trigger('change');
        mailing_state.select2({
            width: "100%",
            containerCssClass: "select-md",
        });

    });
    $.validator.addMethod("ContactNoError", function(value, element) {
        // alert(intl.isValidNumber());
        // return intl.getValidationError() == 0;
        return intl.isValidNumber();

    }, "In Valid number");

    $.validator.addMethod("OPTContactNoError", function(value, element) {
        // alert(intl.isValidNumber());
        // return intl.getValidationError() == 0;
        // if(value != '' )
        if (value.length > 0) {
            return intlOptional.isValidNumber();
        } else {
            return true;
        }
    }, "In Valid number");
    // var validator = $("#").validate({
    //     rules: {
    //         'mailing_address': {
    //             required: true,
    //         },
    //         'address': {
    //             required: true,
    //         },

    //         'residential[address_type]': {
    //             required: true,
    //         },

    //         'mailing[country]': {
    //             required: true,
    //         },
    //         'residential[address]': {
    //             required: true,
    //         },
    //         'mailing[address_type]': {
    //             required: true,
    //         },
    //         'residential[postal_code]': {
    //             required: true,
    //         },
    //         'mailing[postal_code]': {
    //             required: true,
    //         },
    //         'mailing[mailingAddress]': {
    //             required: true,
    //         },

    //         'mailing[country]': {
    //             required: function() {
    //                 return $("#mailing_country").val() < 0;
    //             }
    //         },
    //         messages: {
    //             'residential[address_type]': {
    //                 required: "Please select address type",
    //             },

    //         }

    //     },
    //     errorClass: 'is-invalid text-danger',
    //     errorElement: "span",
    //     wrapper: "div",
    //     submitHandler: function(form) {
    //         form.submit();
    //     }
    // });

    $('#copy_mobile_number').on('change', function() {
        if ($(this).is(':checked')) {
            contact = $('#contact').val();
            $('#optional_contact').val($('#contact').val());
        } else {
            $('#optional_contact').val('');
        }
    })

    $(document).ready(function() {
        var t = $("#nationality");
        t.wrap('<div class="position-relative"></div>');
        t.select2({
            width: "100%",
            containerCssClass: "select-md",
        })
    });
</script>

@endsection
