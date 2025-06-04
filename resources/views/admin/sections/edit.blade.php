@extends('layouts.admin_new')

@section('title', __('sections.edit'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">{{ __('sections.edit_title') }}</p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sections.update', $section) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar" class="form-control-label">{{ __('sections.fields.name_ar') }}</label>
                            <input class="form-control @error('name_ar') is-invalid @enderror" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $section->name_ar) }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_en" class="form-control-label">{{ __('sections.fields.name_en') }}</label>
                            <input class="form-control @error('name_en') is-invalid @enderror" type="text" name="name_en" id="name_en" value="{{ old('name_en', $section->name_en) }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cost" class="form-control-label">{{ __('sections.fields.cost') }}</label>
                            <input class="form-control @error('cost') is-invalid @enderror" type="number" step="0.01" name="cost" id="cost" value="{{ old('cost', $section->cost) }}" required>
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_active" class="form-control-label">{{ __('sections.fields.status') }}</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" name="is_active" id="is_active">
                                <option value="1" {{ old('is_active', $section->is_active) ? 'selected' : '' }}>{{ __('common.active') }}</option>
                                <option value="0" {{ old('is_active', $section->is_active) ? '' : 'selected' }}>{{ __('common.inactive') }}</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.sections.index') }}" class="btn btn-light m-0 me-2">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn btn-primary m-0">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // تحذير عند تغيير التكلفة
    const costInput = document.getElementById('cost');
    const originalCost = {{ $section->cost }};
    
    costInput.addEventListener('change', function() {
        if (this.value != originalCost) {
            Swal.fire({
                title: '{{ __("sections.cost_warning_title") }}',
                text: '{{ __("sections.cost_warning_message") }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __("sections.cost_warning_confirm") }}',
                cancelButtonText: '{{ __("sections.cost_warning_cancel") }}',
                reverseButtons: true
            }).then((result) => {
                if (!result.isConfirmed) {
                    this.value = originalCost;
                }
            });
        }
    });
</script>
@endpush 