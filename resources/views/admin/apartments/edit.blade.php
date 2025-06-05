@extends('layouts.admin_new')

@section('title', __('apartments.edit'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">{{ __('apartments.edit_title') }}</p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.apartments.update', $apartment) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">{{ __('apartments.fields.name') }}</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $apartment->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tower_id" class="form-control-label">{{ __('apartments.fields.tower') }}</label>
                            <select class="form-select @error('tower_id') is-invalid @enderror" name="tower_id" id="tower_id" required>
                                <option value="">{{ __('apartments.select_tower') }}</option>
                                @foreach($towers as $tower)
                                    <option value="{{ $tower->id }}" {{ old('tower_id', $apartment->tower_id) == $tower->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'ar' ? $tower->name_ar : $tower->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tower_id')
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
                                    <option value="{{ $type->id }}" {{ old('apartment_type_id', $apartment->apartment_type_id) == $type->id ? 'selected' : '' }}>
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
                            <input class="form-control @error('floor_number') is-invalid @enderror" type="number" name="floor_number" id="floor_number" value="{{ old('floor_number', $apartment->floor_number) }}" required>
                            @error('floor_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cost" class="form-control-label">{{ __('apartments.fields.cost') }}</label>
                            <input class="form-control @error('cost') is-invalid @enderror" type="number" step="0.01" name="cost" id="cost" value="{{ old('cost', $apartment->cost) }}" required>
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- بيانات المستفيد -->
                    <div class="col-12 mt-4">
                        <h6 class="mb-3">{{ __('apartments.beneficiary_info') }}</h6>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beneficiary_type" class="form-control-label">{{ __('apartments.fields.beneficiary_type') }}</label>
                            <select class="form-select @error('beneficiary_type') is-invalid @enderror" name="beneficiary_type" id="beneficiary_type">
                                <option value="">{{ __('apartments.select_beneficiary_type') }}</option>
                                <option value="owner" {{ old('beneficiary_type', $apartment->beneficiary_type) == 'owner' ? 'selected' : '' }}>{{ __('apartments.beneficiary_types.owner') }}</option>
                                <option value="tenant" {{ old('beneficiary_type', $apartment->beneficiary_type) == 'tenant' ? 'selected' : '' }}>{{ __('apartments.beneficiary_types.tenant') }}</option>
                            </select>
                            @error('beneficiary_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beneficiary_id" class="form-control-label">{{ __('apartments.fields.beneficiary_id') }}</label>
                            <input class="form-control @error('beneficiary_id') is-invalid @enderror" type="text" name="beneficiary_id" id="beneficiary_id" value="{{ old('beneficiary_id', $apartment->beneficiary_id) }}">
                            @error('beneficiary_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beneficiary_name_ar" class="form-control-label">{{ __('apartments.fields.beneficiary_name_ar') }}</label>
                            <input class="form-control @error('beneficiary_name_ar') is-invalid @enderror" type="text" name="beneficiary_name_ar" id="beneficiary_name_ar" value="{{ old('beneficiary_name_ar', $apartment->beneficiary_name_ar) }}">
                            @error('beneficiary_name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beneficiary_name_en" class="form-control-label">{{ __('apartments.fields.beneficiary_name_en') }}</label>
                            <input class="form-control @error('beneficiary_name_en') is-invalid @enderror" type="text" name="beneficiary_name_en" id="beneficiary_name_en" value="{{ old('beneficiary_name_en', $apartment->beneficiary_name_en) }}">
                            @error('beneficiary_name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beneficiary_mobile" class="form-control-label">{{ __('apartments.fields.beneficiary_mobile') }}</label>
                            <input class="form-control @error('beneficiary_mobile') is-invalid @enderror" type="text" name="beneficiary_mobile" id="beneficiary_mobile" value="{{ old('beneficiary_mobile', $apartment->beneficiary_mobile) }}">
                            @error('beneficiary_mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beneficiary_email" class="form-control-label">{{ __('apartments.fields.beneficiary_email') }}</label>
                            <input class="form-control @error('beneficiary_email') is-invalid @enderror" type="email" name="beneficiary_email" id="beneficiary_email" value="{{ old('beneficiary_email', $apartment->beneficiary_email) }}">
                            @error('beneficiary_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.apartments.index') }}" class="btn btn-light m-0 me-2">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn btn-primary m-0">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Cost change warning
    document.getElementById('cost').addEventListener('change', function() {
        const originalCost = {{ $apartment->cost }};
        const newCost = parseFloat(this.value);
        
        if (newCost !== originalCost) {
            if (!confirm('{{ __('apartments.messages.cost_changed') }}')) {
                this.value = originalCost;
            }
        }
    });
</script>
@endpush

@endsection 