<link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" rel="stylesheet">
<link href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css" rel="stylesheet">
<style>
    table.fixedHeader-floating.no-footer th {
        font-size: 12px !important;
        padding: 14px 0 !important;
    }

    .dtfh-floatingparent.dtfh-floatingparent-head {
        z-index: 999 !important;
    }

    span.dt-column-order {
        opacity: 0;
    }

    .dtfh-floatingparent.dtfh-floatingparent-head th {
        /* font-size: 12px; */
    }

    table.dataTable>thead>tr>th,
    table.dataTable>thead>tr>td {
        background: #07529B;
        color: #fff;
        text-align: center;
    }
</style>

<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row justify-content-end">

        <div class="col-lg-auto col-md-auto col-sm-auto col-12 my-auto">
            <h2 class="main_title">{{ $title }}</h2>
        </div>

        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Compliance')
            <div class="col-lg-2 col-md-3 col-sm-4 ms-auto mb-2">
                <select class="select2 js-example-basic-single select-label form-control w-100"
                    name="custom_division_filter" id="custom_division_filter" onchange="studyFilterData()">
                    <option value="" selected>Study Division</option>
                    @foreach ($divisionList as $key => $value)
                        <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-lg-2 col-md-3 mb-2 col-sm-4 col-auto {{ Auth::user()->role == 'Division' ? 'ms-auto' : '' }}">
            <select class="select2 js-example-basic-single select-label form-control w-100" name="custom_study_filter"
                id="custom_study_filter">
                <option value="" selected>All Study</option>
            </select>
        </div>
        {{-- <div class="col-lg-2 col-md-3 col-sm-4 col-auto">
            <select class="select2 js-example-basic-single select-label form-control w-100" name="custom_doctor_id"
                id="custom_doctor_id">
                <option value="" selected>All Contracts</option>
            </select>
        </div> --}}
        <div class="col-lg-2 col-md-3 col-sm-4 col-auto mb-2">
            <select class="select2 js-example-basic-single select-label form-control w-100" name="custom_is_suspend"
                id="custom_is_suspend">
                <option value="" selected>Select Status</option>
                <option value="Y">Suspended</option>
                <option value="N">Unsuspended</option>
            </select>
        </div>
        <div class="col-lg-auto col-md-auto col-sm-auto col-auto mb-2">
            <div class="d-flex align-items-center">
                <div id="reportrange" class="daterange">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                    <input type="hidden" name="dtFrom" id="dtFrom">
                    <input type="hidden" name="dtTo" id="dtTo">
                </div>
                <a href="#" class="btn btn-primary ms-2" onclick="setFilter()"><i class="fa fa-search"></i></a>
                <a href="#" class="btn btn-danger ms-2" onclick="resetFilter()"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="col-lg-auto  col-md-auto col-sm-auto mb-2">
            {{-- @if (Auth::user()->role == 'Admin') --}}
            @if (Auth::user()->role != 'Division')
                <a href="#" class="btn btn-success" onclick="RsaExportData()"><i
                        class="fa fa-download me-2"></i>RSA Report
                </a>
            @endif
            <a href="#" class="btn btn-success" onclick="exportData()"><i class="fa fa-download me-2"></i>Export
            </a>
        </div>

    </div>

    <div class="row mb-3">
    </div>

    <div class="row">

        <div class="col-12">
            <table id="datatable" class="table table-striped data-table-dr" style="width:100%">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Doctor Name</th>
                        <th>Action</th>
                        <th>Doctor Center Code</th>
                        <th>Field Center Code</th>
                        <th>Place</th>
                        <th>Study</th>
                        <th>Patients: Filled/Assigned </th>
                        <th>Email Status </th>
                        <th>Consultancy Form </th>
                        <th>Investigator Declaration</th>
                        <th>PAN Card </th>
                        <th>Cancelled Cheque </th>
                        <th>GST</th>
                        <th>Final Submit </th>
                        <th>Activation Date</th>
                        <th>Honorarium Amount </th>
                        <th>Doctor Final Submitted Date Time</th>
                        <th>Division Verified Date Time</th>
                        <th>Compliance Verified Date Time</th>
                        <th>Contract Generated Date and Time</th>
                    </tr>
                </thead>
                <tbody>


                <tbody>
            </table>
        </div>

    </div>

</div>

</div>


@include('division.layout.footer')
@include('division.modals')

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script>


