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