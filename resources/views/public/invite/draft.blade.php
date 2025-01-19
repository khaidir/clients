@include('layouts.public.header')
@include('layouts.public.sidebar-public')
<div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
    <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
        <div id="kt_app_toolbar" class="app-toolbar py-6 ">
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
        <div class="app-container container-xxl">
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content ">
                        <form action="{{ route('visitor-public-store') }}" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <input type="hidden" name="token" class="form-control" id="token" value="{{ $token->token }}">
                                <div class="d-flex flex-column gap-4 gap-lg-6">
                                    <div class="card card-flush">
                                        <div class="row card-body">
                                            <h3 class="">Request Form</h3>
                                            <span class="text-dark mb-10">This form should be field out 1 or 3 days before this valid.</span>

                                            {{-- <div class="col-md-12 mb-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror mb-2" placeholder="Description" value="{{ old('description', @$data->description) }}">
                                                </div>
                                            </div> --}}
                                            <div class="col-md-5">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Purpose</label>
                                                    <input type="text" name="destination" class="form-control @error('destination') is-invalid @enderror mb-2" placeholder="Purpose" value="{{ old('destination', @$data->destination) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Duration</label>
                                                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror mb-2" placeholder="Duration" value="{{ old('duration', @$data->duration) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">PIC</label>
                                                    <select name="pic" class="form-control @error('pic') is-invalid @enderror mb-2">
                                                        <option value="">Choose</option>
                                                        @foreach($pic as $p)
                                                        <option value="{{ @$p->id }}" {{ ($p->id == $data->pic_id) ? 'selected':'' }}>{{ @$p->fullname .' ('.@$p->name.')' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-flush">
                                        <div class="row card-body">
                                            <div class="col-md-3 mb-4">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Card ID</label>
                                                    <input type="text" name="citizenship_number" class="form-control @error('citizenship_number') is-invalid @enderror mb-2" placeholder="Card ID" value="{{ old('citizenship_number', @$data->citizenship_number) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="required form-label">Foreign</label>
                                                <select name="citizenship" class="form-control">
                                                    <option value="">Choose</option>
                                                    <option value="1" {{ (old('citizenship') == 1 or @$data->foreign == 1) ? 'selected':'' }}>KTP</option>
                                                    <option value="2" {{ (old('citizenship') == 2 or @$data->foreign == 2) ? 'selected':'' }}>Passport/Kitas</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7">
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
                                                    <label class="required form-label">Ocuppational</label>
                                                    <input type="text" name="ocuppational" class="form-control @error('ocuppational') is-invalid @enderror mb-2" placeholder="Ocuppational" value="{{ old('ocuppational', @$data->ocuppational) }}">
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
                                                @if($data->citizenship_doc)
                                                <img class="img-modal" src="/storage/uploads/{{ @$data->citizenship_doc }}" class="img-fluid img-thumbnail rounded mx-auto" width="180px" alt="KTP {{ @$data->name }}">
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-flush">
                                        <div class="row card-body">
                                            <h3 class="mb-4">Personil</h3>
                                            <div class="mb-6" id="personilContainer">
                                                @foreach($personils as $personil)
                                                    <div class="row mb-6 personil-row">
                                                        <div class="col-md-2">
                                                            <div class="fv-row fv-plugins-icon-container">
                                                                <label class="form-label">Card ID</label>
                                                                <input type="hidden" name="vid[]" class="form-control" value="{{ $personil->id }}">
                                                                <input type="text" name="citi_id[]" class="form-control" placeholder="Card ID" value="{{ $personil->citizenship }}">
                                                                <a href="/invite/delete/{{ $personil->id }}" class="text-danger delete-personil" data-id="{{ $personil->id }}">X</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="fv-row fv-plugins-icon-container">
                                                                <label class="form-label">Foreign</label>
                                                                <select name="foreign[]" class="form-control">
                                                                    <option value="">Choose</option>
                                                                    <option value="1" {{ ($personil->foreign == 1) ? 'selected':'' }}>KTP</option>
                                                                    <option value="2"  {{ ($personil->foreign == 2) ? 'selected':'' }}>Passport/Kitas</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="fv-row fv-plugins-icon-container">
                                                                <label class="required form-label">Fullname</label>
                                                                <input type="text" name="name[]" class="form-control" placeholder="Fullname" value="{{ $personil->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="fv-row fv-plugins-icon-container">
                                                                <label class="required form-label">Ocuppational</label>
                                                                <input type="text" name="work[]" class="form-control" placeholder="Ocuppational" value="{{ $personil->ocuppational }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="fv-row fv-plugins-icon-container">
                                                                <label class="required form-label">Attachment</label>
                                                                <input type="file" name="attachment[]" class="form-control">
                                                                @if($personil->citizenship_docs)
                                                                    {{-- <a href="{{ asset('storage/' . $personil->citizenship_docs) }}" target="_blank">View Attachment</a> --}}
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="fv-row fv-plugins-icon-container">
                                                                <label class="required form-label">*</label>
                                                                @if($personil->citizenship_docs)
                                                                <img class="img-modal" src="/storage/{{ @$personil->citizenship_docs }}" class="img-fluid img-thumbnail rounded mx-auto" width="70px" height="30px" alt="KTP {{ @$personil->name }}">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="row mb-6 personil-row personil-template">
                                                    <div class="col-md-2">
                                                        <div class="fv-row fv-plugins-icon-container">
                                                            <label class="form-label">Card ID</label>
                                                            <input type="text" name="citi_id[]" class="form-control" placeholder="Card ID">
                                                        </div>
                                                    </div>
                                                     <div class="col-md-2">
                                                        <div class="fv-row fv-plugins-icon-container">
                                                            <label class="form-label">Foreign</label>
                                                            <select name="foreign[]" class="form-control">
                                                                <option value="">Choose</option>
                                                                <option value="1">KTP</option>
                                                                <option value="2">Passport/Kitas</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="fv-row fv-plugins-icon-container">
                                                            <label class="required form-label">Fullname</label>
                                                            <input type="text" name="name[]" class="form-control" placeholder="Fullname">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="fv-row fv-plugins-icon-container">
                                                            <label class="required form-label">Ocuppational</label>
                                                            <input type="text" name="work[]" class="form-control" placeholder="Ocuppational">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="fv-row fv-plugins-icon-container">
                                                            <label class="required form-label">Attachment</label>
                                                            <input type="file" name="attachment[]" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-primary btn-md" id="addPersonil">Add Personil</button>
                                        </div>
                                    </div>

                                    <div class="card card-flush">
                                        <div class="row card-body">
                                            <h3 class="mb-4">Personal Protection Equipment</h3>
                                            <div class="mb-6" id="">
                                                <div class="row mb-6">
                                                    <div class="col-md-12 mb-5 mt-3">
                                                        <div class="fv-row fv-plugins-icon-container">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" name="ppe" class="form-check-input" id="ppes" value="1" {{ (@$data->ppe == 1) ? 'checked':'' }}>
                                                                <label class="form-check-label text-dark" for="ppes">PPE</label>
                                                              </div>
                                                        </div>
                                                    </div>
                                                    <div class="ppe-field">
                                                        <div class="row mb-5">
                                                            <div class="col-md-3 mb-5">
                                                                <div class="fv-row fv-plugins-icon-container">
                                                                    <label class="form-label">Helmet</label>
                                                                    <input type="number" name="ppe_helmet" class="form-control" placeholder="Helmet" value="{{ @$data->ppe_helmet }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-3 mb-5">
                                                                <div class="fv-row fv-plugins-icon-container">
                                                                    <label class="form-label">Glasses</label>
                                                                    <input type="number" name="ppe_glasses" class="form-control" placeholder="Glasses" value="{{ @$data->ppe_glasses }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-12 mb-3">
                                                                <div class="row fv-row fv-plugins-icon-container">
                                                                    <label class="form-label">Shoeses</label>
                                                                    <div class="row mb-5">
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 36-37</label>
                                                                                <input type="number" name="ppe_shoes_size_1" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[0] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 38-39</label>
                                                                                <input type="number" name="ppe_shoes_size_2" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[1] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 40</label>
                                                                                <input type="number" name="ppe_shoes_size_3" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[2] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 41</label>
                                                                                <input type="number" name="ppe_shoes_size_4" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[3] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 42</label>
                                                                                <input type="number" name="ppe_shoes_size_5" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[4] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 43</label>
                                                                                <input type="number" name="ppe_shoes_size_6" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[5] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 44</label>
                                                                                <input type="number" name="ppe_shoes_size_7" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[6] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 45</label>
                                                                                <input type="number" name="ppe_shoes_size_8" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[7] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Size 46</label>
                                                                                <input type="number" name="ppe_shoes_size_9" max="100" class="form-control" placeholder="Size" value="{{ @$size_shoes[8] }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-5">
                                                            <div class="col-md-12">
                                                                <div class="row fv-row fv-plugins-icon-container">
                                                                    <label class="form-label">Vest</label>
                                                                    <div class="col-md-1">
                                                                        <div class="fv-row fv-plugins-icon-container">
                                                                            <label class="form-label">Size S</label>
                                                                            <input type="number" name="ppe_vest_size_1" max="100" class="form-control" placeholder="Size" value="{{ @$size_vest[0] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="fv-row fv-plugins-icon-container">
                                                                            <label class="form-label">Size M</label>
                                                                            <input type="number" name="ppe_vest_size_2" max="100" class="form-control" placeholder="Size" value="{{ @$size_vest[1] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="fv-row fv-plugins-icon-container">
                                                                            <label class="form-label">Size L</label>
                                                                            <input type="number" name="ppe_vest_size_3" max="100" class="form-control" placeholder="Size" value="{{ @$size_vest[2] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="fv-row fv-plugins-icon-container">
                                                                            <label class="form-label">Size XL</label>
                                                                            <input type="number" name="ppe_vest_size_4" max="100" class="form-control" placeholder="Size" value="{{ @$size_vest[3] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="fv-row fv-plugins-icon-container">
                                                                            <label class="form-label">Card 2XL</label>
                                                                            <input type="number" name="ppe_vest_size_5" max="100" class="form-control" placeholder="Size" value="{{ @$size_vest[4] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="fv-row fv-plugins-icon-container">
                                                                            <label class="form-label">Card 3XL</label>
                                                                            <input type="number" name="ppe_vest_size_6" max="100" class="form-control" placeholder="Size" value="{{ @$size_vest[5] }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="fv-row fv-plugins-icon-container">
                                                                            <label class="form-label">Card 4XL</label>
                                                                            <input type="number" name="ppe_vest_size_7" max="100" class="form-control" placeholder="Size" value="{{ @$size_vest[6] }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <small id="emailHelp" class="form-text text-dark">Note:<br> Fill in the fields above as in the following example: Shoesses 10; size 41: 4 pairs; size 42: 4 pairs; 43: 2 pairs;<br> So the total is 10 pairs</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label"> Submit </span>
                                        <span class="indicator-progress"> Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="imgModal">
                    <div id="caption"></div>
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
        document.getElementById('addPersonil').addEventListener('click', function () {
            const personilContainer = document.getElementById('personilContainer');

            // Ambil template personil pertama yang tersembunyi
            const firstPersonilRow = document.querySelector('.personil-template');

            if (firstPersonilRow) {
                // Clone row pertama (template)
                const newPersonilRow = firstPersonilRow.cloneNode(true);

                // Clear the input values in the cloned row
                Array.from(newPersonilRow.querySelectorAll('input')).forEach(input => {
                    input.value = '';  // Clear the value for each input field
                });

                // Append the cloned row to the container
                personilContainer.appendChild(newPersonilRow);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen modal, gambar dalam modal, caption, dan tombol close
        var modal = document.getElementById('myModal');
        var modalImg = document.getElementById("imgModal");
        var captionText = document.getElementById("caption");
        var closeBtn = document.getElementsByClassName("close")[0];

        // Ambil semua gambar dengan class 'img-modal'
        var images = document.querySelectorAll('.img-modal');

        // Loop untuk setiap gambar, dan tambahkan event listener
        images.forEach(function(img) {
            img.addEventListener('click', function() {
                modal.style.display = "block";  // Tampilkan modal
                modalImg.src = this.src;       // Set gambar besar di dalam modal
                captionText.innerHTML = this.alt; // Set caption dari gambar
            });
        });

        // Ketika pengguna mengklik tombol close, tutup modal
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Ketika pengguna mengklik di luar gambar (area gelap), tutup modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });



    document.addEventListener('DOMContentLoaded', function () {
        const ppeFields = document.querySelectorAll('.ppe-field');

        ppeFields.forEach(field => {
            field.addEventListener('input', function () {
                if (this.value > 100) {
                    this.value = 100; // Set nilai maksimum menjadi 100
                }
            });
        });
    });

    // disable field
    // document.addEventListener('DOMContentLoaded', function () {
    //     const ppeCheckbox = document.getElementById('ppes');
    //     const ppeFields = document.querySelectorAll('.ppe-field');

    //     function togglePPEFields() {
    //         ppeFields.forEach(field => {
    //             field.disabled = !ppeCheckbox.checked;
    //         });
    //     }

    //     // Initial state toggle
    //     togglePPEFields();

    //     // Add event listener
    //     ppeCheckbox.addEventListener('change', togglePPEFields);
    // });

    document.addEventListener('DOMContentLoaded', function () {
        const ppeCheckbox = document.getElementById('ppes');
        const ppeFields = document.querySelectorAll('.ppe-field');

        function togglePPEFields() {
            ppeFields.forEach(field => {
                if (ppeCheckbox.checked) {
                    field.style.display = 'block'; // Menampilkan field
                } else {
                    field.style.display = 'none'; // Menyembunyikan field
                }
            });
        }

        // Initial state toggle
        togglePPEFields();

        // Add event listener
        ppeCheckbox.addEventListener('change', togglePPEFields);
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
