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
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="col-xl-12 col-sm-12">
                            <h4 class="card-title">Visitor</h4>
                            <p class="card-title-desc">Data Visitor & Person</p>
                            <table class="table table-nowrap">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px;">Description</td>
                                        <td style="width: 800px;">{{ @$data->description}}</td>
                                    </tr>
                                    <tr>
                                        <td>Destination</td>
                                        <td>{{ @$data->destination}}</td>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <td>{{ (@$data->duration > 1 )? @$data->duration. " Hours": @$data->duration ." Hour" }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" href="/visitor/person/{{ @$id }}" role="tab" aria-selected="true">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">Person</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" href="/visitor/ppe/{{ @$id }}" role="tab" aria-selected="false" tabindex="-1">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">PPE</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" role="tabpanel">
                                    <div class="row">
                                        {{-- <div class="col-md-9 mt--2">
                                            <div class="col-9">
                                                <div class="row row-cols-lg-auto g-3 align-items-center">
                                                    <div class="col-12 mt-4">
                                                        <span id="dlength"></span>
                                                    </div>
                                                    <div class="col-12 col-sm-12">
                                                        <a href="/visitor/ppe/new-bulk/{{ @$id }}" class="btn btn-md btn-primary btn-float" style="margin-top:;">Add PPE</a>
                                                    </div>
                                                    <div class="col-12 col-sm-12 mt-4">
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
                                        </div> --}}

                                        <div class="col-md-12 responsive mt--2">
                                            <table class="table table-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 100px;">Helmet</td>
                                                        <td style="width: 800px;"><strong>{{ @$data->ppe_helmet}}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Glasses</td>
                                                        <td><strong>{{ @$data->ppe_glasses}}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shoeses</td>
                                                        <td><strong>{{ @$data->ppe_shoes }}</strong> <i class='bx bx-right-arrow-alt mt-1'></i> with size 41: <strong>{{ @$size_shoes[0] }}</strong>, 42: <strong>{{ @$size_shoes[1] }}</strong> and 43: <strong>{{ @$size_shoes[2] }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Vest</td>
                                                        <td><strong>{{ @$data->ppe_vest }}</strong> <i class='bx bx-right-arrow-alt mt-1'></i> with size Large <strong>{{ @$size_vest[0] }}</strong>, Extra Large: <strong>{{ @$size_vest[1] }}</strong> and Double Extra LargeL: <strong>{{ @$size_vest[2] }}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            {{-- <table id="table" class="table table-hover data-table table-striped-columns dataTable" style="width:100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="40">ID</th>
                                                        <th width="80">Code</th>
                                                        <th width="160">Type</th>
                                                        <th width="100">Date Pickup</th>
                                                        <th width="100">Date Return</th>
                                                        <th width="260">Notes</th>
                                                        <th width="90">Status</th>
                                                        <th width="100">Action</th>
                                                    </tr>
                                                </thead>
                                            </table> --}}
                                        </div>
                                    </div>
                                </div>
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
        ajax: "{{ route('visitor-ppe.data', $data->id) }}",
        columns: [
            {
                data: null,
                name: 'number',
                orderable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'code' },
            { data: 'goods' },
            { data: 'date_pickup' },
            { data: 'date_return' },
            { data: 'notes' },
            { data: 'status', render: function(data) {
                return data == true ? 'Not returned' : 'Has been returned';
            }},
            { data: 'action', orderable: false, searchable: false }
        ]
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
                    url : '/visitor/ppe/delete/' + id,
                    type : "get",
                    success: function(response){
                        Swal.fire(
                            'Success!',
                            'Data deleted',
                            'success'
                        )
                        $('#table').dataTable().api().ajax.reload();
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
