@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">New Worker Person</h2>
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
                        <div class="col-xl-8 col-sm-12">
                            <h4 class="card-title">{{ @$data->id ? 'Edit' : 'Create' }}</h4>
                            <p class="card-title-desc">Please fill out the form below completely.</p>
                            <form action="/worker/person/store" method="post" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">
                                <input type="hidden" name="sia_id" class="form-control" value="{{ (@$data->id) ? @$data->sia_id : @$id }}">

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
                                                    <input name="ktp_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"  class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="ktp_checked" data-id="{{ @$data->id }}" {{ (@$data->ktp_checked == true)?'checked':'' }}>
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
                                                    <input name="passport_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"   class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="pp_checked" data-id="{{ @$data->id }}" {{ (@$data->pp_checked == true)?'checked':'' }}>
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
                                                    <input name="card_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"  class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="card_checked" data-id="{{ @$data->id }}" {{ (@$data->card_checked == true)?'checked':'' }}>
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
                                                    <input name="bpjs_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"  class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="bpjs_checked" data-id="{{ @$data->id }}" {{ (@$data->bpjs_checked == true)?'checked':'' }}>
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
                                                    <input name="ct_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"  class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="ct_checked" data-id="{{ @$data->id }}" {{ (@$data->ct_checked == true)?'checked':'' }}>
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
                                                    <input name="cc_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"  class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="cc_checked" data-id="{{ @$data->id }}" {{ (@$data->cc_checked == true)?'checked':'' }}>
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
                                                    <input name="mc_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"  class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="mc_checked" data-id="{{ @$data->id }}" {{ (@$data->mc_checked == true)?'checked':'' }}>
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
                                                    <input name="ld_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"  class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="ld_checked" data-id="{{ @$data->id }}" {{ (@$data->ld_checked == true)?'checked':'' }}>
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
                                                    <input name="lv_checked" name="ktp_checked" class="form-check-input {{ (@$data->id)? 'update-checkbox':'' }}"  class="form-check-input" type="checkbox" id="customCheckcolor2" data-field="lv_checked" data-id="{{ @$data->id }}" {{ (@$data->ld_checked == true)?'checked':'' }}>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input type="file" id="license-vaccinated-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                <label for="license-vaccinated-input" id="label" style="cursor: pointer;">
                                                    <span id="license-vaccinated-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose License Vaccinated</span>
                                                </label>
                                                <input type="hidden" id="license-vaccinated-filename" name="license_vaccinated" value="{{ old('license_vaccinated', @$data->license_vaccinated) }}">
                                            </div>
                                            <code class="mb-lg-0" id="license-vaccinated-name"></code>
                                        </div>
                                    </div>
                                </div>

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
                                        <a href="/worker/detail/{{ (@$data->id) ? @$data->sia_id : @$id }}" class="btn btn-light w-md">Back</a>
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
$(document).ready(function() {
    $('select').select2({
        placeholder: 'Choose'
    });

    $('.update-checkbox').change(function() {
        var isChecked = $(this).is(':checked') ? 1 : 0;
        var fieldName = $(this).data('field');
        var id = $(this).data('id');

        $.ajax({
            url: '/worker/person/checked/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                field: fieldName,
                value: isChecked
            },
            success: function(response) {
                // toastr.success('Document Approved');
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });
});

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

setupFileUpload('ktp-input', 'ktp-filename', 'ktp-name');
setupFileUpload('card-input', 'card-filename', 'card-name');
setupFileUpload('passport-input', 'passport-filename', 'passport-name');

setupFileUpload('bpjs-input', 'bpjs-filename', 'bpjs-name');
setupFileUpload('contract-input', 'contract-filename', 'contract-name');
setupFileUpload('cert-competence-input', 'cert-competence-filename', 'cert-competence-name');

setupFileUpload('medical-checkup-input', 'medical-checkup-filename', 'medical-checkup-name');
setupFileUpload('license-driver-input', 'license-driver-filename', 'license-driver-name');
setupFileUpload('license-vaccinated-input', 'license-vaccinated-filename', 'license-vaccinated-name');

</script>
@endsection
