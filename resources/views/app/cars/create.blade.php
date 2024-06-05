@extends('layouts/layoutMaster')

@section('title', 'Create Cars')

@section('page-vendor')

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

@section('content')
    <form id="carForm" class="form form-vertical" class="signature-form" enctype="multipart/form-data"
        action="{{ route('cars.store') }}" method="POST">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 position-relative">

                @csrf
                {{ view('app.cars.form-fields', [
                    'categories' => $categories,
                    'brands' => $brands,
                    'users' => $users,
                ]) }}

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 position-relative">
                <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                    <div class="card-body">
                        <div class="d-block mb-1">
                            <label class="form-label fs-5" for="type_name">Photo </label>
                            <input id="photo_attachment" type="file"
                                class="filepond @error('photo_attachment') is-invalid @enderror" name="photo_attachment[]"
                                accept="image/png, image/jpeg" />
                            <small class="text-muted">Upload Car Photo</small>
                            @error('photo_attachment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="d-block mb-1">
                            <label class="form-label fs-5" for="type_name">Others Car Attachments </label>
                            <input id="other_attachments" type="file"
                                class="filepond @error('other_attachments') is-invalid @enderror" name="other_attachments[]"
                                accept="image/png, image/jpeg" />
                            <small class="text-muted">Upload Others Car Attachments</small>
                            @error('other_attachments')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>

                        @can('cars.store')
                            <button type="submit" id="SaveUserBtn"
                                class="btn w-100 btn-outline-success waves-effect waves-float waves-light buttonToBlockUI mb-2">
                                <i data-feather='save'></i>
                                Save
                            </button>
                        @endcan
                        <a href="{{ route('cars.index') }}"
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
@endsection

@section('custom-js')
    <script>
        FilePond.create(document.getElementById('photo_attachment'), {
            styleButtonRemoveItemPosition: 'right',
            imageCropAspectRatio: '1:1',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/gif'],
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

        FilePond.create(document.getElementById('other_attachments'), {
            styleButtonRemoveItemPosition: 'right',
            imageCropAspectRatio: '1:1',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/gif'],
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

        var validator = $("#carForm").validate({
            rules: {
                'name': {
                    required: true,
                },
            },
            errorClass: 'is-invalid text-danger',
            errorElement: "span",
            wrapper: "div",
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
