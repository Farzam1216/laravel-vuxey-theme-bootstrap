@extends('layouts/layoutMaster')



@section('title', __('Users'))

@section('page-vendor')
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')) }}">

@endsection

@section('page-css')
@endsection


@section('content')
    <p class="mb-2">

    </p>

    <div class="card">
        <div class="card-body" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
            <form action="{{ route('users.destroy-selected') }}" id="user-table-form"
                method="get">
                {{ $dataTable->table() }}
            </form>
        </div>
    </div>

@endsection

@section('vendor-js')
    <script src="{{ asset(mix('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')) }}"></script>
@endsection

@section('page-js')
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
        //menu call function
        function users_menu($id) {
            $('#loader_' + $id).show();
            $('#dropDownMenu_' + $id).empty()

            $.ajax({
                type: 'post',
                url: "{{ route('users.ajax-ajax-users-menu', [ 'id' => ':id']) }}"
                    .replace(':id', $id),

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
                    text: 'Are You Sure!',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                        cancelButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#user-table-form').submit();
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
            location.href = '{{ route('users.create') }}';
        }
    </script>
@endsection
