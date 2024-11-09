@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">Visitor Access Person</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Visitor Access Person</li>
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
                            <form action="/ppe/unit/store" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">
                                <input type="hidden" name="type_id" class="form-control" value="{{ (@$data->id) ? @$data->type_id : @$id }}">

                                <div class="row mb-4">
                                    <label for="code" class="col-sm-3 col-form-label">Code</label>
                                    <div class="col-sm-3">
                                        <input name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', @$data->code) }}" placeholder="Code">
                                        @if ($errors->has('code'))
                                        <span class="text-danger">{{ $errors->first('code') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="merk" class="col-sm-3 col-form-label">Merk</label>
                                    <div class="col-sm-5">
                                        <input name="merk" type="text" class="form-control @error('merk') is-invalid @enderror" value="{{ old('merk', @$data->merk) }}" placeholder="Merk">
                                        @if ($errors->has('merk'))
                                        <span class="text-danger">{{ $errors->first('merk') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="colour" class="col-sm-3 col-form-label">Colour</label>
                                    <div class="col-sm-2">
                                        <input name="colour" type="color" class="form-control @error('colour') is-invalid @enderror" value="{{ old('colour', @$data->colour) }}" placeholder="Colour">
                                        @if ($errors->has('colour'))
                                        <span class="text-danger">{{ $errors->first('colour') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="condition" class="col-sm-3 col-form-label">Condition</label>
                                    <div class="col-sm-7">
                                        <input name="condition" class="form-control @error('condition') is-invalid @enderror" value="{{ old('condition', @$data->condition) }}" placeholder="Condition">
                                        @if ($errors->has('condition'))
                                        <span class="text-danger">{{ $errors->first('condition') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="notes" class="col-sm-3 col-form-label">Notes</label>
                                    <div class="col-sm-8">
                                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" placeholder="Notes">{{ old('notes', @$data->notes) }}</textarea>
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
                                        <button type="submit" class="btn btn-primary w-md">Save</button>
                                        <a href="/ppe/units/{{ (@$data->id) ? @$data->type_id : @$id }}" class="btn btn-light w-md">Back</a>
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
