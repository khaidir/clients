@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">Visitor Access</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Visitor Access</li>
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
                            <form action="/visitor/ppe/store" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">
                                <input type="hidden" name="visitor_id" class="form-control" value="{{ (@$data->id) ? @$data->visitor_id : @$id }}">

                                {{-- <div class="row">
                                    <label for="code" class="col-sm-3 col-form-label">Code</label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', @$data->code) }}" placeholder="Code">
                                            <button class="btn btn-primary" type="button" id="inputGroupFileAddon03"><i class='bx bx-search-alt' ></i></button>
                                        </div>
                                        <span class="text-success">Suggestion</span>
                                    </div>
                                </div>
                                <hr class="mb-4"> --}}

                                <div class="row mb-4">
                                    <label for="badge" class="col-sm-3 col-form-label">Goods/PPE</label>
                                    <div class="col-sm-4">
                                        <select name="ppe_id" id="ppe_id" style="width:100%">
                                            <option value="">Pilih</option>
                                            @foreach ($ppes as $ppe)
                                            <option value="{{ @$ppe->id }}">{{ @$ppe->code .' - '. @$ppe->goods }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('citizenship'))
                                            <span class="text-danger">{{ $errors->first('citizenship') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="date_pickup" class="col-sm-3 col-form-label">Date Pick Up</label>
                                    <div class="col-sm-3">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" name="date_pickup"
                                                data-date-format="dd M, yyyy"
                                                data-date-container='#datepicker1'
                                                data-provide="datepicker"
                                                data-date-autoclose="true"
                                                class="form-control @error('date_pickup') is-invalid @enderror"
                                                value="{{ old('date_pickup', ( @$data->id ) ? date('d M, Y', strtotime(@$data->date_pickup)) : date('d M, Y')) }}"
                                                id="date_pickup"
                                                placeholder="Date Pickup">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            @if ($errors->has('date_pickup'))
                                                <span class="text-danger">{{ $errors->first('date_pickup') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if (@$data->id)
                                <div class="row mb-4">
                                    <label for="date_return" class="col-sm-3 col-form-label">Date Return</label>
                                    <div class="col-sm-3">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" name="date_return"
                                                data-date-format="dd M, yyyy"
                                                data-date-container='#datepicker1'
                                                data-provide="datepicker"
                                                data-date-autoclose="true"
                                                class="form-control @error('date_return') is-invalid @enderror"
                                                value="{{ old('date_return', ( @$data->id ) ? date('d M, Y', strtotime(@$data->date_return)) : date('d M, Y')) }}"
                                                id="date_return"
                                                placeholder="Date Return">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            @if ($errors->has('date_return'))
                                                <span class="text-danger">{{ $errors->first('date_return') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row mb-4">
                                    <label for="notes" class="col-sm-3 col-form-label">Notes</label>
                                    <div class="col-sm-6">
                                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', @$data->notes) }}</textarea>
                                        @if ($errors->has('notes'))
                                            <span class="text-danger">{{ $errors->first('notes') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <div class="form-check form-switch form-switch-md mb-2" dir="ltr">
                                            <input name="status" class="form-check-input" type="checkbox" value="1" id="SwitchCheckSizemd" {{ (@$data->status === true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="SwitchCheckSizemd"></label>
                                        </div>
                                        <p class="text-muted mb-2">Switch Knots to Approve or Unapprove</p>
                                        @if ($errors->has('status'))
                                            <span class="text-danger">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary w-md">Simpan</button>
                                        <a href="/visitor/ppe/{{ (@$data->id) ? @$data->visitor_id : @$id }}" class="btn btn-light w-md">Kembali</a>
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
        placeholder: 'Pilih'
    });
});
</script>
@endsection
