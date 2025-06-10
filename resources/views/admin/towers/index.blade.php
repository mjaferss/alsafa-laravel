@extends('layouts.admin')

@section('title', __('towers.list'))

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">{{ __('towers.list_title') }}</h5>
                        @can('create', App\Models\Tower::class)
                            <a href="{{ route('admin.towers.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-2"></i> {{ __('towers.add_new') }}
                            </a>
                        @endcan
                    </div>

                    <!-- Advanced Search Form -->
                    <form action="{{ route('admin.towers.index') }}" method="GET" class="row g-3">
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
                            <select class="form-select" name="is_active" aria-label="{{ __('towers.fields.status') }}">
                                <option value="">{{ __('towers.fields.status') }}</option>
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
                            <a href="{{ route('admin.towers.index') }}" class="btn btn-secondary w-100">
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
                                        {{ app()->getLocale() == 'ar' ? __('towers.fields.name_ar') : __('towers.fields.name_en') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('towers.fields.description') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('towers.fields.status') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 d-none d-md-table-cell">
                                        {{ __('towers.fields.created_at') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        {{ __('common.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($towers as $tower)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ app()->getLocale() == 'ar' ? $tower->name_ar : $tower->name_en }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">
                                            {{ app()->getLocale() == 'ar' ? ($tower->description_ar ?: __('common.not_available')) : ($tower->description_en ?: __('common.not_available')) }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm {{ $tower->is_active ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                            {{ $tower->is_active ? __('common.active') : __('common.inactive') }}
                                        </span>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <p class="text-sm mb-0">{{ $tower->created_at->format('Y-m-d') }}</p>
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
                                                            data-bs-target="#viewTowerModal{{ $tower->id }}">
                                                        <i class="fas fa-eye me-2"></i> {{ __('towers.actions.view') }}
                                                    </button>
                                                </li>
                                                @can('update', $tower)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.towers.edit', $tower) }}">
                                                        <i class="fas fa-edit me-2"></i> {{ __('towers.actions.edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.towers.create-apartment', $tower) }}">
                                                        <i class="fas fa-plus me-2"></i> {{ __('towers.actions.add_apartment') }}
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('delete', $tower)
                                                <li>
                                                    <form action="{{ route('admin.towers.destroy', $tower) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('{{ __('towers.confirmations.delete') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash me-2"></i> {{ __('towers.actions.delete') }}
                                                        </button>
                                                    </form>
                                                </li>
                                                @endcan
                                                @can('update', $tower)
                                                <li>
                                                    <form action="{{ route('admin.towers.toggle-status', $tower) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas {{ $tower->is_active ? 'fa-ban' : 'fa-check' }} me-2"></i>
                                                            {{ $tower->is_active ? __('towers.deactivate') : __('towers.activate') }}
                                                        </button>
                                                    </form>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- View Tower Modal -->
                                <div class="modal fade" 
                                     id="viewTowerModal{{ $tower->id }}" 
                                     tabindex="-1" 
                                     aria-labelledby="viewTowerModalLabel{{ $tower->id }}" 
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewTowerModalLabel{{ $tower->id }}">
                                                    {{ __('towers.details') }}
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
                                                                    {{ app()->getLocale() == 'ar' ? $tower->name_ar : $tower->name_en }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('towers.fields.name_ar') }}</label>
                                                                <p class="form-control-static">{{ $tower->name_ar }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('towers.fields.name_en') }}</label>
                                                                <p class="form-control-static">{{ $tower->name_en }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('towers.fields.description_ar') }}</label>
                                                                <p class="form-control-static">{{ $tower->description_ar ?: __('common.not_available') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('towers.fields.description_en') }}</label>
                                                                <p class="form-control-static">{{ $tower->description_en ?: __('common.not_available') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('towers.fields.status') }}</label>
                                                                <p class="form-control-static">
                                                                    <span class="badge {{ $tower->is_active ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                                                        {{ $tower->is_active ? __('common.active') : __('common.inactive') }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('towers.fields.created_at') }}</label>
                                                                <p class="form-control-static">{{ $tower->created_at->format('Y-m-d H:i') }}</p>
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
                                        <p class="mb-0">{{ __('common.no_records') }}</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $towers->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                        </div>
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
        // Toggle tower status
        const toggleButtons = document.querySelectorAll('.toggle-status');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const towerId = this.getAttribute('data-tower-id');
                
                // Send AJAX request to toggle status
                fetch(`/admin/towers/${towerId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload the page to show updated status
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endpush 