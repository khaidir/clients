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
                            <li class="breadcrumb-item">New Worker Person</li>
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
                            <h4 class="card-title">Worker Person Access</h4>
                            <p class="card-title-desc">Please fill out the form below completely.</p>
                            <table class="table table-nowrap">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px;">Card ID</td>
                                        <td style="width: 800px;">#{{ @$data->id_card }}</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ @$data->fullname }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ @$data->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td>{{ @$data->position }}</td>
                                    </tr>
                                    <tr>
                                        <td>KTP</td>
                                        <td>
                                            @if(!empty($data->ktp))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#ktpModal">
                                                    View KTP
                                                </a>
                                                <div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ktpModalLabel">KTP Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->ktp }}" alt="KTP Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>KTP not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Passport</td>
                                        <td>
                                            @if(!empty($data->passport))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#passportModal">
                                                    View Passport
                                                </a>
                                                <div class="modal fade" id="passportModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ktpModalLabel">Passport Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->passport }}" alt="Passport Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>Passport not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Card ID</td>
                                        <td>
                                            @if(!empty($data->card_id))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#cardidModal">
                                                    View Card ID
                                                </a>
                                                <div class="modal fade" id="cardidModal" tabindex="-1" aria-labelledby="cardidModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="cardidModalLabel">Card ID Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->card_id }}" alt="Card ID Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>Card ID not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>BPJS</td>
                                        <td>
                                            @if(!empty($data->bpjs))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#bpjsModal">
                                                    View BPJS
                                                </a>
                                                <div class="modal fade" id="bpjsModal" tabindex="-1" aria-labelledby="bpjsModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="bpjsModalLabel">BPJS Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->bpjs }}" alt="BPJS Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>BPJS not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contract</td>
                                        <td>
                                            @if(!empty($data->contract))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#contractModal">
                                                    View Contract
                                                </a>
                                                <div class="modal fade" id="contractModal" tabindex="-1" aria-labelledby="contractModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="contractModalLabel">Contract Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->contract }}" alt="Contract Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>Contract not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Certificate Competence</td>
                                        <td>
                                            @if(!empty($data->cert_competence))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#cert_competenceModal">
                                                    View Certificate Competence
                                                </a>
                                                <div class="modal fade" id="cert_competenceModal" tabindex="-1" aria-labelledby="cert_competenceModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ktpModalLabel">Certificate Competence Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->cert_competence }}" alt="Certificate Competence Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>Certificate Competence not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Medical Checkup</td>
                                        <td>
                                            @if(!empty($data->medical_checkup))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#medical_checkupModal">
                                                    View Medical Checkup
                                                </a>
                                                <div class="modal fade" id="medical_checkupModal" tabindex="-1" aria-labelledby="medical_checkupModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="medical_checkupModalLabel">Medical Checkup Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->medical_checkup }}" alt="Medical Checkup Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>Medical Checkup not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>License Driver</td>
                                        <td>
                                            @if(!empty($data->license_driver))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#license_driverModal">
                                                    View License Driver
                                                </a>
                                                <div class="modal fade" id="license_driverModal" tabindex="-1" aria-labelledby="license_driverModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="license_driverModalLabel">License Driver Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->license_driver }}" alt="License Driver Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>License Driver not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>License Vaccinated</td>
                                        <td>
                                            @if(!empty($data->license_vaccinated))
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#license_vaccinatedModal">
                                                    View License Vaccinated
                                                </a>
                                                <div class="modal fade" id="license_vaccinatedModal" tabindex="-1" aria-labelledby="license_vaccinatedModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="license_vaccinatedModalLabel">License Driver Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/storage/uploads/{{ $data->license_vaccinated }}" alt="License Vaccinated Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>License Vaccinated not available.</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row justify-content-end">
                                <div class="col-md-10">
                                    <a href="http://localhost:8000/worker/person/approve/end-user/1" class="btn btn-success btn-md">End User</a>
                                    <a href="http://localhost:8000/worker/person/approve/hod/1" class="btn btn-success btn-md">HOD</a>
                                    <a href="http://localhost:8000/worker/person/approve/purchasing/1" class="btn btn-success btn-md">Purchasing</a>
                                    <a href="http://localhost:8000/worker/person/approve/legal/1" class="btn btn-success btn-md">Legal / Health & Safety</a>
                                    <a href="http://localhost:8000/worker/person/approve/hs/1" class="btn btn-success btn-md">End User / H&S</a>
                                    <a href="http://localhost:8000/worker/person/approve/health/1" class="btn btn-success btn-md">Health & Safety</a>
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
        ajax: "{{ route('sia-person.data', $data->id) }}",
        columns: [
            { data: 'id' },
            { data: 'fullname' },
            { data: 'id_card' },
            { data: 'position' },
            { data: 'status', render: function(data) {
                return data ? 'Uploaded' : 'Not uploaded yet';
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
                    url : '/worker/delete/' + id,
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
