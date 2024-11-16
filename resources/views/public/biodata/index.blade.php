<form class="form w-100" action="{{route('biodata.store')}}" method="POST">
    @csrf
    <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ Auth()->user()->id }}">

    <div class="text-start mb-10">
        <h1 class="text-gray-900 mb-3 fs-3x" data-kt-translate="sign-up-title">Profile Data</h1>
        <div class="text-gray-500 fw-semibold fs-6" data-kt-translate="general-desc">Please complete your profile information to proceed</div>
    </div>
    <div class="row fv-row mb-7">
        <div class="col-xl-12">
            <input class="form-control form-control-lg form-control-solid" type="text" name="name_user" value="{{ Auth()->user()->name }}"/>
        </div>
    </div>
    <div class="fv-row mb-10">
        <input class="form-control form-control-lg form-control-solid" type="text" onkeypress="return isNumber(event)" placeholder="NIK" name="nik" required/>
        @if ($errors->has('nik'))
            <span class="text-danger">{{ $errors->first('nik') }}</span>
        @endif
    </div>
    <div class="fv-row mb-10">
        <input class="form-control form-control-lg form-control-solid" type="text" placeholder="Devision" name="jabatan" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <input class="form-control form-control-lg form-control-solid" type="text" onkeypress="return isNumber(event)" placeholder="Phone" name="phone" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <input class="form-control form-control-lg form-control-solid" type="text" placeholder="Place of birth" name="tmpt_lahir" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <input class="form-control form-control-lg form-control-solid" type="date" placeholder="Date of birth" name="tgl_lahir" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <textarea class="form-control form-control-lg form-control-solid" name="alamat" placeholder="Address"></textarea>
    </div>
    <div class="d-flex flex-stack">
        <button id="kt_sign_up_submit" class="btn btn-primary" data-kt-translate="sign-up-submit">
            <span class="indicator-label">Save Changes</span>
            <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</form>
