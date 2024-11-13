@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">Roles</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Roles</li>
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
                            <form action="/roles/store" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">

                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Roles</label>
                                    <div class="col-sm-6">
                                        <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', @$data->name) }}" placeholder="Roles">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        @foreach ($permissions as $group_name => $permissionGroup)
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <strong>{{ $group_name }}</strong>
                                                </div>
                                                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                                    <div class="row">
                                                        @foreach ($permissionGroup as $index => $permission)
                                                            <div class="col-md-4 mb-2">
                                                                <label>
                                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                                                        class="name" {{ in_array($permission->id, @$rolePermissions ?? []) ? 'checked' : '' }}>
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>

                                                            <!-- Untuk memastikan tidak lebih dari 5 per baris, setelah 5 checkbox, pindah baris -->
                                                            @if (($index + 1) % 5 == 0)
                                                                </div>
                                                                <div class="row">
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($errors->has('permission'))
                                            <span class="text-danger">{{ $errors->first('permission') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary w-md">Save</button>
                                        <a href="/roles" class="btn btn-light w-md">Back</a>
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
