@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">Worker Extended</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Worker Extended</li>
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-xl-8 col-sm-12">
                            <h4 class="card-title">{{ @$data->id ? 'Edit' : 'Create' }}</h4>
                            <p class="card-title-desc">Please fill out the form below completely.</p>
                            <form action="/extend/store" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">

                                <div class="row mb-4">
                                    <label for="badge" class="col-sm-3 col-form-label">Company</label>
                                    <div class="col-sm-5">
                                        <select name="company_id" class="form-control">
                                            <option value="">Choose</option>
                                            @foreach($companies as $company)
                                            <option value="{{ @$company->id }}"{{ (@$data->company_id == $company->id)? ' selected':'' }}>{{ @$company->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company_id'))
                                            <span class="text-danger">{{ $errors->first('company_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="dete_request" class="col-sm-3 col-form-label">Contract Number</label>
                                    <div class="col-sm-4">
                                        <div class="input-group" id="no_contract">
                                            <input type="text" name="no_contract"
                                                class="form-control @error('no_contract') is-invalid @enderror"
                                                value="{{ old('no_contract', ( @$data->id ) ? @$data->no_contract : "") }}" id="no_contract"
                                                placeholder="Number Contract">
                                            @if ($errors->has('no_contract'))
                                                <span class="text-danger">{{ $errors->first('no_contract') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="dete_request" class="col-sm-3 col-form-label">Type Contract</label>
                                    <div class="col-sm-3">
                                        <div id="type_contract">
                                            <select name="type_contract" class="form-control @error('type_contract') is-invalid @enderror">
                                                <option value="">Choose</option>
                                                <option value="1"{{ (@$data->type_contract == '1') ? ' selected':'' }}>Contract</option>
                                                <option value="2"{{ (@$data->type_contract == '2') ? ' selected':'' }}>Purchase Request</option>
                                                <option value="3"{{ (@$data->type_contract == '3') ? ' selected':'' }}>Purchase Order</option>
                                            </select>
                                            @if ($errors->has('type_contract'))
                                                <span class="text-danger">{{ $errors->first('type_contract') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="date_request" class="col-sm-3 col-form-label">Periode</label>
                                    <div class="col-sm-3">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" name="periode_start"
                                                data-date-format="dd M, yyyy"
                                                data-date-container='#datepicker1'
                                                data-provide="datepicker"
                                                data-date-autoclose="true"
                                                class="form-control @error('date_request') is-invalid @enderror"
                                                value="{{ old('date_request', ( @$data->id ) ? date('d M, Y', strtotime(@$data->periode_start)) : date('d M, Y')) }}"
                                                id="date_request"
                                                placeholder="Date Request">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            @if ($errors->has('date_request'))
                                                <span class="text-danger">{{ $errors->first('date_request') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-1 text-center mt-2"> s/d </div>
                                    <div class="col-sm-3">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" name="periode_end"
                                                data-date-format="dd M, yyyy"
                                                data-date-container='#datepicker1'
                                                data-provide="datepicker"
                                                data-date-autoclose="true"
                                                class="form-control @error('date_request') is-invalid @enderror"
                                                value="{{ old('date_request', ( @$data->id ) ? date('d M, Y', strtotime(@$data->periode_end)) : date('d M, Y')) }}"
                                                id="date_request"
                                                placeholder="Date Request">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            @if ($errors->has('date_request'))
                                                <span class="text-danger">{{ $errors->first('date_request') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary w-md">Save</button>
                                        <a href="/extend" class="btn btn-light w-md">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
$(document).ready(function() {
    $('select').select2({
        placeholder: 'Choose'
    });
});
</script>
@endsection
