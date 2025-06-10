@extends('layouts.admin')

@section('title', __('towers.add_apartment'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">{{ __('towers.add_apartment_to', ['tower' => app()->getLocale() == 'ar' ? $tower->name_ar : $tower->name_en]) }}</p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.towers.store-apartment', $tower) }}" method="POST">
                @csrf
                <input type="hidden" name="tower_id" value="{{ $tower->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">{{ __('apartments.fields.name') }}</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apartment_type_id" class="form-control-label">{{ __('apartments.fields.type') }}</label>
                            <select class="form-select @error('apartment_type_id') is-invalid @enderror" name="apartment_type_id" id="apartment_type_id" required>
                                <option value="">{{ __('apartments.select_type') }}</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ old('apartment_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('apartment_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="floor_number" class="form-control-label">{{ __('apartments.fields.floor_number') }}</label>
                            <input class="form-control @error('floor_number') is-invalid @enderror" type="number" name="floor_number" id="floor_number" value="{{ old('floor_number') }}" required>
                            @error('floor_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cost" class="form-control-label">{{ __('apartments.fields.cost') }}</label>
                            <input class="form-control @error('cost') is-invalid @enderror" type="number" step="0.01" name="cost" id="cost" value="{{ old('cost') }}" required>
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.towers.index') }}" class="btn btn-light m-0 me-2">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn btn-primary m-0">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 