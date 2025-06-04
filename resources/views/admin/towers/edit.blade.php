@extends('layouts.admin_new')

@section('title', __('towers.edit'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">{{ __('towers.edit_title') }}</p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.towers.update', $tower) }}" method="POST" id="editTowerForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar" class="form-control-label">{{ __('towers.fields.name_ar') }}</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" 
                                   id="name_ar" name="name_ar" value="{{ old('name_ar', $tower->name_ar) }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_en" class="form-control-label">{{ __('towers.fields.name_en') }}</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                   id="name_en" name="name_en" value="{{ old('name_en', $tower->name_en) }}" required>
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
                                    <option value="{{ $branch->id }}" 
                                        {{ old('branch_id', $tower->branch_id) == $branch->id ? 'selected' : '' }}>
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
                            <label for="is_active" class="form-control-label">{{ __('towers.fields.status') }}</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" 
                                    id="is_active" name="is_active" required>
                                <option value="1" {{ old('is_active', $tower->is_active) ? 'selected' : '' }}>
                                    {{ __('common.active') }}
                                </option>
                                <option value="0" {{ old('is_active', !$tower->is_active) ? 'selected' : '' }}>
                                    {{ __('common.inactive') }}
                                </option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cost" class="form-control-label">{{ __('towers.fields.cost') }}</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('cost') is-invalid @enderror" 
                                       id="cost" name="cost" value="{{ old('cost', $tower->cost) }}" required
                                       data-original-value="{{ $tower->cost }}">
                                <span class="input-group-text">SAR</span>
                            </div>
                            <small class="text-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ __('towers.cost_warning') }}
                            </small>
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_ar" class="form-control-label">{{ __('towers.fields.description_ar') }}</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                      id="description_ar" name="description_ar" rows="3">{{ old('description_ar', $tower->description_ar) }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_en" class="form-control-label">{{ __('towers.fields.description_en') }}</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                      id="description_en" name="description_en" rows="3">{{ old('description_en', $tower->description_en) }}</textarea>
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

<!-- Cost Warning Modal -->
<div class="modal fade" id="costWarningModal" tabindex="-1" aria-labelledby="costWarningModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="costWarningModalLabel">{{ __('towers.cost_warning_title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('towers.cost_warning_message') }}</p>
                <p class="mb-0">
                    <strong>{{ __('towers.fields.cost') }}:</strong>
                    <span id="oldCost"></span> → <span id="newCost"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('towers.cost_warning_cancel') }}</button>
                <button type="button" class="btn btn-primary" id="confirmCostChange">{{ __('towers.cost_warning_confirm') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editTowerForm');
    const costInput = document.getElementById('cost');
    const originalCost = costInput.dataset.originalValue;
    let costChanged = false;

    costInput.addEventListener('change', function() {
        costChanged = this.value !== originalCost;
    });

    form.addEventListener('submit', function(e) {
        if (costChanged) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('costWarningModal'));
            document.getElementById('oldCost').textContent = originalCost + ' SAR';
            document.getElementById('newCost').textContent = costInput.value + ' SAR';
            modal.show();
        }
    });

    document.getElementById('confirmCostChange').addEventListener('click', function() {
        form.submit();
    });
});
</script>
@endpush 