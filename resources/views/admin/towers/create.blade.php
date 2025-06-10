@extends('layouts.admin')

@section('title', __('towers.create'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">{{ __('towers.create_title') }}</p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.towers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar" class="form-control-label">{{ __('towers.fields.name_ar') }}</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" 
                                   id="name_ar" name="name_ar" value="{{ old('name_ar') }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_en" class="form-control-label">{{ __('towers.fields.name_en') }}</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                   id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="branch_id" class="form-control-label">{{ __('towers.fields.branch') }}</label>
                            <select class="form-select @error('branch_id') is-invalid @enderror" 
                                    id="branch_id" name="branch_id" required>
                                <option value="">{{ __('common.select_option') }}</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="form-control-label">{{ __('towers.fields.status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                    {{ __('towers.status.active') }}
                                </option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                    {{ __('towers.status.inactive') }}
                                </option>
                                <option value="under_maintenance" {{ old('status') == 'under_maintenance' ? 'selected' : '' }}>
                                    {{ __('towers.status.under_maintenance') }}
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="floors_count" class="form-control-label">{{ __('towers.fields.floors_count') }}</label>
                            <input type="number" class="form-control @error('floors_count') is-invalid @enderror" 
                                   id="floors_count" name="floors_count" value="{{ old('floors_count') }}" required min="1">
                            @error('floors_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apartments_per_floor" class="form-control-label">{{ __('towers.fields.apartments_per_floor') }}</label>
                            <input type="number" class="form-control @error('apartments_per_floor') is-invalid @enderror" 
                                   id="apartments_per_floor" name="apartments_per_floor" value="{{ old('apartments_per_floor') }}" required min="1">
                            @error('apartments_per_floor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_ar" class="form-control-label">{{ __('towers.fields.description_ar') }}</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                      id="description_ar" name="description_ar" rows="3">{{ old('description_ar') }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_en" class="form-control-label">{{ __('towers.fields.description_en') }}</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                      id="description_en" name="description_en" rows="3">{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.towers.index') }}" class="btn btn-light m-0 me-2">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn bg-gradient-primary m-0">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 