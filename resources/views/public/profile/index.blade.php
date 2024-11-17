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
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Profile </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-6 pb-18 py-lg-13">
                        <div class="page-title d-flex align-items-center me-3">
                            <img alt="Logo" src="/assets/media/svg/misc/layer.svg" class="h-60px me-5">
                            <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0"> Profile <span class="page-desc text-white opacity-50 fs-6 fw-bold pt-4">Please fill in the Account Profile completely</span>
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
                        <form action="{{ route('public.profile-store') }}" method="post" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
                            @csrf
                            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                                @include('layouts.public.sidebar-profile')
                            </div>
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card-flush py-4">
                                        <h3 class="mb-8">Profile</h3>
                                        <div class="row card-bodys pt-0">
                                            <div class="col-md-6 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Fullname</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror mb-2" placeholder="Fullname" value="{{ old('fullname', @$data->name) }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Email</label>
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror mb-2" placeholder="Email" value="{{ old('email', @$data->email) }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Password</label>
                                                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror mb-2" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Password Confirmation</label>
                                                    <input type="text" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror mb-2" placeholder="Password Confirmation">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Position</label>
                                                    <input type="text" name="position" class="form-control @error('position') is-invalid @enderror mb-2" placeholder="Position" value="{{ old('position', @$data->position) }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Address</label>
                                                    <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror mb-2" placeholder="Address" cols="30" rows="3">{{ old('address', @$data->address) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Attachment</label>
                                                    <div class="upload-container slim" onclick="document.getElementById('ktp-input').click();">
                                                        <label for="ktp-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up text-primary fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose KTP</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="ktp-name" class="upload-filename"></span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="ktp-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="ktp-filename" name="ktp" value="{{ old('ktp', @$data->ktp) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
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

</script>