<script>
    function checkAllFunction() {
        const isChecked = $('#checkAll').is(':checked');
        $('.checkItem').prop('checked', isChecked);
    }

    $('.checkItem').change(function() {
        if (!$(this).prop('checked')) {
            $('#checkAll').prop('checked', false);
        }
    });

    $('#checkAll').change(function() {
        checkAllFunction();
    });

    @if (Auth::user()->role == 'Division')
        studyFilterData();
    @endif
    function studyFilterData() {
        $.ajax({
            url: "{{ route('getStudyData') }}",
            type: "POST",
            data: {
                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Compliance')
                    division_id: $('#custom_division_filter option:selected').val(),
                @else
                    division_id: '{{ Auth::user()->id }}',
                @endif
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                $('#custom_study_filter').html('<option value="">Select Study</option>');
                $.each(result, function(key, value) {
                    $("#custom_study_filter").append('<option value="' + value.study_id + '">' +
                        value
                        .study_name + '</option>');
                });
            }
        })
    }

    // doctorFilterData();

    // function doctorFilterData() {
    //     $.ajax({
    //         url: "{{ route('getDoctorData') }}",
    //         type: "POST",
    //         data: {
    //             _token: '{{ csrf_token() }}'
    //         },
    //         success: function(result) {
    //             $('#custom_doctor_id').html('<option value="">Select Doctor</option>');
    //             $.each(result, function(key, value) {
    //                 $("#custom_doctor_id").append('<option value="' + value.hcp_unique_code + '">' +
    //                     value
    //                     .dr_name + '</option>');
    //             });
    //         }
    //     })
    // }


    function suspendStatusSet(id, suspendstatus, dr) {
        $("#suspendID").val(id);
        $("#suspendstatus").val(suspendstatus);

        if (suspendstatus == 'N') {
            document.getElementById("suspend_dr_que").innerHTML = "Are you sure you want to Suspend Dr. " + dr +
                "'s Contract?";
        } else {
            document.getElementById("suspend_dr_que").innerHTML = "Are you sure you want to Unsuspend Dr. " + dr +
                "'s Contract?";
        }
    }

    function suspendStatusChange() {
        $.ajax({
            url: "{{ route('division.suspendStatusSet') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                id: $("#suspendID").val(),
                is_suspend: $("#suspendstatus").val()
            },
            success: function(response) {
                $("#suspendID").val('');
                $("#suspendstatus").val('');
                if (typeof response.status !== 'undefined') {
                    if (response.status == 0) {
                        if (notify == 1)
                            $.notify(response.message, "error");
                    } else {
                        if (notify == 1 && response.message != '')
                            $.notify(response.message, "success");
                    }
                }
                $("#suspend").modal('hide');
                $('#datatable').DataTable().ajax.reload(null, false);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 419) {
                    $.notify("Please refresh the Page", "error");
                } else if (jqXHR.status == 500) {
                    $.notify("Please try after a few minutes", "error");
                } else {
                    $.notify(jqXHR.responseJSON.message, "error");
                }

            }
        });
    }


    function resetSuspendStatus() {
        $("#suspendID").val('');
        $("#suspendstatus").val('');
    }



    function setFilter() {
        $('#datatable').DataTable().ajax.reload();
    }
    $(function() {

        var start = moment().subtract('Year').startOf('Year');
        var end = moment().subtract('Year').endOf('Year');

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                'MMMM D, YYYY'));
            $("#dtFrom").val(start.format('YYYY-MM-DD'));
            $("#dtTo").val(end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1,
                    'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
                    .subtract(1, 'month').endOf('month')
                ],
                'This Year': [moment().subtract('Year').startOf('Year'), moment().subtract('Year')
                    .endOf('Year')
                ]
            }
        }, cb);

        cb(start, end);

    });

    // setFilter();

    function resetFilter() {
        $("#custom_study_filter").val('').select2();
        $("#custom_doctor_id").val('').select2();
        $("#custom_is_suspend").val('').select2();

        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Compliance')
            $("#custom_division_filter").val('').select2();
            $('#custom_study_filter').html('<option value="">Select Study</option>');
        @endif
        var start = moment().subtract('Year').startOf('Year');
        var end = moment().subtract('Year').endOf('Year');
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
            'MMMM D, YYYY'));
        $("#dtFrom").val(start.format('YYYY-MM-DD'));
        $("#dtTo").val(end.format('YYYY-MM-DD'));
        $('#datatable').DataTable().ajax.reload();
    }




    $(function() {
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'dr_name',
                name: 'dr_name',
                searchable: false
            },
            {
                data: 'action',
                searchable: false,
                orderable: false,
            },
            {
                data: 'doctor_central_code',
                name: 'doctor_central_code',
            },
            {
                data: 'field_central_code',
                name: 'field_central_code',
            },

            {
                data: 'place',
                name: 'place'
            },
            {
                data: 'study_name',
                name: 'study_name'
            },
            {
                data: 'patient_count',
                name: 'patient_count'
                // searchable: false
            },
            // {
            //     data: 'greeting_letter',
            //     searchable: false
            // },
            {
                data: 'is_mail_sent',
                name: 'is_mail_sent',
                searchable: false,
            },
            {
                data: 'concent_document',
                name: 'concent_document',
                searchable: false,
                orderable: false    
            },
            {
                data: 'investigator_document',
                name: 'investigator_document',
                searchable: false,
                orderable: false
            },
            {
                data: 'panDetails_document',
                name: 'panDetails_document',
                searchable: false,
                orderable: false
            },
            {
                data: 'bankDetails_document',
                name: 'bankDetails_document',
                searchable: false,
                orderable: false
            },
            {
                data: 'gstDetails_document',
                name: 'gstDetails_document',
                searchable: false,
                orderable: false
            },
            {
                data: 'doctor_submit_declaration',
                // "orderable": false,
                searchable: false
            },
            {
                data: 'activation_date',
                searchable: true
            },
            {
                data: 'doctor_amount',
                searchable: false
            },
            {
                data: 'doctor_final_submitted_at',
                searchable: false
            },
            {
                data: 'division_contract_approved_at',
                searchable: false
            },
            {
                data: 'complaince_approved_at',
                searchable: false
            },
            {
                data: 'created_at',
                searchable: false
            }
        ];
        var columnDefs = [
            // {
            //     'targets': 0,
            //     'checkboxes': {
            //         'selectRow': true,
            //     }
            // }
        ];
        getdatatable("{{ route('division.contract.paginate') }}", columns, columnDefs);
    });


    function getdatatable(url, columns, columnDefs) {

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            fixedHeader: true,
            order: [],
            "scrollX": true,
            columns: columns,
            columnDefs: columnDefs,
            ajax: {
                method: 'post',
                url: url,
                data: function(d) {
                    d._token = "{{ csrf_token() }}",
                        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Compliance')
                            d.custom_division_filter = $('#custom_division_filter option:selected').val(),
                        @endif
                    d.custom_study_filter = $('#custom_study_filter option:selected').val(),
                        d.custom_doctor_id = $('#custom_doctor_id option:selected').val(),
                        d.custom_is_suspend = $('#custom_is_suspend option:selected').val(),

                        d.dtFrom = $("#dtFrom").val(),
                        d.dtTo = $("#dtTo").val(),

                        d.module = '{{ $module }}'
                }
            },
            "drawCallback": function(settings) {
                new VenoBox({
                    selector: '.venobox_img',
                });
                //for check box
                $('#checkall').prop('checked', false);
                $('.actionBtn').hide();
                $('.dt-checkboxes').click(function() {
                    if ($('[name="checkbox[]"]:checked').length > 0) {
                        $('.actionBtn').show();
                    } else {
                        $('.actionBtn').hide();
                    }
                });
            }
        });
    }


    function stepData(id, type = '', modulename) {
        if (type == 2) {
            $("#edit_pan_no").rules('add', 'validate_pan');
            $("#edit_pan_name").rules('add', 'required');
            $("#edit_pan_no").rules('add', 'required');
            // $("#edit_aadhar_pan_link").rules('add', 'required');

            $("#edit_cheque_name").rules('remove', 'required');
            $("#edit_bank_account_no").rules('remove', 'required');
            $("#edit_re_bank_account_no").rules('remove', 'required');
            $("#edit_ifsc_code").rules('remove', 'required');
            $("#edit_account_type").rules('remove', 'required');
            $("#edit_ifsc_code").rules('remove', 'validate_ifsc');


            $("#edit_gst_no").rules('remove', 'required');
            $("#edit_gst_no").rules('remove', 'validate_gst');


        }
        if (type == 3) {
            $("#edit_ifsc_code").rules('add', 'validate_ifsc');
            $("#edit_cheque_name").rules('add', 'required');
            $("#edit_bank_account_no").rules('add', 'required');
            $("#edit_re_bank_account_no").rules('add', 'required');
            $("#edit_ifsc_code").rules('add', 'required');
            $("#edit_account_type").rules('add', 'required');
            $("#edit_pan_no").rules('remove', 'validate_pan');
            $("#edit_pan_name").rules('remove', 'required');
            $("#edit_pan_no").rules('remove', 'required');
            // $("#edit_aadhar_pan_link").rules('remove', 'required');
            $("#edit_gst_no").rules('remove', 'required');
            $("#edit_gst_no").rules('remove', 'validate_gst');


        }

        if (type == 4) {
            $("#edit_gst_no").rules('add', 'required');
            $("#edit_gst_no").rules('add', 'validate_gst');

            $("#edit_pan_name").rules('remove', 'required');
            $("#edit_pan_no").rules('remove', 'required');
            // $("#edit_aadhar_pan_link").rules('remove', 'required');

            $("#edit_cheque_name").rules('remove', 'required');
            $("#edit_bank_account_no").rules('remove', 'required');
            $("#edit_re_bank_account_no").rules('remove', 'required');
            $("#edit_ifsc_code").rules('remove', 'required');
            $("#edit_account_type").rules('remove', 'required');
            $("#edit_pan_no").rules('remove', 'validate_pan');
            $("#edit_ifsc_code").rules('remove', 'validate_ifsc');
        }




        $.ajax({
            url: "{{ route('division.contract.step') }}",
            type: "POST",
            data: {
                id: id,
                step_id: type,
                module: modulename,
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                $("#document_area").html(result);
                $("#approve_detiles").modal('show');

            }
        })
    }


    function viewAllDocument(id, modulename) {
        $.ajax({
            url: "{{ route('division.all.view') }}",
            type: "POST",
            // type: 'GET',
            data: {
                id: id,
                module: modulename,
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                $("#all_document_area").html(result);
                $("#view_all_documents").modal('show');

            }
        })
    }



    function documentStatusChange(id, status) {

        if (status == 'approved') {
            $.ajax({
                url: "{{ route('division.document.statusChange') }}",
                type: "POST",
                data: {
                    id: id,
                    document_status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $("#view_all_documents").modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                }
            })

        } else {
            $("#status_id").val(id);
            $("#document_status").val(status);
        }
    }

    function contractStatusChange(id, status) {

        if (status == 'compliance_verified') {

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Verify it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('division.contract.statusChange') }}",
                        type: "POST",
                        data: {
                            id: id,
                            document_status: status,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            $("#view_all_documents").modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                        }
                    })

                }
            })

        } else {
            $("#contract_status_id").val(id);
            $("#contract_status").val(status);
        }
    }


    function multiple_reject_remark_option_handle(doctorId, status) {
        let selectedCheckboxes = document.querySelectorAll('.checkItem:checked');

        if (selectedCheckboxes.length === 0) {
            $.notify('Please select at least one document.', 'info');
            return;
        }
        // Gather all checked checkbox values
        let checkedValues = [];
        $('.checkItem:checked').each(function() {
            checkedValues.push($(this).val());
        });

        // Set the gathered values to the hidden input field
        $('#multiple_status_id').val(checkedValues.join(','));
        $('#multiple_form_doctor_id').val(doctorId);

        // setting status to rejected
        $("#multiple_document_status").val(status);

        $("#view_all_documents").modal('hide');
        $('#datatable').DataTable().ajax.reload();
        // Open the modal
        $('#multiple_reject_remark').modal('show');
    }

    $('#validateMultipleRejectionForm').validate({
        ignore: ".ignore",
        rules: {
            status_id: {
                required: true
            },
            doctor_id: {
                required: true
            },
            document_status: {
                required: true
            },
            remarks: {
                required: true
            },
        },
        messages: {},
        submitHandler: function(form) {
            $("#multiple_document_rejection_remarks_btn").attr('disabled', true);
            var formData = new FormData($("#validateMultipleRejectionForm")[0]);
            $.ajax({
                url: "{{ route('division.document.multiplestatusChange') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response == 1) {
                        $.notify("Status Changed", "success");
                        $("#view_all_documents").modal('hide');
                        $("#multiple_reject_remark").modal('hide');


                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.notify("Something went Wrong", "error");
                        $('#datatable').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $("#multiple_document_rejection_remarks_btn").attr('disabled', false);
                    var errors = $.parseJSON(data.responseText);
                    $.notify("Required Fields are missing", "error");

                }
            }); //ajax
        }
    });

    $('#validateRejectionForm').validate({
        ignore: ".ignore",
        rules: {
            status_id: {
                required: true
            },
            document_status: {
                required: true
            },
            remarks: {
                required: true
            },
        },
        messages: {},
        submitHandler: function(form) {
            $("#rejection_remarks_btn").attr('disabled', true);
            var formData = new FormData($("#validateRejectionForm")[0]);
            $.ajax({
                url: "{{ route('division.document.statusChange') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response == 1) {
                        $.notify("Status Changed", "success");
                        $("#view_all_documents").modal('hide');
                        $("#reject_remark").modal('hide');


                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.notify("Something went Wrong", "error");
                        $('#datatable').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $("#rejection_remarks_btn").attr('disabled', false);
                    var errors = $.parseJSON(data.responseText);
                    $.notify("Required Fields are missing", "error");

                }
            }); //ajax
        }
    });

    $('#validateComplianceRejectionForm').validate({
        ignore: ".ignore",
        rules: {
            contract_status_id: {
                required: true
            },
            contract_status: {
                required: true
            },
            compliance_rejection_remarks: {
                required: true
            },
        },
        messages: {},
        submitHandler: function(form) {
            $("#compliance_rejection_remarks_btn").attr('disabled', true);
            var formData = new FormData($("#validateComplianceRejectionForm")[0]);
            $.ajax({
                url: "{{ route('division.contract.statusChange') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response == 1) {
                        $.notify("Status Changed", "success");
                        $("#view_all_documents").modal('hide');
                        $("#compliance_reject_remark").modal('hide');

                        location.reload();
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.notify("Something went Wrong", "error");
                        $('#datatable').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $("#compliance_rejection_remarks_btn").attr('disabled', false);
                    var errors = $.parseJSON(data.responseText);
                    $.notify("Invalid Input", "error");

                }
            }); //ajax
        }
    });

    jQuery.validator.addMethod("validate_pan", function(value, element) {
        var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;

        if (value.match(regex)) {
            return true;
        } else {
            return false;
        }

    }, "Please enter valid pan card details.");

    jQuery.validator.addMethod("validate_gst", function(value, element) {
        var regex = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/;

        // alert(value.match(regex));
        if (value.match(regex) == value) {
            return true;
        } else {
            return false;
        }

    }, "Please enter valid GST Number");


    jQuery.validator.addMethod("validate_ifsc", function(value, element) {
        var regex = /^[A-Z]{4}0[A-Z0-9]{6}$/;

        if (value.match(regex)) {
            return true;
        } else {
            if ($('#bank_name').val() != '') {
                $('#bank_name').val('');
                return false;
            } else {
                return true;
            }

        }

    }, "Please enter valid IFSC Code");
    jQuery.validator.addMethod("validate_text", function(value, element) {
        var regex = /^[a-zA-Z\s]+$/;
        if (value.match(regex)) {
            return true;
        } else {
            return false;
        }


    }, "Please enter valid details.");



    $('#validateEditForm').validate({
        ignore: ".ignore",
        rules: {
            edit_step_id: {
                required: true
            },
            edit_pan_name: {
                required: true,
                'validate_text': true
            },
            edit_pan_no: {
                required: true,
                'validate_pan': true
            },
            edit_cheque_name: {
                required: true
            },
            edit_bank_account_no: {
                required: true
            },
            edit_re_bank_account_no: {
                required: true
            },
            edit_ifsc_code: {
                required: true,
                'validate_ifsc': true
            },

            edit_account_type: {
                required: true
            },
            edit_gst_no: {
                required: true,
                'validate_gst': true
            },
        },
        messages: {},
        submitHandler: function(form) {
            $("#edit_btn").attr('disabled', true);
            var formData = new FormData($("#validateEditForm")[0]);
            $.ajax({
                url: "{{ route('division.document.update') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response == 1) {
                        $.notify("Status Changed", "success");
                        $("#approve_detiles").modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.notify("Something went Wrong", "error");
                        $('#datatable').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $("#edit_btn").attr('disabled', false);
                    var errors = $.parseJSON(data.responseText);
                    $.notify("Required Fields are missing", "error");
                }
            }); //ajax
        }
    });



    function downloadDocuments(id) {


        $.ajax({
            url: "{{ route('division.download.documents') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                var doctorname = "alldocuments";


                var link = document.createElement('a');
                link.href = result;

                link.download = doctorname + '-' + '.pdf';
                link.dispatchEvent(new MouseEvent('click'));

                $("#view_all_documents").modal('hide');
            }
        })
    }



    function updatePANNo(id, panNo) {
        $("#update_pan_no").rules('add', 'validate_pan');
        $("#update_pan_no").rules('add', 'required');

        $("#update_pan_no_id").val(id);
        $("#update_pan_no").val(panNo);
        $("#update_panNo").modal('show');

    }



    $('#validatepannoupdateForm').validate({
        ignore: ".ignore",
        rules: {
            update_pan_no_id: {
                required: true
            },
            update_pan_no: {
                required: true,
                'validate_pan': true
            }
        },
        messages: {},
        submitHandler: function(form) {
            $("#pannoupdate_remarks_btn").attr('disabled', true);
            var formData = new FormData($("#validatepannoupdateForm")[0]);
            $.ajax({
                url: "{{ route('division.panNo.update') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response == 1) {
                        $.notify("Status Changed", "success");
                        $("#update_panNo").modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.notify("Something went Wrong", "error");
                        $('#datatable').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $("#pannoupdate_remarks_btn").attr('disabled', false);
                    var errors = $.parseJSON(data.responseText);
                    $.notify("Required Fields are missing", "error");
                }
            }); //ajax
        }
    });



    function manualMailSet(id, dr) {
        $("#manualMailID").val(id);
        document.getElementById("mail_dr_que").innerHTML =
            "Are you sure you want to send invitation details to Doctor & RSM?";
    }


    function comment(comment) {

        document.getElementById("comment_id").innerHTML =
            comment;
    }



    function manualMailSend() {
        $('#manualMailSend_btn_id').attr('disabled', true);
        $.ajax({
            url: "{{ route('division.manualMailSend') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                id: $("#manualMailID").val()
            },
            success: function(response) {
                $('#manualMailSend_btn_id').attr('disabled', false);
                $("#manualMailID").val('');
                // if (typeof response.status !== 'undefined') {
                // if (response.status == 0) {
                // if (notify == 1)
                // $.notify(response.message, "error");
                // } else {
                // if (notify == 1 && response.message != '')
                $.notify('Message Sent', "success");
                // }
                // }

                // setTimeout(function() {
                //         location.reload();
                //     }, 2000);


                $("#email_letter").modal('hide');
                $('#datatable').DataTable().ajax.reload(null, false);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 419) {
                    $.notify("Please refresh the Page", "error");
                } else if (jqXHR.status == 500) {
                    $.notify("Please try after a few minutes", "error");
                } else {
                    $.notify(jqXHR.responseJSON.message, "error");
                }

            }
        });
    }



    function resetManualMailSend() {
        $("#manualMailID").val('');
    }


    function RsaExportData() {
        $.ajax({
            type: "POST",
            url: "{{ route('division.contractData.rsaexport') }}",
            data: {
                _token: "{{ csrf_token() }}",

                // @if (Auth::user()->role == 'Admin')
                //     custom_division_filter: $('#custom_division_filter option:selected').val(),
                // @endif

                // dtFrom: $("#dtFrom").val(),
                // dtTo: $("#dtTo").val(),
            },
            success: function(response) {
                if (response == 1) {
                    $.notify("You will get generated report within 10 minutes in download report section.",
                        "info");
                } else {

                    $.notify('Something went wrong !', "error");
                }
            }
        });
    }

    function exportData() {
        $.ajax({
            type: "POST",
            url: "{{ route('division.contractData.export') }}",
            //  async: false,

            data: {

                _token: "{{ csrf_token() }}",
                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Compliance')
                    custom_division_filter: $('#custom_division_filter option:selected').val(),
                @endif
                custom_study_filter: $('#custom_study_filter option:selected').val(),
                custom_doctor_id: $('#custom_doctor_id option:selected').val(),
                custom_is_suspend: $('#custom_is_suspend option:selected').val(),

                dtFrom: $("#dtFrom").val(),
                dtTo: $("#dtTo").val(),

                module: '{{ $module }}'
            },
            success: function(response) {
                if (response == 1) {
                    $.notify("You will get generated report within 10 minutes in download report section.",
                        "info");
                } else {

                    $.notify('Something went wrong !', "error");
                }
            }
        });
    }
</script>
