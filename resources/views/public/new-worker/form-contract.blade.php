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
                                            <div class="col-md-12 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">General Description of Task</label>
                                                    <input type="text" name="description_of_task" class="form-control @error('description_of_task') is-invalid @enderror mb-2" placeholder="Description of Task" value="{{ old('description_of_task', @$data->description_of_task) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Contract Number</label>
                                                    <input type="text" name="no_contract" class="form-control @error('no_contract') is-invalid @enderror mb-2" placeholder="No Contract" value="{{ old('no_contract', @$data->no_contract) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Periode Statrt</label>
                                                    <input type="text" name="periode_start" class="form-control @error('periode_start') is-invalid @enderror mb-2" placeholder="Periode Start" value="{{ old('periode_start', @$data->periode_start) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Periode End</label>
                                                    <input type="text" name="periode_end" class="form-control @error('periode_end') is-invalid @enderror mb-2" placeholder="Periode End" value="{{ old('periode_end', @$data->periode_end) }}">
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
