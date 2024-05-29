@extends('layouts/layoutMaster')

{{-- @section('seo-breadcrumb')
<h4 class="fw-bold py-3 mb-4 "><span class="text-muted fw-light">{{ Breadcrumbs::view('breadcrumbs::json-ld',
    'roles.index') }}</span> </h4>

@endsection --}}

@section('title', 'Car Categories')

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
    <script>
        function actions_menu($id) {
            $('#loader_' + $id).show();
            $('#dropDownMenu_' + $id).empty()

            $.ajax({
                type: 'post',
                url: "{{ route('car-brands.ajax-menu', ['id' => ':id']) }}".replace(':id', $id),

                // data: $('#floor_form').serialize(),
                success: function(data) {
                    $('#dropDownMenu_' + $id).html(data)
                    $('#loader_' + $id).hide();

                    // console.log(data);
                },
                error: function(data) {
                    $('#loader_' + $id).hide();

                    console.log('An error occurred.');
                },
            });
        }

        function deleteSelected() {
            var selectedCheckboxes = $('.dt-checkboxes:checked').length;
            if (selectedCheckboxes > 0) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Are you sure',
                    showCancelButton: true,
                    cancelButtonText: 'No,Cancel',
                    confirmButtonText: 'Yes',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                        cancelButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#roles-table-form').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: '{{ __('lang.commons.please_select_at_least_one_item') }}',
                });
            }
        }

        function addNew() {
            location.href = '{{ route('car-brands.create') }}';
        }
    </script>
@endsection
