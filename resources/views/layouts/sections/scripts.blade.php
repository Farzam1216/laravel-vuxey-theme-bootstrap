{{-- <!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/i18n/i18n.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS--> --}}

<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/i18n/i18n.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/flatpickr/flatpickr.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/select2/select2.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('assets/js/tables-datatables-advanced.js')) }}"></script>
<script src="{{ asset(mix('assets/js/tables-datatables-extensions.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/sweetalert2/sweetalert2.js')) }}"></script>
<script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/vendor/js/file-pond/filepond-plugin-image-preview.js') }}"></script>
<script src="{{ asset('assets/vendor/js/file-pond/filepond.js') }}"></script>
<script src="{{ asset('assets/vendor/js/file-pond/filepond-plugin-file-validate-type.js') }}"></script>
<script src="{{ asset('assets/vendor/js/file-pond/filepond-plugin-file-validate-size.js') }}"></script>
<script src="{{ asset('assets/vendor/js/file-pond/filepond-plugin-image-validate-size.js') }}"></script>
<script src="{{ asset('assets/vendor/js/file-pond/filepond-plugin-image-crop.js') }}"></script>
<script src="{{ asset('assets/vendor/js/file-pond/filepond-plugin-pdf-preview.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/moment-range/moment-range.js') }}"></script>


@yield('vendor-js')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.amountFormat').on('focusout', function() {
        var val = $(this).val().replace(/,/g, "")
        if ($.isNumeric(val) && val > 0) {
            var formated = parseFloat(val).toLocaleString('en');
            $(this).val(formated)
        } else {
            $(this).val('')
        }
    })

    $('.numberFormat').on('focusout', function() {
        var val = $(this).val().replace(/,/g, "")
        if ($.isNumeric(val) && val > 0) {
            var formated = parseFloat(val).toLocaleString('en');
            $(this).val(formated)
        } else {
            $(this).val('')
        }
    })

    function readAllNotifications() {
        $.ajax({
            url: '{!! URL('/read-all-notifications') !!}',
            type: 'get',
            dataType: 'json',
            success: function(data) {
                location.reload(true);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function showBlockUI(element = null, message = '') {
        blockUIOptions = {
            message: '<div class=" text-primary" role="status"><img src="{{ asset('assets/images/comming-soon/Loader-current.gif') }}"></div><br><div class="text-primary">' +
                message + '</div>',
            css: {
                backgroundColor: 'transparent',
                border: '0'
            },
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8
            }
        };
        if (element) {
            $(element).block(blockUIOptions);
        } else {
            $.blockUI(blockUIOptions);
        }
    }

    function hideBlockUI(element = null) {
        if (element) {
            $(element).unblock();
        } else {
            $.unblockUI();
        }
    }

    function selectCheckAll(trigger, target) {
        if ($(trigger + ':checkbox:checked').length > 0) {
            //Check All
            $(target + " > option").prop("selected", true);
            $(target).trigger("change");
        } else {
            //Un Check All
            $(target + " > option").prop("selected", false);
            $(target).trigger("change");
        }
    }

    function changeTableRowColor(element) {
        if ($(element).is(':checked'))
            $(element).closest('tr').addClass('table-primary');
        else {
            $(element).closest('tr').removeClass('table-primary');
        }
    }

    function changeAllTableRowColor() {
        $('.dt-checkboxes').trigger('change');
    }

    // $(document).ajaxStart(function() {
    //     showBlockUI()
    // });
    $(document).ajaxStop(function() {
        hideBlockUI();
        // const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

        // tooltipTriggerList.map(function(tooltipTriggerEl) {
        //     return new bootstrap.Tooltip(tooltipTriggerEl);
        // });
    });

    // setTimeout(() => {
    //     var $searchInput = $(document).find('.dataTables_filter input');
    //     $searchInput.unbind();
    //     $searchInput.on('change keyup focusout', function(e) {

    //         var TableId = $(this).attr('aria-controls')

    //         if (e.type == 'keyup' && e.keyCode == 13) {
    //             showBlockUI();
    //             window.LaravelDataTables[TableId].search(this.value).draw();
    //             $(this).blur();
    //             return;
    //         } else if (e.type == 'focusout') {
    //             showBlockUI();

    //             window.LaravelDataTables[TableId].search(this.value).draw();
    //             return;
    //         } else {
    //             return;
    //         }
    //     });
    // }, 2000);


    // Not To submit form on Enter
    $("form").bind("keypress", function(e) {
        if (e.keyCode == 13) {
            return false;
        }
    });
    $(document).on('change', 'input[type=text]', function() {
        $(this).val($.trim($(this).val()));
    });

    $('form').on('submit', function() {
        // trim all input fields


        showBlockUI();
        if (this.id != 'importPreviewForm') {
            setTimeout(function() {
                hideBlockUI();
            }, 3000);
        }
    });

    function numberFormat(number) {
        return new Intl.NumberFormat().format(number);
    }

    function format(mask, number) {
        var s = '' + number,
            r = '';
        for (var im = 0, is = 0; im < mask.length && is < s.length; im++) {
            r += mask.charAt(im) == 'X' ? s.charAt(is++) : mask.charAt(im);
        }
        return r;
    }

    $('.amountFormat').on('focusout', function() {
        var val = $(this).val().replace(/,/g, "")
        if ($.isNumeric(val) && val > 0) {
            var formated = parseFloat(val).toLocaleString('en');
            $(this).val(formated)
        } else {
            $(this).val('')
        }
    })
</script>
<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-js')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    $(document).ready(function() {
        feather.replace();

        $("body").tooltip({
            selector: '[data-bs-toggle=tooltip]'
        });

        window.Helpers.initCustomOptionCheck();

        $('.select2').each(function() {
            var $this = $(this);
            $this.wrap("<div class='position-relative'></div>").select2({});
        });
    });
    //export files

    // Pusher.logToConsole = true;
    var userId = {{ auth()->user()->id ?? 0 }};
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true,
        auth: {
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        },
        authEndpoint: '/custom/pusher/auth',
    });

    var channel = pusher.subscribe('notifications-channel.' + userId);

    channel.bind('App\\Events\\ExportFilesEvent', function(data) {


    });
</script>

<!-- END: Page JS-->
@yield('custom-js')

