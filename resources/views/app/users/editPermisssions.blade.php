@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.users.edit', $site_id) }}
@endsection

@section('title', 'Edit User Permissions')

@section('page-vendor')
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/filepond/filepond.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/filepond/plugins/filepond.preview.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
@endsection

@section('page-css')
    <style>
    </style>
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12 ">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Edit User Permissions</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('sites.users.edit', $site_id) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- User Details card --}}
    <div id="mainDev">
        <div class="card">
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-lg col-md position-relative">
                        <label class="form-label fs-5" for="name">Full Name </label>
                        <input type="text" class="form-control form-control-lg" disabled value="{{ $user->name }}" />
                    </div>

                    <div class="col-lg col-md position-relative">
                        <label class="form-label fs-5" for="type_name">Email </label>
                        <input type="email" class="form-control form-control-lg" disabled value="{{ $user->email }}" />
                    </div>

                    <div class="col-lg col-md position-relative">
                        <label class="form-label fs-5" for="name">CNIC </label>
                        <input type="text" class="form-control form-control-lg" disabled value="{{ $user->cnic }}" />
                    </div>

                    <div class="col-lg col-md position-relative">
                        <label class="form-label fs-5" for="name">Contact # </label>
                        <input type="text" class="form-control form-control-lg" disabled value="{{ $user->contact }}" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Assign permissions table --}}
        <div class="row">
            <div class="col{{ count($user->roles) > 4 ? '-3' : '' }}">
                <div class="card"
                    style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0; height: 600px; overflow-x: scroll;">
                    <div class="card-header">
                        <h3>Direct Permissions</h3>

                    </div>
                    <div class="card-body">
                        <table id="" class="display table table-hover">
                            <thead>
                                <th>Permission</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($directPermissions as $permissions)
                                    <tr>
                                        <td>{{ $permissions->show_name }}</td>
                                        <td><input class='form-check-input' type="checkbox"
                                                onchange='changeDirectPermission("{{ $user->id }}", "{{ $permissions->id }}")'
                                                id="chkDirectPermission_{{ $user->id }}_{{ $permissions->id }}"
                                                {{ $user->can($permissions->name) ? ' checked' : '' }} />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @foreach ($user->roles as $role)
                <div class="col{{ count($user->roles) > 4 ? '-3' : '' }}">
                    <div class="card"
                        style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0; height: 600px; overflow-x: scroll;">
                        <div class="card-header">
                            <h3>{{ $role->is_child == true ? getRoleParentByParentId($role->parent_id) : $role->name }}
                            </h3>

                        </div>
                        <div class="card-body">
                            <table id="" class="display table table-hover">
                                <thead>
                                    <th>Permission</th>
                                    <th>
                                        <div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="has_team">Check
                                                All</label>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="checkbox" class="form-check-input"
                                                    id="permissionsCheckAll{{ $role->id }}"
                                                    onChange="changeAllPermissions({{ $role->id }}, this)"
                                                    data-role_id="{{ $role->id }}"
                                                    {{ hasAllPermissions($role) ? 'checked' : null }} />
                                                <label class="form-check-label" for="permissionsCheckAll">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach (getAllPermissions($role->id) as $permissions)
                                        <tr>
                                            <td>{{ $permissions->show_name }}</td>
                                            <td><input
                                                    class='form-check-input permissionsCheck rolePermission{{ $role->id }}'
                                                    type="checkbox"
                                                    onchange='changeRolePermission("{{ $role->id }}", "{{ $permissions->id }}")'
                                                    id="chkRolePermission_{{ $role->id }}_{{ $permissions->id }}"
                                                    {{ $role->hasPermissionTo($permissions->name) ? ' checked' : '' }} />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


@endsection

@section('vendor-js')
    <script src="{{ asset('app-assets') }}/vendors/filepond/plugins/filepond.preview.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/filepond/plugins/filepond.typevalidation.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/filepond/plugins/filepond.imagecrop.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/filepond/plugins/filepond.imagesizevalidation.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/filepond/plugins/filepond.filesizevalidation.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/filepond/filepond.min.js"></script>

