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
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Contract Worker </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-6 pb-18 py-lg-13">
                        <div class="page-title d-flex align-items-center me-3">
                            <img alt="Logo" src="/assets/media/svg/misc/layer.svg" class="h-60px me-5">
                            <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0"> Contract Worker <span class="page-desc text-white opacity-50 fs-6 fw-bold pt-4"> Please field Company Complete </span>
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
                                <input type="hidden" name="sia_id" class="form-control" id="sia_id" value="{{ @$data->id ? @$data->sia_id : @$id }}">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>Personel Data</h3>
                                            </div>
                                        </div>
                                        <div class="row card-body pt-0">
                                            <div class="col-md-6 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Card ID</label>
                                                    <input type="text" name="id_card" class="form-control @error('id_card') is-invalid @enderror mb-2" placeholder="Card ID" value="{{ old('id_card', @$data->id_card) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Fullname</label>
                                                    <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror mb-2" placeholder="Fullname" value="{{ old('fullname', @$data->fullname) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Email</label>
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror mb-2" placeholder="Email" value="{{ old('email', @$data->email) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Position</label>
                                                    <input type="text" name="position" class="form-control @error('position') is-invalid @enderror mb-2" placeholder="Position" value="{{ old('position', @$data->position) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>Attachments</h3>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row fv-row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="ktp-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->ktp_checked)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose KTP</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="ktp-name" class="upload-filename">{{ @$data->ktp }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="ktp-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="ktp-filename" name="ktp" value="{{ old('ktp', @$data->ktp) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="passport-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->pp_checked)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose Passport</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="passport-name" class="upload-filename">{{ @$data->passport }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="passport-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="passport-filename" name="passport" value="{{ old('passport', @$data->passport) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="card-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->card_checked)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose Card ID</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="card-name" class="upload-filename">{{ @$data->card_id }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="card-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="card-filename" name="card_id" value="{{ old('card_id', @$data->card_id) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="bpjs-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->bpjs_checked)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose BPJS</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="bpjs-name" class="upload-filename">{{ @$data->bpjs }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="bpjs-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="bpjs-filename" name="bpjs" value="{{ old('bpjs', @$data->bpjs) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="contract-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->ct_check)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose Contract</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="contract-name" class="upload-filename">{{ @$data->contract }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="contract-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="contract-filename" name="contract" value="{{ old('contract', @$data->contract) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="cert_competence-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->cc_checked)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose Certificate Competence</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="cert_competence-name" class="upload-filename">{{ @$data->cert_competence }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="cert_competence-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="cert_competence-filename" name="cert_competence" value="{{ old('cert_competence', @$data->cert_competence) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-4">
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="medical_checkup-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->mc_checked)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose Medical Checkup</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="medical_checkup-name" class="upload-filename">{{ @$data->medical_checkup }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="medical_checkup-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="medical_checkup-filename" name="medical_checkup" value="{{ old('medical_checkup', @$data->medical_checkup) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="license_driver-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->ld_checked)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose License Driver</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="license_driver-name" class="upload-filename">{{ @$data->license_driver }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="license_driver-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="license_driver-filename" name="license_driver" value="{{ old('license_driver', @$data->license_driver) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="license_vaccinated-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up {{ (@$data->lv_checked)?'text-primary':'text-dark' }} fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose License Vaccinated</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="license_vaccinated-name" class="upload-filename">{{ @$data->license_vaccinated }}</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="license_vaccinated-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="license_vaccinated-filename" name="license_vaccinated" value="{{ old('license_vaccinated', @$data->license_vaccinated) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="/u/contracts/workers/{{ @$data->sia_id }}" class="btn btn-light me-5"> Cancel </a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label"> Save Changes </span>
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
