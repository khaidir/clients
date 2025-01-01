@include('layouts.public.header')
@include('layouts.public.sidebar-public')
<div class="app-page flex-column flex-column-fluid " id="kt_app_page" style="margin-top:200px;">
    <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
        <div class="app-container  container-xxl ">
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content">
                        <form action="/rejected" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" method="post">
                            @csrf
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ $id }}">
                                <div class="d-flex flex-column gap-4 gap-lg-6">
                                    <div class="card card-flush">
                                        <div class="row card-body">
                                            <h3 class="">Reject</h3>
                                            <span class="text-dark mb-10">Reason reject visitor to visit.</span>
                                            <div class="col-md-12 mb-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Reason</label>
                                                    <input type="text" name="reason" class="form-control @error('reason') is-invalid @enderror mb-2" placeholder="Reason" value="{{ old('reason', @$data->description) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label"> Reject </span>
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

            fetch('{{ route("visitor-public-upload") }}', {
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
</script>
