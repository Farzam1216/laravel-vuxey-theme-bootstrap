<!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/fontawesome.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/tabler-icons.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/flag-icons.css')) }}" />

<!-- Core CSS -->
<link rel="stylesheet"
    href="{{ asset(mix('assets/vendor/css' . $configData['rtlSupport'] . '/core' . ($configData['style'] !== 'light' ? '-' . $configData['style'] : '') . '.css')) }}"
    class="{{ $configData['hasCustomizer'] ? 'template-customizer-core-css' : '' }}" />
<link rel="stylesheet"
    href="{{ asset(mix('assets/vendor/css' . $configData['rtlSupport'] . '/' . $configData['theme'] . ($configData['style'] !== 'light' ? '-' . $configData['style'] : '') . '.css')) }}"
    class="{{ $configData['hasCustomizer'] ? 'template-customizer-theme-css' : '' }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/css/demo.css')) }}" />

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.css')) }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')) }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/bootstrap-select/bootstrap-select.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/sweetalert2/sweetalert2.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')) }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/flatpickr/flatpickr.css')) }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.min.css') }}">
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}">

{{-- 4d4970 --}}

<!-- Vendor Styles -->
@yield('page-vendor')

<!-- Page Styles -->
@yield('page-css')
<style>
    .custom_y_arrow {
        width: 18px;
        height: auto;
    }

    .select2-results__option[aria-selected="true"] {
        background-color: #7367f0;
        color: #fff;
    }

    #dropdownMenuButton100 {
        border: none;
    }

    .exportBtn {
        box-shadow: unset !important;
        -webkit-transition: all .2s ease;
        transition: all .2s ease;
        color: #a8aaae !important;
        border-color: rgba(0, 0, 0, 0) !important;
        background: #f1f1f2 !important;
        border-radius: 5px !important;
        margin-right: 11px !important;
    }

    .exportBtn :hover {
        background: unset !important
    }

    .rounded-circle {
        object-fit: cover;
    }

    table.dataTable thead .sorting::before,
    table.dataTable thead .sorting_asc::before,
    table.dataTable thead .sorting_desc::before {
        content: '';
        background: none !important;
        top: 0.6rem !important;
        opacity: 0.5 !important;
        font-size: 14px !important;
        padding-left: 6px !important;
    }

    table.dataTable thead .sorting::after,
    table.dataTable thead .sorting_asc::after,
    table.dataTable thead .sorting_desc::after {
        content: '';
        background: none !important;
        top: 1.4rem !important;
        opacity: 0.5 !important;
        font-size: 14px !important;
        padding-left: 6px !important;
    }

    .dataTables_scrollBody {
        min-height: 500px;
    }
    .dtfc-fixed-left {
        position: sticky !important;
    }
</style>
