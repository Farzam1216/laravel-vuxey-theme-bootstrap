@extends('layouts/layoutMaster')



@section('title','Permissions')

@section('page-vendor')

@endsection

@section('page-css')

@endsection

{{-- @section('breadcrumbs')
<div class="content-header-left col-md-9">
  <div class="row breadcrumbs-top mb-0">
    <div class="col-12 align-items-center d-flex">
      <h2 class="content-header-title float-start mb-0">{{ __('lang.permissions.permission_plural') }}</h2>
      <div class="breadcrumb-wrapper">
        {{ Breadcrumbs::render('permissions.index') }}
      </div>
    </div>
  </div>
</div>
@endsection --}}

@section('content')


<div class="card">
  <div class="card-body">
    <form action="{{ route('permissions.destroy-selected') }}" id="permissions-table-form" method="get">
      {{ $dataTable->table() }}
    </form>
  </div>
</div>

<!-- Fixed Columns -->
{{-- <div class="card">
  <h5 class="card-header">Fixed Columns</h5>
  <div class="card-datatable text-nowrap">
    <table class="dt-fixedcolumns table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Email</th>
          <th>City</th>
          <th>Date</th>
          <th>Salary</th>
          <th>Age</th>
          <th>Experience</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div> --}}
<!--/ Fixed Columns -->

@endsection

@section('vendor-js')
{{-- <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script> --}}

{{-- <script src="{{ asset(mix('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('assets/js/tables-datatables-advanced.js')) }}"></script>
<script src="{{ asset(mix('assets/js/tables-datatables-extensions.js')) }}"></script> --}}
{{-- <script src="{{ asset(mix('assets/vendor/libs/datatable/dataTables.bootstrap5.min.js')) }}"></script> --}}
{{-- <script src="{{ asset(mix('assets/js/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('assets/js/responsive.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('assets/js/datatables.checkboxes.min.js')) }}"></script>
<script src="{{ asset(mix('assets/js/datatables.buttons.min.js')) }}"></script> --}}
{{-- <script src="{{ asset(mix('assets/js/dataTables.select.min.js')) }}"></script> --}}
{{-- <script src="{{ asset(mix('assets/js/buttons.colVis.min.js')) }}"></script>
<script src="{{ asset(mix('assets/js/jszip.min.js')) }}"></script>
<script src="{{ asset(mix('assets/js/pdfmake.min.js')) }}"></script>
<script src="{{ asset(mix('assets/js/vfs_fonts.js')) }}"></script>
<script src="{{ asset(mix('assets/js/buttons.print.min.js')) }}"></script>
<script src="{{ asset(mix('assets/js/dataTables.rowGroup.min.js')) }}"></script> --}}
@endsection

@section('page-js')
{{-- <script src="{{ asset('assets/js/tables-datatables-extensions.js') }}"></script> --}}

{{ $dataTable->scripts() }}
<script>
  function deleteSelected() {
            var selectedCheckboxes = $('.dt-checkboxes:checked').length;
            if (selectedCheckboxes > 0) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Are you sure',
                    showCancelButton: true,
                    cancelButtonText: 'No, Cancel',
                    confirmButtonText: 'Yes, Delete',
                    confirmButtonClass: 'btn-danger',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#permissions-table-form').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please select at least one item',
                });
            }
        }

        function deleteByID(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Are you sure',
                showCancelButton: true,
                cancelButtonText: 'No , Cancel',
                confirmButtonText: 'Yes',
                confirmButtonClass: 'btn-danger',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1'
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = '{{ route('permissions.destroy', ['id' => ':id']) }}'.replace(':id', id);
                }
            });
        }

        function changeRolePermission(role_id, permission_id) {
            showBlockUI();

            var checkBoxState = $('#chkRolePermission_' + role_id + '_' + permission_id).is(':checked');
            var url = "";
            if (checkBoxState) {
                url = '{{ route('permissions.assign-permission') }}';
            } else {
                url = '{{ route('permissions.revoke-permission') }}';
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    role_id: role_id,
                    permission_id: permission_id,
                },
                success: function(response) {
                    // console.log(response);
                    if (response.success) {
                        toastr.success(response.message,
                            "Success!", {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 2e3,
                                closeButton: !0,
                                tapToDismiss: !1,
                            });
                        hideBlockUI();

                        // $('#permissions-table').DataTable().ajax.reload();
                    } else {
                        hideBlockUI();

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(response) {
                    hideBlockUI();

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "Something went wrong!",
                    });
                }

            });
        }

        function permissionCheck(roles) {
            console.log(roles);
        }
</script>
@endsection
