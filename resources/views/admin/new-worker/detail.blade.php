@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">New Worker Access</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">New Worker Access</li>
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
                            <h4 class="card-title">Worker Access</h4>
                            <p class="card-title-desc">Please fill out the form below completely.</p>
                            <table class="table table-nowrap">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px;">Company</td>
                                        <td style="width: 800px;">{{ @$data->company}}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ @$data->description}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Contract</td>
                                        <td>{{ @$data->no_contract}}</td>
                                    </tr>
                                    <tr>
                                        <td>Type Contract</td>
                                        <td>{{ ($type[$data->type_contract] ?? '-') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Periode</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse(@$data->periode_start)->format('d M, Y') .' - '. \Illuminate\Support\Carbon::parse(@$data->periode_end)->format('d M, Y')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-9 mt--2">
                                <div class="col-9">
                                    <div class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12 mt-4">
                                            <span id="dlength"></span>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <a href="/worker/person/new/{{ @$id }}" class="btn btn-md btn-primary btn-float" style="margin-top:;">Add Person</a>
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
                            </div>

                            <div class="col-md-12 responsive mt--2">
                                <table id="table" class="table table-hover data-table table-striped-columns dataTable" style="width:100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="40">ID</th>
                                            <th width="120">Card ID</th>
                                            <th width="220">Fullname/Email</th>
                                            <th width="350">Position</th>
                                            <th width="90">Status</th>
                                            <th width="90">Post</th>
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
        ajax: "{{ route('sia-person.data', $data->id) }}",
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
            { data: 'id_card' },
            { data: 'fullname' },
            { data: 'position' },
            { data: 'status', render: function(data) {
                return data ? 'Uploaded' : 'Not uploaded yet';
            }},
            { data: 'post', render: function(data) {
                return data ? 'Sended' : 'Not send yet';
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
                    url : '/worker/person/delete/' + id,
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
