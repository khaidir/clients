@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">PPE Visitor Access</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">PPE Visitor Access</li>
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
                            <form action="/visitor/ppe/store-bulk" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">
                                <input type="hidden" name="visitor_id" class="form-control" value="{{ (@$data->id) ? @$data->visitor_id : @$id }}">

                                <div class="row mb-4">
                                    <label for="type_id" class="col-sm-3 col-form-label">Good/PPE</label>
                                    <div class="col-sm-4">
                                        <select name="type_id" id="type" style="width:100%">
                                            <option value="">Pilih</option>
                                            @foreach ($types as $ty)
                                            <option value="{{ @$ty->id }}">{{ @$ty->goods }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type_id'))
                                            <span class="text-danger">{{ $errors->first('type_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="ppe_id" class="col-sm-3 col-form-label">Select Goods Item</label>
                                    <div class="col-sm-8">
                                        <select name="ppe_id[]" id="ppe" multiple="multiple" style="width:100%">
                                            <option value="">Pilih</option>
                                        </select>
                                        @if ($errors->has('ppe_id'))
                                            <span class="text-danger">{{ $errors->first('ppe_id') }}</span>
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
                                        <button type="submit" class="btn btn-primary w-md">Save</button>
                                        <a href="/visitor/ppe/{{ (@$data->id) ? @$data->visitor_id : @$id }}" class="btn btn-light w-md">Back</a>
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

    $('#type').on('change', function() {
        var id = $(this).val();
        if (id) {
            $.ajax({
                url: "/get-goods/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#ppe').empty();
                    $('#ppe').append('<option value="">Select Goods Item</option>');
                    $.each(data, function(index, item) {
                        console.log(data)
                        $('#ppe').append('<option value="' + item.id + '">' + item.code + ' - ' + item.goods + ", Colour: " + item.colour + '</option>');
                    });
                }
            });
        } else {
            $('#ppe').empty();
            $('#ppe').append('<option value="">Select Goods Item</option>');
        }
    });
});
</script>
@endsection
