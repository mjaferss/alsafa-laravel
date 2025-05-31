@extends('layouts.admin_new')

@section('title', __('branches.list'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('branches.list_title') }}</h5>
                @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                    <a href="{{ route('branches.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-2"></i> {{ __('branches.add_new') }}
                    </a>
                @endif
            </div>
            <div class="mt-3">
                <form action="{{ route('branches.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="{{ __('common.search') }}" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="status">
                            <option value="">{{ __('branches.fields.active') }}</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>{{ __('branches.status.active') }}</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>{{ __('branches.status.inactive') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">{{ __('common.search') }}</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('branches.index') }}" class="btn btn-secondary w-100">{{ __('common.reset') }}</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                {{ app()->getLocale() == 'ar' ? __('branches.fields.name_ar') : __('branches.fields.name_en') }}
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">{{ __('branches.fields.phone') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('branches.fields.active') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">{{ __('branches.fields.created_at') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">{{ __('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($branches as $branch)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">
                                            {{ app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en }}
                                        </h6>
                                        <p class="text-xs text-secondary mb-0 d-md-none">
                                            {{ $branch->phone }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $branch->phone }}</p>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-sm {{ $branch->is_active ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                    {{ $branch->is_active ? __('branches.status.active') : __('branches.status.inactive') }}
                                </span>
                            </td>
                            <td class="align-middle d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $branch->created_at->format('Y-m-d') }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-icon-only text-dark mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewBranchModal{{ $branch->id }}">
                                                <i class="fas fa-eye me-2"></i> {{ __('branches.actions.view') }}
                                            </a>
                                        </li>
                                        @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('branches.edit', $branch) }}">
                                                    <i class="fas fa-edit me-2"></i> {{ __('branches.actions.edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('branches.destroy', $branch) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('{{ __('branches.confirmations.delete') }}')">
                                                        <i class="fas fa-trash me-2"></i> {{ __('branches.actions.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                                    <button type="button" class="btn {{ $branch->is_active ? 'btn-secondary' : 'btn-success' }} btn-sm toggle-status" data-branch-id="{{ $branch->id }}" data-status="{{ $branch->is_active ? 1 : 0 }}" title="{{ $branch->is_active ? __('branches.status.inactive') : __('branches.status.active') }}">
                                        <i class="fas {{ $branch->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <!-- View Branch Modal -->
                        <div class="modal fade" id="viewBranchModal{{ $branch->id }}" tabindex="-1" aria-labelledby="viewBranchModalLabel{{ $branch->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewBranchModalLabel{{ $branch->id }}">{{ __('branches.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                                            <div class="card card-body">
                                                <div class="row gx-4">
                                                    <div class="col-auto my-auto">
                                                        <div class="h-100">
                                                            <h5 class="mb-1">{{ app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en }}</h5>
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('branches.fields.active') }}</label>
                                                            <p class="form-control-static">
                                                                <span class="badge {{ $branch->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                                    {{ $branch->is_active ? __('branches.status.active') : __('branches.status.inactive') }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                {{ __('branches.unauthorized_access') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.close') }}</button>
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
                    {{ $branches->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle branch status
        const toggleButtons = document.querySelectorAll('.toggle-status');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const branchId = this.getAttribute('data-branch-id');
                const status = this.getAttribute('data-status');
                
                // Send AJAX request to toggle status
                fetch(`/branches/${branchId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: status })
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
