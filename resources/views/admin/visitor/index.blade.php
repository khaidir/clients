@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">Visitor</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Visitor</li>
                            <li class="breadcrumb-item active">Lists</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9 mt--2">
                                <div class="col-12">
                                    <div class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12 mt-4">
                                            <span id="dlength"></span>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <a href="/visitor/new" class="btn btn-md btn-primary btn-float" style="margin-top:;">Add New</a>
                                            {{-- <a href="/visitor/token" class="btn btn-md btn-secondary btn-float" style="margin-top:;">Manage Token</a> --}}
                                            <button id="delete-selected" class="btn btn-danger">Delete</button>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <select id="filter-status" class="form-select me-2">
                                                <option value="all">All Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>

                                            <select id="approval-status" class="form-select me-2">
                                                <option value="">Select Approval</option>
                                                <option value="approved">Approved</option>
                                                <option value="rejected">Rejected</option>
                                                <option value="pending">Pending</option>
                                            </select>
                                        </div>
                                        <div class="col-8 col-sm-8 mt-4">
                                            <span id="dfilter"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="d-flex justify-content-end">
                                    <div id="dinfo" class="dinfo"></div>
                                    <div id="dpaging"></div>
                                </div>
                            </div>

                            <div class="col-md-12 responsive mt--2">
                                <table id="table" class="table table-hover data-table table-striped-columns dataTable" style="width:100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="30"><input type="checkbox" id="select-all"></th></th>
                                            <th width="40">ID</th>
                                            <th width="120">Code</th>
                                            <th width="150">PIC</th>
                                            {{-- <th width="350">Description</th> --}}
                                            <th width="350">Purpose</th>
                                            <th width="150">Duration</th>
                                            <th width="150">Date Request</th>
                                            <th width="90">Approval</th>
                                            <th width="90">Status</th>
                                            <th width="140">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('visitor.data') }}",
            data: function(d) {
                d.status = $('#filter-status').val();
            }
        },
        columns: [
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<input type="checkbox" class="row-checkbox" value="${row.id}">`;
                }
            },
            {
                data: null,
                name: 'number',
                orderable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'request_code' },
            { data: 'pic' },
            // { data: 'description' },
            { data: 'destination' },
            { data: 'duration' },
            { data: 'date_request' },
            { data: 'approval' },
            { data: 'status', render: function(data) {
                return data ? 'Active' : 'Inactive';
            }},
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    $('#filter-status').on('change', function() {
        $('#table').DataTable().ajax.reload();
    });

    $("#dlength").append($("#table_length"));
    $("#dfilter").append($("#table_filter"));
    $("#dinfo").append($("#table_info"));
    $("#dpaging").append($("#table_paginate"));

    $('#dfilter input').removeClass('form-control-sm');
    $('.dataTables_paginate').parent().addClass('pagination-rounded justify-content-end mb-2');
    $('#dfilter input').parent().parent().addClass('col-xs-4');
    $('.select2-container').attr("width","70");
    $(".select2").select2({ width: 'resolve' });

    $('select').select2({
        placeholder: 'Choose'
    });
    $('#generate').addClass("mm-active");

    // Event listener untuk "select all"
    $('#select-all').on('click', function() {
        let isChecked = $(this).is(':checked');
        $('.row-checkbox').prop('checked', isChecked);
    });

    // Event listener untuk checkbox individual
    $('#table').on('change', '.row-checkbox', function() {
        if (!$(this).is(':checked')) {
            $('#select-all').prop('checked', false);
        } else if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
            $('#select-all').prop('checked', true);
        }
    });

    $('#delete-selected').on('click', function() {
        let selectedIds = [];
        $('.row-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            Swal.fire(
                'Cancel',
                'Data not ready to delete',
                'error'
            )
            return;
        }

        Swal.fire({
            title: 'Are your sure ?',
            icon: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonClass: 'btn btn-danger',
            confirmButtonText: "Yes, delete!",
            confirmButtonAriaLabel: 'Yes delete',
            cancelButtonClass: 'btn btn-secondary',
            cancelButtonText:'Cancel!',
            cancelButtonAriaLabel: 'Cancel'
        }).then(function(result) {
            if (result?.value && (result?.value[0] != "")) {
                $.ajax({
                    url: "{{ route('visitor.massDelete') }}",
                    type: 'POST',
                    data: {
                        ids: selectedIds,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Success!',
                            response.message,
                            'success'
                        )
                        $('#table').DataTable().ajax.reload();
                        $('#select-all').prop('checked', false);
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Cancel',
                            'An error occurred. Please try again.',
                            'error'
                        )
                    }
                });
            } else if (
            result.dismiss === swal.DismissReason.cancel
            ) {
                Swal.fire(
                    'Cancel',
                    'Data do not delete',
                    'error'
                )
            }
        })
    });

    $('#approval-status').on('change', function() {
        let selectedIds = [];
        $('.row-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });

        let status = $('#approval-status').val();

        if (selectedIds.length === 0) {
            // alert('No rows selected!');
            Swal.fire(
                'Success!',
                'No rows selected!',
                'success'
            )
            return;
        }

        if (!status) {
            // alert('Please select an approval status!');
            Swal.fire(
                'Success!',
                'Please select an approval status!',
                'success'
            )
            return;
        }

        Swal.fire({
            title: 'Are your sure ?',
            icon: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonClass: 'btn btn-danger',
            confirmButtonText: "Yes, delete!",
            confirmButtonAriaLabel: 'Yes delete',
            cancelButtonClass: 'btn btn-secondary',
            cancelButtonText:'Cancel!',
            cancelButtonAriaLabel: 'Cancel'
        }).then(function(result) {
            if (result?.value && (result?.value[0] != "")) {
                $.ajax({
                    url: "{{ route('visitor.massApprove') }}",
                    type: 'POST',
                    data: {
                        ids: selectedIds,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Success!',
                            response.message,
                            'success'
                        )
                        $('#table').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Cancel',
                            'An error occurred. Please try again.',
                            'error'
                        )
                    }
                });
            } else if (
            result.dismiss === swal.DismissReason.cancel
            ) {
                Swal.fire(
                    'Cancel',
                    'Data do not delete',
                    'error'
                )
            }
        })
    });

    $(document).on('click', '.delete', function () {

        var id = $(this).data('id');
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success btn-rounded',
            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
            buttonsStyling: false,
        })

        Swal.fire({
            title: 'Are your sure ?',
            icon: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonClass: 'btn btn-danger',
            confirmButtonText: "Yes, delete!",
            confirmButtonAriaLabel: 'Yes delete',
            cancelButtonClass: 'btn btn-secondary',
            cancelButtonText:'Cancel!',
            cancelButtonAriaLabel: 'Cancel'
        }).then(function(result) {
            if (result?.value && (result?.value[0] != "")) {
                $.ajax({
                    url : '/visitor/delete/' + id,
                    type : "get",
                    success: function(response){
                        Swal.fire(
                            'Success!',
                            'Data deleted',
                            'success'
                        )
                        $('.data-table').dataTable().api().ajax.reload();
                    },
                    error: function (data) {
                        Swal.fire(
                            'Wrong',
                            'Internal server error',
                            'error'
                        )
                    }
                });
            } else if (
            result.dismiss === swal.DismissReason.cancel
            ) {
                Swal.fire(
                    'Cancel',
                    'Data do not delete',
                    'error'
                )
            }
        })
        });
});
</script>
@endsection

