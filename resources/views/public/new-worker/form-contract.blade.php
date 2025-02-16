@include('layouts.public.header')
@include('layouts.public.sidebar')
<div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
    <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
        <div id="kt_app_toolbar" class="app-toolbar  py-6 ">
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex align-items-start ">
                <div class="d-flex flex-column flex-row-fluid">
                    <div class="d-flex align-items-center pt-1">
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                            <li class="breadcrumb-item text-white fw-bold lh-1">
                                <a href="/metronic8/demo30/index.html" class="text-white text-hover-primary">
                                    <i class="ki-outline ki-home text-white fs-3"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="ki-outline ki-right fs-4 text-white mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Dashboard </li>
                            <li class="breadcrumb-item">
                                <i class="ki-outline ki-right fs-4 text-white mx-n1"></i>
                            </li>
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Contract </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-6 pb-18 py-lg-13">
                        <div class="page-title d-flex align-items-center me-3">
                            <img alt="Logo" src="/assets/media/svg/misc/layer.svg" class="h-60px me-5">
                            <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0"> Contract <span class="page-desc text-white opacity-50 fs-6 fw-bold pt-4"> Please field Contract Complete </span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-container  container-xxl ">
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content ">
                        <form action="{{ route('public.new-worker-store') }}" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" method="post">
                            @csrf
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="row card-body pt-0">
                                            <h4 class="text-primary mb-3 mt-2">Contract</h4>
                                            <div class="form-group row mb-3">
                                                <label class="col-form-label text-right col-lg-3 col-sm-12">General Description of Task</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" name="description_of_task" class="form-control @error('description_of_task') is-invalid @enderror mb-2" placeholder="Description of Task" value="{{ old('description_of_task', @$data->description_of_task) }}">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-form-label text-right col-lg-3 col-sm-12">Contract Number</label>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <input type="text" name="no_contract" class="form-control @error('no_contract') is-invalid @enderror mb-2" placeholder="No Contract" value="{{ old('no_contract', @$data->no_contract) }}">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-form-label text-right col-lg-3 col-sm-12">Periode Start</label>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <input type="text" name="periode_start" class="form-control @error('periode_start') is-invalid @enderror mb-2" placeholder="Periode Start" value="{{ old('periode_start', @$data->periode_start) }}">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-form-label text-right col-lg-3 col-sm-12">Periode End</label>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <input type="text" name="periode_end" class="form-control @error('periode_end') is-invalid @enderror mb-2" placeholder="Periode End" value="{{ old('periode_end', @$data->periode_end) }}">
                                                </div>
                                            </div>

                                            <h4 class="text-primary mb-3 mt-3">Personal Data</h4>

                                            <div class="form-group row mb-4">
                                                <label for="id_card" class="col-form-label text-right col-lg-3 col-sm-12">Card ID</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="id_card" class="form-control @error('id_card') is-invalid @enderror" value="{{ old('id_card', @$data->id_card) }}" placeholder="Card ID">
                                                    @if ($errors->has('id_card'))
                                                        <span class="text-danger">{{ $errors->first('id_card') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="fullname" class="col-form-label text-right col-lg-3 col-sm-12">Fullname</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname', @$data->fullname) }}" placeholder="Fullname">
                                                    @if ($errors->has('fullname'))
                                                        <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="email" class="col-form-label text-right col-lg-3 col-sm-12">Email</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', @$data->email) }}" placeholder="Email">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="position" class="col-form-label text-right col-lg-3 col-sm-12">Position</label>
                                                <div class="col-sm-5">
                                                    <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', @$data->position) }}" placeholder="Position">
                                                    @if ($errors->has('position'))
                                                        <span class="text-danger">{{ $errors->first('position') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4 mb-4">
                                                <label for="ktp" class="col-form-label text-right col-lg-3 col-sm-12">Upload</label>
                                                <div class="col-sm-9">
                                                    <div class="row col-6 mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="ktp-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="ktp-input" id="label" style="cursor: pointer;">
                                                                <span id="ktp-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose KTP</span>
                                                            </label>
                                                            <input type="hidden" id="ktp-filename" name="ktp" value="{{ old('ktp', @$data->ktp) }}">
                                                        </div>
                                                        @if (@$data->ktp)
                                                        <code class="mb-lg-0" id="ktp-name"></code>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="passport-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="passport-input" id="label" style="cursor: pointer;">
                                                                <span id="passport-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Passport</span>
                                                            </label>
                                                            <input type="hidden" id="passport-filename" name="passport" value="{{ old('passport', @$data->passport) }}">
                                                        </div>
                                                        @if (@$data->passport)
                                                        <code class="mb-lg-0" id="passport-name"></code>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="card-input" name="card" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="card-input" id="label" style="cursor: pointer;">
                                                                <span id="card-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Card ID</span>
                                                            </label>
                                                            <input type="hidden" id="card-filename" name="card_id" value="{{ old('card_id', @$data->card_id) }}">
                                                        </div>
                                                        @if (@$data->card_id)
                                                        <code class="mb-lg-0" id="card-name"></code>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="bpjs-input" name="bpjs" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="bpjs-input" id="label" style="cursor: pointer;">
                                                                <span id="bpjs-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose BPJS</span>
                                                            </label>
                                                            <input type="hidden" id="bpjs-filename" name="bpjs" value="{{ old('bpjs', @$data->bpjs) }}">
                                                        </div>
                                                        @if (@$data->bpjs)
                                                        <code class="mb-lg-0" id="bpjs-name"></code>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="contract-input" name="contract" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="contract-input" id="label" style="cursor: pointer;">
                                                                <span id="contract-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Contract</span>
                                                            </label>
                                                            <input type="hidden" id="contract-filename" name="contract" value="{{ old('contract', @$data->contract) }}">
                                                        </div>
                                                        @if (@$data->contract)
                                                        <code class="mb-lg-0" id="contract-name"></code>
                                                        @endif
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="cert-competence-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="cert-competence-input" id="label" style="cursor: pointer;">
                                                                <span id="cert-competence-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Certificate Competence</span>
                                                            </label>
                                                            <input type="hidden" id="cert-competence-filename" name="cert_competence" value="{{ old('cert_competence', @$data->cert_competence) }}">
                                                        </div>
                                                        @if (@$data->cert_competence)
                                                        <code class="mb-lg-0" id="cert-competence-name"></code>
                                                        @endif
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="medical-checkup-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="medical-checkup-input" id="label" style="cursor: pointer;">
                                                                <span id="medical-checkup-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Medical Checkup</span>
                                                            </label>
                                                            <input type="hidden" id="medical-checkup-filename" name="medical_checkup" value="{{ old('medical_checkup', @$data->medical_checkup) }}">
                                                        </div>
                                                        @if (@$data->medical_checkup)
                                                        <code class="mb-lg-0" id="medical-checkup-name"></code>
                                                        @endif
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="license-driver-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="license-driver-input" id="label" style="cursor: pointer;">
                                                                <span id="license-driver-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose License Driver</span>
                                                            </label>
                                                            <input type="hidden" id="license-driver-filename" name="license_driver" value="{{ old('license_driver', @$data->license_driver) }}">
                                                        </div>
                                                        @if (@$data->license_driver)
                                                        <code class="mb-lg-0" id="license-driver-name"></code>
                                                        @endif
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <div class="col-9">
                                                            <input type="file" id="license-vaccinated-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                            <label for="license-vaccinated-input" id="label" style="cursor: pointer;">
                                                                <span id="license-vaccinated-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose License Vaccinated</span>
                                                            </label>
                                                            <input type="hidden" id="license-vaccinated-filename" name="license_vaccinated" value="{{ old('license_vaccinated', @$data->license_vaccinated) }}">
                                                        </div>
                                                        @if (@$data->license_vaccinated)
                                                        <code class="mb-lg-0" id="license-vaccinated-name"></code>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="/u/contract" class="btn btn-light me-5"> Cancel </a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label"> Save </span>
                                        <span class="indicator-progress"> Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @include('layouts.public.footerlint')
            </div>
        </div>
    </div>
</div>
@include('layouts.public.footer')
<script>
    $(document).ready(function() {
        $('select').select2({
            placeholder: 'Choose'
        });
    });

    function setupFileUpload(inputId, hiddenInputId, filenameDisplayId) {
        const fileInput = document.getElementById(inputId);
        if (!fileInput) return;

        fileInput.addEventListener('change', function() {
            const formData = new FormData();
            const file = fileInput.files[0];
            if (!file) return;

            formData.append('file', file);
            document.getElementById(filenameDisplayId).textContent = file.name;

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
                    console.error('File upload failed.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Panggil fungsi untuk setiap elemen file input
    setupFileUpload('ktp-input', 'ktp-filename', 'ktp-name');
    setupFileUpload('passport-input', 'passport-filename', 'passport-name');
    setupFileUpload('card-input', 'card-filename', 'card-name');
    setupFileUpload('bpjs-input', 'bpjs-filename', 'bpjs-name');
    setupFileUpload('contract-input', 'contract-filename', 'contract-name');
    setupFileUpload('cert_competence-input', 'cert_competence-filename', 'cert_competence-name');
    setupFileUpload('medical_checkup-input', 'medical_checkup-filename', 'medical_checkup-name');
    setupFileUpload('license_driver-input', 'license_driver-filename', 'license_driver-name');
    setupFileUpload('license_vaccinated-input', 'license_vaccinated-filename', 'license_vaccinated-name');
</script>
