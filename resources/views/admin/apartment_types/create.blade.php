@extends('layouts.admin')

@section('title', __('apartment_types.add_new'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">{{ __('apartment_types.add_new') }}</p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.apartment-types.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar" class="form-control-label">{{ __('apartment_types.fields.name_ar') }}</label>
                            <input class="form-control @error('name_ar') is-invalid @enderror" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar') }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_en" class="form-control-label">{{ __('apartment_types.fields.name_en') }}</label>
                            <input class="form-control @error('name_en') is-invalid @enderror" type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_active" class="form-control-label">{{ __('apartment_types.fields.status') }}</label>
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
                    <a href="{{ route('admin.apartment-types.index') }}" class="btn btn-light m-0 me-2">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn btn-primary m-0">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 