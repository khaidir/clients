@extends('layouts.admin.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-0 d-sm-flex align-items-center justify-content-between">
                    <h2 class="mb-sm-0 m-0 font-size-18 page-title">Users</h2>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Users</li>
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
                            <h4 class="card-title">{{ @$user->id ? 'Edit' : 'Create' }}</h4>
                            <p class="card-title-desc">Please fill out the form below completely.</p>
                            <form action="/users/store" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$user->id }}">

                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Fullname</label>
                                    <div class="col-sm-6">
                                        <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', @$user->name) }}" placeholder="Fullname">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-5">
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', @$user->email) }}" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="company" class="col-sm-3 col-form-label">Company</label>
                                    <div class="col-sm-5">
                                        <select name="company_id" class="form-control">
                                            <option value="">Choose</option>
                                            @foreach($company as $c)
                                            <option value="{{ $c->id }}" {{ $c->id == @$user->company_id ? 'selected' : '' }}>
                                                {{ $c->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company'))
                                            <span class="text-danger">{{ $errors->first('company') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-4">
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your Password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-4">
                                        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Your Password">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="position" class="col-sm-3 col-form-label">Position</label>
                                    <div class="col-sm-4">
                                        <input name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', @$user->position) }}" placeholder="Position">
                                        @if ($errors->has('position'))
                                            <span class="text-danger">{{ $errors->first('position') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-7">
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{ old('address', @$user->address) }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="roles" class="col-sm-3 col-form-label">Roles</label>
                                    <div class="col-sm-5">
                                        <select name="roles[]" class="form-control" multiple>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    @if(isset($user) && in_array($role->id, @$userRole)) selected @endif>
                                                    {{ ucwords($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('roles'))
                                        <span class="text-danger">{{ $errors->first('roles') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary w-md">Save</button>
                                        <a href="/users" class="btn btn-light w-md">Back</a>
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
