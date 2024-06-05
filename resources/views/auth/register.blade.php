<!DOCTYPE html>
@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
    $configData = Helper::appClasses();
@endphp
<html lang="en" class="light-style  layout-menu-fixed   customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="http://127.0.0.1:8000/assets/" data-base-url="http://127.0.0.1:8000" data-framework="laravel"
    data-template="vertical-menu-theme-default-light">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Login {{ env('APP_NAME') }}</title>

        <!-- laravel CRUD token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Canonical SEO -->
        <link rel="canonical" href="">
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" />

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
        <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.css')) }}" />

        <!-- Vendor -->
        <link rel="stylesheet" href="../../assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />
        <!-- Helpers -->
        <script src="../../assets/vendor/js/helpers.js"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="../../assets/js/config.js"></script>
    </head>

    <body>
        <!-- Content -->

        <div class="authentication-wrapper authentication-cover authentication-bg">
          <div class="authentication-inner row">

              <!-- /Left Text -->
              <div class="d-none d-lg-flex col-lg-7 p-0">
                  <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                      <img src="{{ asset('assets/img/illustrations/auth-register-illustration-' . $configData['style'] . '.png') }}"
                          alt="auth-register-cover" class="img-fluid my-5 auth-illustration"
                          data-app-light-img="illustrations/auth-register-illustration-light.png"
                          data-app-dark-img="illustrations/auth-register-illustration-dark.png">

                      <img src="{{ asset('assets/img/illustrations/bg-shape-image-' . $configData['style'] . '.png') }}"
                          alt="auth-register-cover" class="platform-bg"
                          data-app-light-img="illustrations/bg-shape-image-light.png"
                          data-app-dark-img="illustrations/bg-shape-image-dark.png">
                  </div>
              </div>
              <!-- /Left Text -->

              <!-- Register -->
              <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                  <div class="w-px-400 mx-auto">
                      <!-- Logo -->
                      <div class="app-brand mb-4">
                          <a href="{{ url('/') }}" class="app-brand-link gap-2">
                              <span class="app-brand-logo demo">@include('_partials.macros', ['height' => 20, 'withbg' => 'fill: #fff;'])</span>
                          </a>
                      </div>
                      <!-- /Logo -->
                      <h3 class="mb-1 fw-bold">Adventure starts here 🚀</h3>
                      <p class="mb-4">Make your app management easy and fun!</p>

                      <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                          @csrf
                          <div class="mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input required type="text" class="form-control @error('name') is-invalid @enderror"
                                  id="name" name="name" placeholder="Enter your name" autofocus>
                              @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                  name="email" placeholder="Enter your email">

                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          {{-- <div class="mb-3 form-password-toggle">
                              <label class="form-label" for="password">Password</label>
                              <div class="input-group input-group-merge">
                                  <input type="password" id="password" class="form-control" name="password"
                                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                      aria-describedby="password" />
                                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                              </div>
                          </div> --}}

                          <div class="mb-3">
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                                  <label class="form-check-label" for="terms-conditions">
                                      I agree to
                                      <a href="javascript:void(0);">privacy policy & terms</a>
                                  </label>
                              </div>
                          </div>
                          <button class="btn btn-primary d-grid w-100">
                              Sign up
                          </button>
                      </form>

                      <p class="text-center">
                          <span>Already have an account?</span>
                          <a href="{{ url('/login') }}">
                              <span>Sign in instead</span>
                          </a>
                      </p>

                      <div class="divider my-4">
                          <div class="divider-text">or</div>
                      </div>

                      <div class="d-flex justify-content-center">
                          <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                              <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                          </a>

                          <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                              <i class="tf-icons fa-brands fa-google fs-5"></i>
                          </a>

                          <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                              <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                          </a>
                      </div>
                  </div>
              </div>
              <!-- /Register -->
          </div>
      </div>

        <!-- / Content -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../../assets/vendor/libs/popper/popper.js"></script>
        <script src="../../assets/vendor/js/bootstrap.js"></script>
        <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

        <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
        <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
        <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

        <script src="../../assets/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="../../assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
        <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
        <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

        <!-- Main JS -->
        <script src="../../assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="../../assets/js/pages-auth.js"></script>
    </body>

</html>
