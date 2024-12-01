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
                        <form action="{{ route('public.extended.store') }}" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" method="post">
                            @csrf
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>Extended Periode Contract</h3>
                                            </div>
                                        </div>
                                        <div class="row card-body pt-0">
                                            <div class="col-md-12 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Work Contract</label>
                                                    <select name="sia_id" class="form-control @error('sia_id') is-invalid @enderror mb-2" id="">
                                                        <option value="">Choose</option>
                                                        @foreach ($contract as $c)
                                                        <option value="{{ @$c->id }}">{{ @$c->description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="/u/extended" class="btn btn-light me-5"> Cancel </a>
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
