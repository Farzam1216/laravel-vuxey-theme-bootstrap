@extends('layouts/layoutMaster')

{{-- @section('seo-breadcrumb')
<h4 class="fw-bold py-3 mb-4 "><span class="text-muted fw-light">{{ Breadcrumbs::view('breadcrumbs::json-ld',
    'roles.index') }}</span> </h4>

@endsection --}}

@section('title','Roles')

@section('page-vendor')

@endsection

@section('page-css')
{{--
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css"> --}}
@endsection

@section('page-css')
@endsection

{{-- @section('breadcrumbs')
<div class="content-header-left col-md-9">
  <div class="row breadcrumbs-top mb-0">
    <div class="col-12 align-items-center d-flex">
      <h2 class="content-header-title float-start mb-0">{{ __('lang.roles.role_plural') }}
      </h2>
      <div class="breadcrumb-wrapper align-items-center">


        {{ Breadcrumbs::render('roles.index') }}

      </div>
    </div>
  </div>
</div>
@endsection --}}

@section('content')
<p class="mb-2">
  Description
</p>

<!-- Role cards -->
<div class="row">
  @forelse ($roles as $role)
  <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
    <div class="card">
      <div class="card-body">
        {{-- <div class="d-flex justify-content-between">
          <span>Total 4 users</span>
          <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy"
              class="avatar avatar-sm pull-up">
              <img class="rounded-circle" src="{{ asset('app-assets') }}/images/avatars/2.png" alt="Avatar" />
            </li>
            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske"
              class="avatar avatar-sm pull-up">
              <img class="rounded-circle" src="{{ asset('app-assets') }}/images/avatars/12.png" alt="Avatar" />
            </li>
            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol"
              class="avatar avatar-sm pull-up">
              <img class="rounded-circle" src="{{ asset('app-assets') }}/images/avatars/6.png" alt="Avatar" />
            </li>
            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza"
              class="avatar avatar-sm pull-up">
              <img class="rounded-circle" src="{{ asset('app-assets') }}/images/avatars/11.png" alt="Avatar" />
            </li>
          </ul>
        </div> --}}
        <div class="d-flex justify-content-between align-items-end mt-1 pt-25 mb-3">
          <div class="role-heading">

            <h5 class="fw-bolder">

              {{ $role->name}} (
              {{ $role->guard_name}} )
            </h5>
            @can('roles.edit')
            <a href="{{ route('roles.edit', ['id' => encryptParams($role->id)]) }}" class="role-edit-modal">
              <small class="fw-bolder">Edit Role</small>
            </a>
            @endcan
          </div>
          {{-- <a href="javascript:void(0);" class="text-body">
            <i data-feather="copy" class="font-medium-5"></i>
          </a> --}}
        </div>
      </div>
    </div>
  </div>
  @empty
  @endforelse
  @can('roles.create')
  {{-- <div class="col-xl-4 col-lg-6 col-md-6 mb-5">
    <div class="card">
      <div>
        <div class="row">
          <div class="col-sm-5">
            <div class="d-flex align-items-end justify-content-center h-100 mb-2">
              <img src="{{ asset('assets/images/illustration/faq-illustrations.svg') }}" class="img-fluid mt-2"
                alt="Image" width="85" />
            </div>
          </div>
          <div class="col-sm-7">
            <div class="card-body text-sm-end text-center ps-sm-0">
              <a href="{{ route('roles.create') }}"
                class="btn btn-primary mb-2 text-nowrap add-new-role waves-effect waves-light">
                <span class=""><i data-feather="plus"></i>
                  {{ __('lang.roles.add_new_role') }}</span>
              </a>
              <p class="mb-0">{{ __('lang.roles.pages.extras.add_role_if_it_does_not_exist') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <div class="col-xl-4 col-lg-6 col-md-6 mb-5">
    <div class="card">

      <ul class="ps-0 d-flex justify-content-between mx-4 mb-2">
        <li class="d-block">
          {{-- <div class="d-flex align-items-end justify-content-center h-100 mb-2">
            <img src="{{ asset('assets/images/illustration/faq-illustrations.svg') }}" class="img-fluid mt-2"
              alt="Image" width="85" />
          </div> --}}
        </li>
        <li class="d-block">
          <div class="card-body text-end ps-sm-0 pe-0">
            <a href="{{ route('roles.create') }}"
              class="btn btn-primary mb-2 text-nowrap add-new-role waves-effect waves-light">
              <span class=""><i data-feather="plus"></i>
                Add New Role</span>
            </a>
            <p class="mb-0">Add role, if it does not exist</p>
          </div>
        </li>
      </ul>

    </div>
  </div>
  @endcan
</div>
<!--/ Role cards -->

<div class="card">
  <div class="card-body">
    {{-- <table class="datatable table table-hover table-striped">
      <thead>
        <tr>
          <th>{{ __('lang.commons.fields.hash') }}</th>
          <th>{{ __('lang.roles.pages.fields.role_name') }}</th>
          <th>{{ __('lang.roles.pages.fields.guard_name') }}</th>
          <th>{{ __('default') }}</th>
          <th>{{ __('lang.commons.fields.created_at') }}</th>
          <th>{{ __('lang.commons.fields.updated_at') }}</th>
          <th>{{ __('lang.commons.fields.actions') }}</th>
        </tr>
      </thead>
      <tbody></tbody>
      <thead>
        <tr>
          <th>{{ __('lang.commons.fields.hash') }}</th>
          <th>{{ __('lang.roles.pages.fields.role_name') }}</th>
          <th>{{ __('lang.roles.pages.fields.guard_name') }}</th>
          <th>{{ __('default') }}</th>
          <th>{{ __('lang.commons.fields.created_at') }}</th>
          <th>{{ __('lang.commons.fields.updated_at') }}</th>
          <th>{{ __('lang.commons.fields.actions') }}</th>
        </tr>
      </thead>
    </table> --}}
    <form action="{{ route('roles.destroy-selected') }}" id="roles-table-form" method="get">
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
  function roles_menu($id) {
            $('#loader_' + $id).show();
            $('#dropDownMenu_' + $id).empty()

            $.ajax({
                type: 'post',
                url: "{{ route('roles.ajax-roles-menu', [ 'id' => ':id']) }}".replace(':id', $id),

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
</script>
@endsection
