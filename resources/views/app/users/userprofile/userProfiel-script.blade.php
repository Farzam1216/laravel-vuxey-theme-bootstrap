<script type="text/javascript">
    var id = {{ $user->id }};
    var site_id = {{ $user->site_id }};
    let firstLoadSalaryTable = true;
    $(document).on('click', '#user_salary', function() {
        // if (firstLoadSalaryTable) {
        //     renderDatatable();
        // }
        // firstLoadSalaryTable = false;
        $('.rowClick').trigger('click');
    })

    $(document).on('click', '#user_payroll', function() {
        $('.rowClick').trigger('click');
    })

    function renderDatatable() {
        $(function() {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["user_salary_increment_detail"] = $("#user_salary_increment_detail")
                .DataTable({
                    "serverSide": true,
                    "processing": true,
                    "ajax": {
                        "url": "{{ route('sites.hrm.user-salary-increment-details.single-user-salary', ['site_id' => ':site_id', 'id' => ':id']) }}"
                            .replace(':site_id', site_id).replace(':id', id),
                        "type": "GET",
                        "data": function(data) {
                            for (var i = 0, len = data.columns.length; i < len; i++) {
                                if (!data.columns[i].search.value) delete data.columns[i].search;
                                if (data.columns[i].searchable === true) delete data.columns[i]
                                    .searchable;
                                if (data.columns[i].orderable === true) delete data.columns[i]
                                    .orderable;
                                if (data.columns[i].data === data.columns[i].name) delete data.columns[
                                        i]
                                    .name;
                            }
                            delete data.search.regex;
                        }
                    },
                    "columns": [{
                            "data": "DT_RowIndex",
                            "name": "DT_RowIndex",
                            "title": "#",
                            "orderable": false,
                            "searchable": false
                        },
                        {
                            "data": "salary",
                            "name": "salary",
                            "title": "Salary",
                            "class": "text-center rowClick",
                            "orderable": true,
                            "searchable": true,

                        },
                        {
                            "data": "isActive",
                            "name": "isActive",
                            "title": "Salary Status",
                            "class": "text-center ",
                            "orderable": true,
                            "searchable": true,

                        },

                        {
                            "data": "increament_amount",
                            "name": "increament_amount",
                            "title": "Increament Amount",
                            "orderable": true,
                            "searchable": true
                        },
                        {
                            "data": "next_increament_time",
                            "name": "next_increament_time",
                            "title": "Next Increament Time",
                            "orderable": true,
                            "searchable": true
                        },
                        {
                            "data": "previous_salary",
                            "name": "previous_salary",
                            "title": "Previous Salary",
                            "orderable": true,
                            "searchable": true
                        },
                        {
                            "data": null,
                            "name": "action",
                            "title": "Actions",
                            "orderable": false,
                            "searchable": false,
                            "render": function(data, type, row, meta) {
                                // Generate HTML for the dropdown menu
                                var dropdownHTML = `
                                        <div class="d-flex justify-content-center align-items-center" onclick="userSalary_menu(${row.id})">
                                            <div class="btn-group">
                                                <button class="btn  custom_dotted" type="button" id="dropdownMenuButton${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.id}" id="">
                                                    <div id="loader_${row.id}">
                                                        Loading...
                                                        <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="20px" height="20px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#000000"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(30 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(60 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(90 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#cecece" transform="rotate(120 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#b7b7b7" transform="rotate(150 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#9f9f9f" transform="rotate(180 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#898989" transform="rotate(210 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#727272" transform="rotate(240 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#5c5c5c" transform="rotate(270 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#444444" transform="rotate(300 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#2e2e2e" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>
                                                    </div>
                                                    <div id="dropDownMenu_${row.id}">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                return dropdownHTML;
                            }
                        }
                    ],
                    "buttons": [
                        @if (Auth::id() == $user->id && Auth::user()->can('can_user_add_own_salary'))
                            {
                                text: '<i class="ti ti-dots-vertical"></i>',
                                className: 'ms-1 btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light custom_more',
                                extend: 'collection',
                                buttons: [

                                    {
                                        text: '<svg style="margin-right: 13px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_66_53)"><path d="M19 5.79999C16.8 1.09999 11.4 -1.20001 6.60005 0.69999C2.70005 2.09999 0.500049 4.99999 0.100049 9.09999C-0.0999512 11.2 0.300049 13.3 1.50005 15.1C1.60005 15.3 1.60005 15.4 1.50005 15.6C1.00005 16.7 0.600049 17.7 0.200049 18.8C4.88311e-05 19.1 4.88311e-05 19.4 0.200049 19.7C0.400049 20 0.700049 20 1.10005 19.9C2.50005 19.6 3.90005 19.3 5.30005 18.9C5.50005 18.9 5.60005 18.9 5.80005 18.9C7.10005 19.5 8.60005 19.9 10.4 19.9C11.1 19.9 12.1 19.8 13 19.5C18.7 17.7 21.6 11.3 19 5.79999ZM11.7 18.6C9.70005 19 7.80005 18.7 6.00005 17.8C5.60005 17.6 5.30005 17.6 4.90005 17.7C3.90005 18 2.90005 18.2 1.80005 18.4H1.70005C2.00005 17.6 2.30005 16.8 2.70005 16.1C2.90005 15.6 2.90005 15.3 2.60005 14.8C1.50005 13.2 1.10005 11.5 1.20005 9.59999C1.30005 5.79999 4.00005 2.49999 7.80005 1.49999C12.6 0.19999 17.6 3.29999 18.6 8.19999C19.6 13 16.5 17.7 11.7 18.6Z" fill="#6B6371"/><path d="M10.8 7.9C10.8 8.3 10.8 8.7 10.8 9C10.8 9.2 10.8 9.2 11 9.2C11.7 9.2 12.5 9.2 13.2 9.2C13.7 9.2 14 9.5 14 10C14 10.5 13.6 10.8 13.1 10.8C12.4 10.8 11.7 10.8 10.9 10.8C10.7 10.8 10.7 10.8 10.7 11C10.7 11.7 10.7 12.4 10.7 13.1C10.7 13.7 10.4 14 9.9 14C9.4 14 9.1 13.6 9.1 13.1C9.1 12.4 9.1 11.7 9.1 11C9.1 10.8 9.1 10.8 8.9 10.8C8.2 10.8 7.5 10.8 6.8 10.8C6.3 10.8 6 10.5 6 10C6 9.5 6.3 9.2 6.9 9.2C7.6 9.2 8.3 9.2 9 9.2C9.2 9.2 9.2 9.2 9.2 9C9.2 8.3 9.2 7.6 9.2 6.8C9.2 6.3 9.5 6 10 6C10.5 6 10.8 6.4 10.8 6.9C10.8 7.2 10.8 7.5 10.8 7.9Z" fill="#6B6371"/></g><defs><clipPath id="clip0_66_53"><rect width="20" height="20" fill="white"/></clipPath></defs></svg> Create Salary',
                                        className: 'btn btn-white user-salary btn-sm m-0',
                                        action: function() {
                                            CreateSalary(site_id, id);
                                        }
                                    },


                                ],
                            }
                        @else

                            @if (Auth::id() != $user->id && Auth::user()->can('can_user_add_other_users_salary_details'))
                                {
                                    text: '<i class="ti ti-dots-vertical"></i>',
                                    className: 'ms-1 btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light custom_more',
                                    extend: 'collection',
                                    buttons: [

                                        {
                                            text: '<svg style="margin-right: 13px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_66_53)"><path d="M19 5.79999C16.8 1.09999 11.4 -1.20001 6.60005 0.69999C2.70005 2.09999 0.500049 4.99999 0.100049 9.09999C-0.0999512 11.2 0.300049 13.3 1.50005 15.1C1.60005 15.3 1.60005 15.4 1.50005 15.6C1.00005 16.7 0.600049 17.7 0.200049 18.8C4.88311e-05 19.1 4.88311e-05 19.4 0.200049 19.7C0.400049 20 0.700049 20 1.10005 19.9C2.50005 19.6 3.90005 19.3 5.30005 18.9C5.50005 18.9 5.60005 18.9 5.80005 18.9C7.10005 19.5 8.60005 19.9 10.4 19.9C11.1 19.9 12.1 19.8 13 19.5C18.7 17.7 21.6 11.3 19 5.79999ZM11.7 18.6C9.70005 19 7.80005 18.7 6.00005 17.8C5.60005 17.6 5.30005 17.6 4.90005 17.7C3.90005 18 2.90005 18.2 1.80005 18.4H1.70005C2.00005 17.6 2.30005 16.8 2.70005 16.1C2.90005 15.6 2.90005 15.3 2.60005 14.8C1.50005 13.2 1.10005 11.5 1.20005 9.59999C1.30005 5.79999 4.00005 2.49999 7.80005 1.49999C12.6 0.19999 17.6 3.29999 18.6 8.19999C19.6 13 16.5 17.7 11.7 18.6Z" fill="#6B6371"/><path d="M10.8 7.9C10.8 8.3 10.8 8.7 10.8 9C10.8 9.2 10.8 9.2 11 9.2C11.7 9.2 12.5 9.2 13.2 9.2C13.7 9.2 14 9.5 14 10C14 10.5 13.6 10.8 13.1 10.8C12.4 10.8 11.7 10.8 10.9 10.8C10.7 10.8 10.7 10.8 10.7 11C10.7 11.7 10.7 12.4 10.7 13.1C10.7 13.7 10.4 14 9.9 14C9.4 14 9.1 13.6 9.1 13.1C9.1 12.4 9.1 11.7 9.1 11C9.1 10.8 9.1 10.8 8.9 10.8C8.2 10.8 7.5 10.8 6.8 10.8C6.3 10.8 6 10.5 6 10C6 9.5 6.3 9.2 6.9 9.2C7.6 9.2 8.3 9.2 9 9.2C9.2 9.2 9.2 9.2 9.2 9C9.2 8.3 9.2 7.6 9.2 6.8C9.2 6.3 9.5 6 10 6C10.5 6 10.8 6.4 10.8 6.9C10.8 7.2 10.8 7.5 10.8 7.9Z" fill="#6B6371"/></g><defs><clipPath id="clip0_66_53"><rect width="20" height="20" fill="white"/></clipPath></defs></svg> Create Salary',
                                            className: 'btn btn-white user-salary btn-sm m-0',
                                            action: function() {
                                                CreateSalary(site_id, id);
                                            }
                                        },


                                    ],
                                }
                            @endif
                        @endif


                    ],
                    "searchPanes": [],
                    "deferRender": true,
                    "scrollX": true,
                    "scrollCollapse": true,
                    "scrollY": "1000px",
                    "dom": "<\"card-header custom_button_card pt-0\"<\"head-label\"><\"dt-action-buttons text-end\"B>><\"d-flex justify-content-between align-items-center mx-0 row custom_datatable_label\"<\"col-sm-12 col-md-6\"l><\"col-sm-12 col-md-6\"f>>t<\"d-flex justify-content-between mx-0 row\"<\"col-sm-12 col-md-6\"i><\"col-sm-12 col-md-6\"p>> C<\"clear\">",
                    "language": {
                        "searchPlaceholder": "Search..."
                    },

                    "order": []
                });
        });
        $('.rowClick').trigger('click');
    }


    function CreateSalary(site_id, id) {
        location.href = '{{ route('sites.hrm.user-salary-increment-details.create', ['site_id' => ':site_id']) }}'
            .replace(':site_id',
                site_id) + '?id=' + id;
    }

    function userSalary_menu($id) {
        $('#loader_' + $id).show();
        $('#dropDownMenu_' + $id).empty()
        $.ajax({
            type: 'post',
            url: "{{ route('sites.hrm.user-salary-increment-details.ajax-action', ['site_id' => encryptParams($site_id), 'id' => ':id']) }}"
                .replace(':id', $id),
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(data) {
                $('#dropDownMenu_' + $id).html(data)
                $('#loader_' + $id).hide();
                console.log(data);
            },
            error: function(data) {
                $('#loader_' + $id).hide();
                console.log('An error occurred.');
            },
        });
    }

    function UserSalaryActive(site_id, id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "we Want Active User Salary !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Active User Salary !'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('sites.hrm.user-salary-increment-details.make-active', ['site_id' => $site_id, 'id' => ':id']) }}'
                        .replace(':id', id),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message) {
                            Swal.fire(
                                'Active!',
                                'This  User Salary already Active.',
                                'error'
                            );

                        }
                        if (response.status) {
                            Swal.fire(
                                'Active!',
                                'Active User Salary.',
                                'success'
                            );
                            $('#user_salary_increment_detail').DataTable().ajax.reload();
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Unable to Active User Salary.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function employmentdelete(site_id, id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "we Want Delete Record !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('sites.hrm.user-salary-increment-details.destroy', ['site_id' => $site_id, 'id' => ':id']) }}'
                        .replace(':id', id),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message) {
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            );

                            $('#user_salary_increment_detail').DataTable().ajax.reload();
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Unable to delete the record.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function payroll_datatable() {

        $("#user_payroll_detail").DataTable({
            ajax: {
                url: "{{ route('sites.users.ajax-get-user-payroll-details', ['site_id' => ':site_id', 'id' => ':id']) }}"
                    .replace(':site_id', site_id).replace(':id', id),
                // hide Loader on completion
                complete: function() {
                    hideBlockUI();
                }
            },
            scrollX: true,
            scrollY: '500px',

            serverSide: true,




            columns: [{
                    data: 'DT_RowIndex',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'user_id',
                    name: 'user.name',
                    className: 'text-center',
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'month_year',
                    name: 'month_year',
                    className: 'text-center',
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'basic_salary',
                    name: 'basic_salary',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'total_allowance_amount',
                    name: 'total_allowance_amount',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'total_tax_amount',
                    name: 'total_tax_amount',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'total_bonus_amount',
                    name: 'total_bonus_amount',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'deduction',
                    name: 'deduction',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'total_custom_deductions_amount',
                    name: 'total_custom_deductions_amount',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'total_working_days',
                    name: 'total_working_days',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'total_presents',
                    name: 'total_presents',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'total_leaves',
                    name: 'total_leaves',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'total_holidays',
                    name: 'total_holidays',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'total_weekend',
                    name: 'total_weekend',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'total_payable_days',
                    name: 'total_payable_days',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'per_day_salary',
                    name: 'per_day_salary',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'net_payable',
                    name: 'net_payable',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    searchable: false,
                },

            ],
            dom: '<"card-header pt-0 custom_button_card "<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row custom_datatable_label"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">',
            buttons: [],
            // buttons: [],
            displayLength: 50,
            lengthMenu: [10, 20, 50, 100, 150, 200],
            language: {
                processing: '<div class=" text-primary mt-5" role="status"><img src="{{ asset('app-assets') }}/images/comming-soon/Loader-current.gif"></div><br><div class="text-primary"></div>',
                searchPlaceholder: "Search...",
                paginate: {
                    previous: "&nbsp;",
                    next: "&nbsp;"
                }
            },

            initComplete: function() {
                hideBlockUI();
            }
        });



        $('.rowClick').trigger('click');
    }

    $(document).ready(function() {

        $('#AddressForm').validate({
            rules: {
                'residential[address_type]': {
                    required: true
                },
                'residential[country]': {
                    required: true
                },
                'residential[state]': {
                    required: true
                },
                'residential[city]': {
                    required: true
                },
                'residential[postal_code]': {
                    required: true,
                    number: true
                },
                'residential[address]': {
                    required: true
                },
                'mailing[address_type]': {
                    required: true
                },
                'mailing[country]': {
                    required: true
                },
                'mailing[state]': {
                    required: true
                },
                'mailing[city]': {
                    required: true
                },
                'mailing[postal_code]': {
                    required: true,
                    number: true
                },
                'mailing[mailingAddress]': {
                    required: true
                }
            },
            messages: {
                // Define custom error messages if needed
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        // personal infortion dob and hiring data
        $("#dob").flatpickr({
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
        $("#hiring_date").flatpickr({
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
        renderDatatable();
        payroll_datatable();

    });
</script>