@endsection

@section('page-js')
    <script src="{{ asset('app-assets') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/forms/validation/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.0.3/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(window).on('load', function() {
            showBlockUI()

            setTimeout(() => {
                hideBlockUI()

            }, 2000);
        });
        // $(document).ready(function() {
        //     $('table.display').DataTable({
        //         lengthMenu: [30, 50, 100],
        //         scrollX: true,
        //     });
        // });

        function changeAllPermissions(role_id, thisObj) {
            // alert(role_id)
            if ($(thisObj).prop("checked")) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure to Make Changes',
                    confirmButtonText: 'Yes',
                    cancelButtonText: '{{ __('lang.commons.no_cancel') }}',
                    showCancelButton: true,
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                        cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(thisObj).prop('checked', $(this).prop("checked"));
                        // $('.permissionsCheck').trigger('change')
                        changeRolePermission(role_id, 0);
                        $('.rolePermission' + role_id).each(function() {

                            $(this).prop('checked', true);
                        })
                    } else {
                        // $('#permissionsCheckAll').prop('checked', false);
                    }
                })
            }

        }
        // $('.permissionsCheckAll').change(function() {
        //     alert($(this).attar('role_id'))
        //     if ($(this).prop("checked")) {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Confirmation',
        //             text: 'Are you sure to Make Changes',
        //             confirmButtonText: 'Yes',
        //             cancelButtonText: '{{ __('lang.commons.no_cancel') }}',
        //             showCancelButton: true,
        //             buttonsStyling: false,
        //             customClass: {
        //                 confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
        //                 cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
        //             },
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 $('.permissionsCheck').prop('checked', $(this).prop("checked"));
        //                 // $('.permissionsCheck').trigger('change')
        //                 changeRolePermission($(this).data('role_id'), 0);
        //             } else {
        //                 $('#permissionsCheckAll').prop('checked', false);
        //             }
        //         })
        //     }

        // });

        $('.permissionsCheck').change(function() {
            if ($('.permissionsCheck:checked').length == $('.permissionsCheck').length) {
                //    / $('#permissionsCheckAll').prop('checked', true);
            } else {
                // $('#permissionsCheckAll').prop('checked', false);
            }
        });

        var id = <?php echo $user->id; ?>;

        function changeRolePermission(role_id, permission_id) {
            console.log(role_id, permission_id)
            if (permission_id > 0) {
                var checkBoxState = $('#chkRolePermission_' + role_id + '_' + permission_id).is(':checked');
                var url = "";
                if (checkBoxState) {
                    url = '{{ route('permissions.assign-permission') }}';
                } else {
                    $('#permissionsCheckAll' + role_id).prop('checked', false);
                    url = '{{ route('permissions.revoke-permission') }}';
                }
            } else {
                var checkBoxState = $('#permissionsCheckAll' + role_id).is(':checked');
                console.log(checkBoxState)
                var url = "";
                if (checkBoxState) {
                    url = '{{ route('permissions.assign-permission') }}';
                } else {
                    url = '{{ route('permissions.revoke-permission') }}';
                }
            }

            showBlockUI('#mainDev', 'Please wait...')

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
                        // $('#permissions-table').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                }
            });

        }

        function changeDirectPermission(user_id, permission_id) {

            var checkBoxState = $('#chkDirectPermission_' + user_id + '_' + permission_id).is(':checked');
            var url = "";
            if (checkBoxState) {
                url = '{{ route('permissions.assign-permission') }}';
            } else {
                url = '{{ route('permissions.revoke-permission') }}';
            }
            showBlockUI('#mainDev', 'Please wait...')

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    permission_id: permission_id,
                    directPermission: true,
                    user_id: user_id,
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
                        // $('#permissions-table').DataTable().ajax.reload();
                        // hideBlockUI('#mainDev')
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                        // hideBlockUI('#mainDev')
                    }
                }
            });
        }

        $(document).ajaxStop(function() {

            hideBlockUI('#mainDev')

        });
    </script>
@endsection
