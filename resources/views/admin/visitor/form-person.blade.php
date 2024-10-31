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
                            <form action="/visitor/person/store" method="post" class="needs-validation">
                                @csrf
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ @$data->id }}">
                                <input type="hidden" name="visitor_id" class="form-control" value="{{ (@$data->id) ? @$data->visitor_id : @$id }}">

                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', @$data->name) }}" placeholder="Name">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="badge" class="col-sm-3 col-form-label">Citizenship</label>
                                    <div class="col-sm-4">
                                        <select name="citizenship" id="citizenship" style="width:100%">
                                            <option value="">Pilih</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ @$country->name }}">{{ @$country->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('citizenship'))
                                            <span class="text-danger">{{ $errors->first('citizenship') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="badge" class="col-sm-3 col-form-label">Upload Citizenship</label>
                                    <div class="col-sm-4">
                                        <div class="col-12">
                                            <input type="file" id="docs-citizenship-input" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                                            <label for="docs-citizenship-input" id="label" style="cursor: pointer;">
                                                <span id="docs-citizenship-text"><i class='bx bx-paperclip bx-xs bx-rotate-270'></i>Choose Citizenship</span>
                                            </label>
                                            <input type="hidden" id="docs-citizenship-filename" name="docs_citizenship" value="{{ old('docs_citizenship', @$data->docs_citizenship) }}">
                                        </div>
                                        <code class="mb-lg-0" id="docs-citizenship-name"></code>
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
                                        <a href="/visitor/person/{{ (@$data->id) ? @$data->visitor_id : @$id }}" class="btn btn-light w-md">Back</a>
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

function setupFileUpload(inputId, hiddenInputId, filenameDisplayId) {
    const fileInput = document.getElementById(inputId);
    if (!fileInput) {
        console.error(`Element with ID ${inputId} not found.`);
        return;
    }

    fileInput.addEventListener('change', function() {
        let formData = new FormData();
        formData.append('file', fileInput.files[0]);
        document.getElementById(filenameDisplayId).textContent = fileInput.files[0].name;

        fetch('{{ route("sia-person.upload") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(`HTTP error, status = ${response.status}: ${text}`);
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.filename) {
                document.getElementById(hiddenInputId).value = data.filename;
            } else {
                console.log('File upload failed.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
}

setupFileUpload('docs-citizenship-input', 'docs-citizenship-filename', 'docs-citizenship-name');

</script>
@endsection
