@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">New Worker Access</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">New Worker Access</li>
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
                            <form action="/worker/store" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">

                                <div class="row mb-4">
                                    <label for="company_id" class="col-sm-3 col-form-label">Company</label>
                                    <div class="col-sm-5">
                                        <select name="company_id" id="company_id" class="form-control">
                                            <option value=""></option>
                                            @foreach ($company as $c)
                                                <option value="{{ @$c->id }}" {{ (@$data->company_id == $c->id) ? 'selected' : '' }}>{{ @$c->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company_id'))
                                            <span class="text-danger">{{ $errors->first('company_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="badge" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-8">
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description', @$data->description) }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="dete_request" class="col-sm-3 col-form-label">Date Request</label>
                                    <div class="col-sm-2">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" name="dete_request"
                                                data-date-format="dd M, yyyy"
                                                data-date-container='#datepicker1'
                                                data-provide="datepicker"
                                                data-date-autoclose="true"
                                                class="form-control @error('dete_request') is-invalid @enderror"
                                                value="{{ old('date_request', ( @$data->id ) ? date('d M, Y', strtotime(@$data->date_request)) : date('d M, Y')) }}"
                                                id="dete_request"
                                                placeholder="Date Request">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            @if ($errors->has('dete_request'))
                                                <span class="text-danger">{{ $errors->first('dete_request') }}</span>
                                            @endif
                                        </div>
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
                                        <a href="/worker" class="btn btn-light w-md">Back</a>
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

    $(document).on('click', '.delete', function () {

        var id = $(this).data('id');
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success btn-rounded',
            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
            buttonsStyling: false,
        })

        Swal.fire({
            title: 'Are your sure ?',
            icon: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            confirmButtonText: "Yes, delete!",
            confirmButtonAriaLabel: 'Yes delete',
            cancelButtonClass: 'btn btn-danger',
            cancelButtonText:'Cancel!',
            cancelButtonAriaLabel: 'Cancel'
        }).then(function(result) {
            if (result?.value && (result?.value[0] != "")) {
                $.ajax({
                    url : '/access/delete/' + id,
                    type : "get",
                    success: function(response){
                        Swal.fire(
                            'Success!',
                            'Data deleted',
                            'success'
                        )
                        $('.data-table').dataTable().api().ajax.reload();
                    },
                    error: function (data) {
                        Swal.fire(
                            'Wrong',
                            'Internal server error',
                            'error'
                        )
                    }
                });
            } else if (
            result.dismiss === swal.DismissReason.cancel
            ) {
                Swal.fire(
                    'Cancel',
                    'Data do not delete',
                    'error'
                )
            }
        })
        });
});
</script>
@endsection
