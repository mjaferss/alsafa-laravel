@extends('layouts.admin')

@section('title', __('branches.list'))

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">{{ __('branches.list_title') }}</h5>
                        @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'manager')
                            <a href="{{ route('admin.branches.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-2"></i> {{ __('branches.add_new') }}
                            </a>
                        @endif
                    </div>

                    <!-- Advanced Search Form -->
                    <form action="{{ route('admin.branches.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                                <input type="text" 
                                       class="form-control" 
                                       name="search" 
                                       placeholder="{{ __('common.search') }}" 
                                       value="{{ request('search') }}"
                                       aria-label="{{ __('common.search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="is_active" aria-label="{{ __('branches.fields.status') }}">
                                <option value="">{{ __('branches.fields.status') }}</option>
                                <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>{{ __('common.active') }}</option>
                                <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>{{ __('common.inactive') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>{{ __('common.search') }}
                            </button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-redo me-2"></i>{{ __('common.reset') }}
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Card Body -->
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ app()->getLocale() == 'ar' ? __('branches.fields.name_ar') : __('branches.fields.name_en') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 d-none d-md-table-cell">
                                        {{ __('branches.fields.phone') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('branches.fields.status') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 d-none d-md-table-cell">
                                        {{ __('branches.fields.created_at') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        {{ __('common.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($branches as $branch)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en }}</h6>
                                                <p class="text-xs text-secondary mb-0 d-md-none">{{ $branch->phone }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <p class="text-sm mb-0">{{ $branch->phone }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm {{ $branch->is_active ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                            {{ $branch->is_active ? __('common.active') : __('common.inactive') }}
                                        </span>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <p class="text-sm mb-0">{{ $branch->created_at->format('Y-m-d') }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon-only text-dark mb-0" 
                                                    type="button" 
                                                    data-bs-toggle="dropdown" 
                                                    aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button type="button" 
                                                            class="dropdown-item" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#viewBranchModal{{ $branch->id }}">
                                                        <i class="fas fa-eye me-2"></i> {{ __('branches.actions.view') }}
                                                    </button>
                                                </li>
                                                @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'manager')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.branches.edit', $branch) }}">
                                                        <i class="fas fa-edit me-2"></i> {{ __('branches.actions.edit') }}
                                                    </a>
                                                </li>
                                                @endif
                                                @if(auth()->user()->role === 'super_admin')
                                                <li>
                                                    <form action="{{ route('admin.branches.destroy', $branch) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('{{ __('branches.confirmations.delete') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash me-2"></i> {{ __('branches.actions.delete') }}
                                                        </button>
                                                    </form>
                                                </li>
                                                @endif
                                                @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'manager')
                                                <li>
                                                    <form action="{{ route('admin.branches.toggle-status', $branch) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas {{ $branch->is_active ? 'fa-ban' : 'fa-check' }} me-2"></i>
                                                            {{ $branch->is_active ? __('branches.deactivate') : __('branches.activate') }}
                                                        </button>
                                                    </form>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- View Branch Modal -->
                                <div class="modal fade" 
                                     id="viewBranchModal{{ $branch->id }}" 
                                     tabindex="-1" 
                                     aria-labelledby="viewBranchModalLabel{{ $branch->id }}" 
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewBranchModalLabel{{ $branch->id }}">
                                                    {{ __('branches.details') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card card-body">
                                                    <div class="row gx-4">
                                                        <div class="col-auto">
                                                            <div class="avatar avatar-xl position-relative">
                                                                <div class="bg-gradient-primary rounded-circle h-100 w-100 d-flex align-items-center justify-content-center">
                                                                    <i class="fas fa-building text-white fa-2x"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto my-auto">
                                                            <div class="h-100">
                                                                <h5 class="mb-1">
                                                                    {{ app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en }}
                                                                </h5>
                                                                <p class="mb-0 font-weight-bold text-sm">
                                                                    {{ $branch->phone }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('branches.fields.name_ar') }}</label>
                                                                <p class="form-control-static">{{ $branch->name_ar }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('branches.fields.name_en') }}</label>
                                                                <p class="form-control-static">{{ $branch->name_en }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('branches.fields.address_ar') }}</label>
                                                                <p class="form-control-static">{{ $branch->address_ar }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('branches.fields.address_en') }}</label>
                                                                <p class="form-control-static">{{ $branch->address_en }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('branches.fields.phone') }}</label>
                                                                <p class="form-control-static">{{ $branch->phone }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('branches.fields.status') }}</label>
                                                                <p class="form-control-static">
                                                                    <span class="badge {{ $branch->is_active ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                                                        {{ $branch->is_active ? __('common.active') : __('common.inactive') }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('branches.fields.created_at') }}</label>
                                                                <p class="form-control-static">{{ $branch->created_at->format('Y-m-d H:i') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('branches.fields.updated_at') }}</label>
                                                                <p class="form-control-static">{{ $branch->updated_at->format('Y-m-d H:i') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('common.close') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-folder-open fa-3x text-secondary mb-2"></i>
                                            <p class="mb-0 text-secondary">{{ __('common.no_records') }}</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $branches->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Handle status toggle confirmation
    document.querySelectorAll('form[action*="toggle-status"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const isActive = this.querySelector('button i').classList.contains('fa-ban');
            const message = isActive 
                ? "{{ __('branches.confirmations.deactivate') }}"
                : "{{ __('branches.confirmations.activate') }}";
            
            if (confirm(message)) {
                this.submit();
            }
        });
    });

    // Flash messages auto-hide
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 150);
        }, 3000);
    });
});
</script>
@endpush

@push('styles')
<style>
    .btn {
        min-width: 40px;
    }
    .modal-dialog {
        max-width: 600px;
    }
    .table td .btn {
        padding: 0.5rem 1rem;
    }
    .table td .d-flex.gap-2 {
        gap: 0.5rem !important;
    }
</style>
@endpush
