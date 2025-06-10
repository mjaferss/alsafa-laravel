@extends('layouts.admin')

@section('title', __('sections.add_new'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">{{ __('sections.add_new') }}</p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sections.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar" class="form-control-label">{{ __('sections.fields.name_ar') }}</label>
                            <input class="form-control @error('name_ar') is-invalid @enderror" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar') }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_en" class="form-control-label">{{ __('sections.fields.name_en') }}</label>
                            <input class="form-control @error('name_en') is-invalid @enderror" type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cost" class="form-control-label">{{ __('sections.fields.cost') }}</label>
                            <input class="form-control @error('cost') is-invalid @enderror" type="number" step="0.01" name="cost" id="cost" value="{{ old('cost', 0) }}" required>
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_active" class="form-control-label">{{ __('sections.fields.status') }}</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" name="is_active" id="is_active">
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>{{ __('common.active') }}</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>{{ __('common.inactive') }}</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.sections.index') }}" class="btn bg-gradient-secondary m-0 me-2">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn bg-gradient-primary m-0">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any necessary JavaScript for form validation or dynamic behavior
</script>
@endpush 