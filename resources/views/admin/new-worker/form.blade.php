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
                        <div class="col-xl-8 col-sm-12">
                            <h4 class="card-title">{{ @$data->id ? 'Edit' : 'Create' }}</h4>
                            <p class="card-title-desc">Please fill out the form below completely.</p>
                            <form action="/worker/store" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->sia_id }}">

                                <div class="row mb-4">
                                    <label for="company_id" class="col-sm-3 col-form-label">Company</label>
                                    <div class="col-sm-5">
                                        <select name="company_id" id="company_id" class="form-control">
                                            <option value=""></option>
                                            @foreach ($company as $c)
                                                <option value="{{ @$c->id }}" {{ (@$data->company_id == $c->id) ? 'selected' : '' }}>{{ @$c->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company_id'))
                                            <span class="text-danger">{{ $errors->first('company_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="dete_request" class="col-sm-3 col-form-label">Contract Number</label>
                                    <div class="col-sm-4">
                                        <div class="input-group" id="no_contract">
                                            <input type="text" name="no_contract"
                                                class="form-control @error('no_contract') is-invalid @enderror"
                                                value="{{ old('no_contract', ( @$data->id ) ? @$data->no_contract : "") }}" id="no_contract"
                                                placeholder="Number Contract">
                                            @if ($errors->has('no_contract'))
                                                <span class="text-danger">{{ $errors->first('no_contract') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="dete_request" class="col-sm-3 col-form-label">Type Contract</label>
                                    <div class="col-sm-3">
                                        <div id="type_contract">
                                            <select name="type_contract" class="form-control @error('type_contract') is-invalid @enderror">
                                                <option value="">Choose</option>
                                                <option value="1"{{ (@$data->type_contract == '1') ? ' selected':'' }}>Contract</option>
                                                <option value="2"{{ (@$data->type_contract == '2') ? ' selected':'' }}>Purchase Request</option>
                                                <option value="3"{{ (@$data->type_contract == '3') ? ' selected':'' }}>Purchase Order</option>
                                            </select>
                                            @if ($errors->has('type_contract'))
                                                <span class="text-danger">{{ $errors->first('type_contract') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="badge" class="col-sm-3 col-form-label">Description of Task</label>
                                    <div class="col-sm-8">
                                        <textarea name="description_of_task" class="form-control @error('description_of_task') is-invalid @enderror" placeholder="Description of Task">{{ old('description_of_task', @$data->description_of_task) }}</textarea>
                                        @if ($errors->has('description_of_task'))
                                            <span class="text-danger">{{ $errors->first('description_of_task') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="dete_request" class="col-sm-3 col-form-label">Periode Start</label>
                                    <div class="col-sm-2">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" name="periode_start"
                                                data-date-format="dd M, yyyy"
                                                data-date-container='#datepicker1'
                                                data-provide="datepicker"
                                                data-date-autoclose="true"
                                                class="form-control @error('periode_start') is-invalid @enderror"
                                                value="{{ old('periode_start', ( @$data->id ) ? date('d M, Y', strtotime(@$data->periode_start)) : date('d M, Y')) }}"
                                                id="dete_request"
                                                placeholder="Periode Start">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            @if ($errors->has('periode_start'))
                                                <span class="text-danger">{{ $errors->first('periode_start') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <label for="dete_request" class="col-sm-3 col-form-label">Periode End</label>
                                    <div class="col-sm-2">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" name="periode_end"
                                                data-date-format="dd M, yyyy"
                                                data-date-container='#datepicker1'
                                                data-provide="datepicker"
                                                data-date-autoclose="true"
                                                class="form-control @error('periode_end') is-invalid @enderror"
                                                value="{{ old('periode_end', ( @$data->id ) ? date('d M, Y', strtotime(@$data->periode_end)) : date('d M, Y')) }}"
                                                id="periode_end"
                                                placeholder="Periode End">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            @if ($errors->has('dete_request'))
                                                <span class="text-danger">{{ $errors->first('periode_end') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if(@$data->id == null)
                                <h4 class="card-title">Personal Data</h4>
                                <div class="row mb-4">
                                    <label for="id_card" class="col-sm-3 col-form-label">Card ID</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="id_card" class="form-control @error('id_card') is-invalid @enderror" value="{{ old('id_card', @$data->id_card) }}" placeholder="Card ID">
                                        @if ($errors->has('id_card'))
                                            <span class="text-danger">{{ $errors->first('id_card') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="fullname" class="col-sm-3 col-form-label">Fullname</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname', @$data->fullname) }}" placeholder="Fullname">
                                        @if ($errors->has('fullname'))
                                            <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', @$data->email) }}" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="position" class="col-sm-3 col-form-label">Position</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', @$data->position) }}" placeholder="Position">
                                        @if ($errors->has('position'))
                                            <span class="text-danger">{{ $errors->first('position') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="ktp" class="col-sm-3 col-form-label">Upload</label>
                                    <div class="col-sm-9">
                                        <div class="row col-6">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2" checked="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="ktp-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="ktp-input" id="label" style="cursor: pointer;">
                                                    <span id="ktp-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose KTP</span>
                                                </label>
                                                <input type="hidden" id="ktp-filename" name="ktp" value="{{ old('ktp', @$data->ktp) }}">
                                            </div>
                                            <code class="mb-lg-0" id="ktp-name"></code>
                                        </div>
                                        <div class="row col-6 mt-3">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2" checked="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="passport-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="passport-input" id="label" style="cursor: pointer;">
                                                    <span id="passport-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Passport</span>
                                                </label>
                                                <input type="hidden" id="passport-filename" name="passport" value="{{ old('passport', @$data->passport) }}">
                                            </div>
                                            <code class="mb-lg-0" id="passport-name"></code>
                                        </div>
                                        <div class="row col-6 mt-3">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2" checked="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="card-input" name="card" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="card-input" id="label" style="cursor: pointer;">
                                                    <span id="card-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Card ID</span>
                                                </label>
                                                <input type="hidden" id="card-filename" name="card_id" value="{{ old('card_id', @$data->card_id) }}">
                                            </div>
                                            <code class="mb-lg-0" id="card-name"></code>
                                        </div>
                                        <div class="row col-6 mt-3">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2" checked="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="bpjs-input" name="bpjs" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="bpjs-input" id="label" style="cursor: pointer;">
                                                    <span id="bpjs-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose BPJS</span>
                                                </label>
                                                <input type="hidden" id="bpjs-filename" name="bpjs" value="{{ old('bpjs', @$data->bpjs) }}">
                                            </div>
                                            <code class="mb-lg-0" id="bpjs-name"></code>
                                        </div>
                                        <div class="row col-6 mt-3">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2" checked="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="contract-input" name="contract" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="contract-input" id="label" style="cursor: pointer;">
                                                    <span id="contract-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Contract</span>
                                                </label>
                                                <input type="hidden" id="contract-filename" name="contract" value="{{ old('contract', @$data->contract) }}">
                                            </div>
                                            <code class="mb-lg-0" id="contract-name"></code>
                                        </div>

                                        <div class="row col-6 mt-3">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2" checked="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="cert-competence-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="cert-competence-input" id="label" style="cursor: pointer;">
                                                    <span id="cert-competence-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Certificate Competence</span>
                                                </label>
                                                <input type="hidden" id="cert-competence-filename" name="cert_competence" value="{{ old('cert_competence', @$data->cert_competence) }}">
                                            </div>
                                            <code class="mb-lg-0" id="cert-competence-name"></code>
                                        </div>

                                        <div class="row col-6 mt-3">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2" checked="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="medical-checkup-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="medical-checkup-input" id="label" style="cursor: pointer;">
                                                    <span id="medical-checkup-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Medical Checkup</span>
                                                </label>
                                                <input type="hidden" id="medical-checkup-filename" name="medical_checkup" value="{{ old('medical_checkup', @$data->medical_checkup) }}">
                                            </div>
                                            <code class="mb-lg-0" id="medical-checkup-name"></code>
                                        </div>

                                        <div class="row col-6 mt-3">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2" checked="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="license-driver-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="license-driver-input" id="label" style="cursor: pointer;">
                                                    <span id="license-driver-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose License Driver</span>
                                                </label>
                                                <input type="hidden" id="license-driver-filename" name="license_driver" value="{{ old('license_driver', @$data->license_driver) }}">
                                            </div>
                                            <code class="mb-lg-0" id="license-driver-name"></code>
                                        </div>

                                        <div class="row col-6 mt-3">
                                            <div class="col-1 mt-2">
                                                <div class="form-check form-checkbox-outline form-check-success">
                                                    <input class="form-check-input" type="checkbox" id="customCheckcolor2">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="license-vaccinated-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="license-vaccinated-input" id="label" style="cursor: pointer;">
                                                    <span id="license-vaccinated-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose License Vaccinated</span>
                                                </label>
                                                <input type="hidden" id="license-vaccinated-filename" name="license_vaccinated" value="{{ old('license_vaccinated', @$data->license_vaccinated) }}">
                                            </div>
                                            <code class="mb-lg-0" id="license-vaccinated-name"><a href="">filename-image-license-vaccinated.png</a></code>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row mb-4">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <div class="form-check form-switch form-switch-md mb-2" dir="ltr">
                                            <input name="status" class="form-check-input" type="checkbox" value="1" id="SwitchCheckSizemd" {{ (@$data->status === true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="SwitchCheckSizemd"></label>
                                        </div>
                                        <p class="text-muted mb-2">Switch Knots to Approve or Unapprove</p>
                                        @if ($errors->has('status'))
                                            <span class="text-danger">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary w-md">Save</button>
                                        <a href="/worker" class="btn btn-light w-md">Back</a>
                                    </div>
                                </div>
                            </form>
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


function setupFileUpload(inputId, hiddenInputId, filenameDisplayId) {
    document.getElementById(inputId).addEventListener('change', function() {
        let fileInput = this;
        let formData = new FormData();
        formData.append('file', fileInput.files[0]);
        document.getElementById(filenameDisplayId).textContent = fileInput.files[0].name;

        fetch('{{ route("sia-person.upload") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("HTTP error, status = " + response.status);
            return response.json();
        })
        .then(data => {
            if (data.filename) {
                document.getElementById(hiddenInputId).value = data.filename;
            } else {
                console.log('File upload failed.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
}

$(document).ready(function() {
    $('select').select2({
        placeholder: 'Choose'
    });

    setupFileUpload('ktp-input', 'ktp-filename', 'ktp-name');
    setupFileUpload('card-input', 'card-filename', 'card-name');
    setupFileUpload('passport-input', 'passport-filename', 'passport-name');

    setupFileUpload('bpjs-input', 'bpjs-filename', 'bpjs-name');
    setupFileUpload('contract-input', 'contract-filename', 'contract-name');
    setupFileUpload('cert-competence-input', 'cert-competence-filename', 'cert-competence-name');

    setupFileUpload('medical-checkup-input', 'medical-checkup-filename', 'medical-checkup-name');
    setupFileUpload('license-driver-input', 'license-driver-filename', 'license-driver-name');
    setupFileUpload('license-vaccinated-input', 'license-vaccinated-filename', 'license-vaccinated-name');


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
            confirmButtonClass: 'btn btn-success',
            confirmButtonText: "Yes, delete!",
            confirmButtonAriaLabel: 'Yes delete',
            cancelButtonClass: 'btn btn-danger',
            cancelButtonText:'Cancel!',
            cancelButtonAriaLabel: 'Cancel'
        }).then(function(result) {
            if (result?.value && (result?.value[0] != "")) {
                $.ajax({
                    url : '/access/delete/' + id,
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
