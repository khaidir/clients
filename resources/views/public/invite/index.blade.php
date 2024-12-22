@include('layouts.public.header')
@include('layouts.public.sidebar-public')
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
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Visitor Access </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-6 pb-18 py-lg-13">
                        <div class="page-title d-flex align-items-center me-3">
                            <img alt="Logo" src="/assets/media/svg/misc/layer.svg" class="h-60px me-5">
                            <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0"> Visitor Access <span class="page-desc text-white opacity-50 fs-6 fw-bold pt-4"> Please Complete field at this form </span>
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
                        <form action="{{ route('visitor-public-store') }}" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" method="post">
                            @csrf
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <input type="hidden" name="token" class="form-control" id="token" value="{{ $token }}">
                                <div class="d-flex flex-column gap-4 gap-lg-6">
                                    <div class="card card-flush">
                                        <div class="row card-body">
                                            <h3 class="mb-4">Destination</h3>
                                            <div class="col-md-12 mb-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror mb-2" placeholder="Description" value="{{ old('description') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Destination</label>
                                                    <input type="text" name="destination" class="form-control @error('destination') is-invalid @enderror mb-2" placeholder="Destination" value="{{ old('destination') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Duration</label>
                                                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror mb-2" placeholder="Duration" value="{{ old('duration') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">PIC</label>
                                                    <select name="pic" class="form-control @error('pic') is-invalid @enderror mb-2">
                                                        <option value="">Choose</option>
                                                        @foreach($pic as $p)
                                                        <option value="{{ @$p->id }}">{{ @$p->fullname .' ('.@$p->name.')' }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input type="text" name="email" class="form-control @error('email') is-invalid @enderror mb-2" placeholder="Email" value="{{ old('email') }}"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-flush">
                                        <div class="row card-body">
                                            <h3 class="mb-4">Biodata</h3>
                                            <div class="col-md-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Card ID</label>
                                                    <input type="text" name="citizenship_id" class="form-control @error('citizenship_id') is-invalid @enderror mb-2" placeholder="Card ID" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Fullname</label>
                                                    <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror mb-2" placeholder="Fullname" value="{{ old('fullname') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Email</label>
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror mb-2" placeholder="Email" value="{{ old('email') }}">
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
                                            <div class="row fv-row">
                                                <div class="col-sm-4">
                                                    <div class="upload-container slim">
                                                        <label for="citizenship-input" class="upload-label">
                                                            <div class="upload-content">
                                                                <i class="ki-outline ki-file-up fs-3x upload-icon"></i>
                                                                <div class="upload-text">
                                                                    <h3 class="upload-title">Choose KTP</h3>
                                                                    <p class="upload-subtitle">Support format .jpg,.jpeg,.png,.pdf</p>
                                                                    <span id="citizenship-name" class="citizenship-filename"></span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="citizenship-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                                        <input type="hidden" id="citizenship_doc" name="citizenship_doc" value="{{ old('citizenship_doc') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="/u/contracts/workers" class="btn btn-light me-5"> Cancel </a>
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
    setupFileUpload('citizenship-input', 'citizenship-filename', 'citizenship_doc');
</script>
