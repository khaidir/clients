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
                            <li class="breadcrumb-item text-white fw-bold lh-1"> Company </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-6 pb-18 py-lg-13">
                        <div class="page-title d-flex align-items-center me-3">
                            <img alt="Logo" src="/assets/media/svg/misc/layer.svg" class="h-60px me-5">
                            <h1 class="page-heading d-flex text-white fw-bolder fs-2 flex-column justify-content-center my-0"> Company <span class="page-desc text-white opacity-50 fs-6 fw-bold pt-4"> Please field Company Complete </span>
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
                        <form action="{{ route('public.company.store') }}" method="post" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
                            @csrf
                            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                                @include('layouts.public.sidebar-profile')
                            </div>
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card-flush py-4">
                                        <h3 class="mb-8">My Company</h3>
                                        <div class="row card-bodys pt-0">
                                            <div class="col-md-12 mb-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Company Name</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror mb-2" placeholder="Fullname" value="{{ old('fullname', @$data->name) }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Email</label>
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror mb-2" placeholder="Email" value="{{ old('email', @$data->email) }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror mb-2" placeholder="Phone" value="{{ old('phone', @$data->phone) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Website</label>
                                                    <input type="text" name="website" class="form-control @error('website') is-invalid @enderror mb-2" placeholder="Website" value="{{ old('website', @$data->website) }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-6">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Industry</label>
                                                    <select name="industry" class="form-control">
                                                        <option value="">Choose</option>
                                                        @foreach($industries as $industry)
                                                        <option value="{{ $industry }}" {{ $industry == $data->industry ? 'selected' : '' }}>
                                                            {{ $industry }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input type="text" name="position" class="form-control @error('position') is-invalid @enderror mb-2" placeholder="Position" value="{{ old('position', @$data->position) }}"> --}}
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="fv-row fv-plugins-icon-container">
                                                    <label class="form-label">Address</label>
                                                    <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror mb-2" placeholder="Address" cols="30" rows="3">{{ old('address', @$data->address) }}</textarea>
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
                <div id="kt_app_footer" class="app-footer  d-flex flex-column flex-md-row align-items-center flex-center flex-md-stack py-2 py-lg-4 ">
                    <div class="text-gray-900 order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2024©</span>
                        <a href="javascript:;" target="_blank" class="text-gray-800 text-hover-primary">PT Semen Bangun Andalas</a>
                    </div>
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item">
                            <a href="/about" target="_blank" class="menu-link px-2">About</a>
                        </li>
                        <li class="menu-item">
                            <a href="/faq" target="_blank" class="menu-link px-2">Frequently Asked Questions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.public.footer')
