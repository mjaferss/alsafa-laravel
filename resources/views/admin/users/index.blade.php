@extends('layouts.admin_new')

@section('title', __('users.list'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('users.list_title') }}</h5>
                @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-2"></i> {{ __('users.add_new') }}
                    </a>
                @endif
            </div>
            <div class="mt-3">
                <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="{{ __('users.fields.name') }} / {{ __('users.fields.email') }}" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="role" class="form-select">
                            <option value="">{{ __('users.fields.select_role') }}</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>{{ __('users.roles.admin') }}</option>
                            <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>{{ __('users.roles.manager') }}</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>{{ __('users.roles.user') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="branch_id" class="form-select">
                            <option value="">{{ __('users.fields.select_branch') }}</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">{{ __('common.search') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('users.fields.name') }}</th>
                            <th class="d-none d-lg-table-cell">{{ __('users.fields.email') }}</th>
                            <th>{{ __('users.fields.role') }}</th>
                            <th class="d-none d-lg-table-cell">{{ __('users.fields.branch') }}</th>
                            <th>{{ __('users.fields.active') }}</th>
                            <th class="d-none d-md-table-cell">{{ __('users.fields.created_at') }}</th>
                            <th class="text-center">{{ __('common.action_text') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="d-none d-lg-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $user->email }}</p>
                            </td>
                            <td>
                                <p class="text-sm font-weight-bold mb-0">{{ __('users.roles.' . $user->role) }}</p>
                            </td>
                            <td class="d-none d-lg-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $user->branch?->name ?? '-' }}</p>
                            </td>
                            <td>
                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $user->is_active ? __('users.status.active') : __('users.status.inactive') }}
                                </span>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $user->created_at->format('Y-m-d') }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-icon-only text-dark mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user->id }}">
                                                <i class="fas fa-eye me-2"></i> {{ __('users.actions.view') }}
                                            </a>
                                        </li>
                                        @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}">
                                                    <i class="fas fa-edit me-2"></i> {{ __('users.actions.edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('{{ __('users.confirm_delete') }}')">
                                                        <i class="fas fa-trash me-2"></i> {{ __('users.actions.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <button type="button" class="btn {{ $user->is_active ? 'btn-secondary' : 'btn-success' }} btn-sm toggle-status" data-user-id="{{ $user->id }}" data-status="{{ $user->is_active ? 1 : 0 }}" title="{{ $user->is_active ? __('users.status.inactive') : __('users.status.active') }}">
                                    <i class="fas {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- View User Modal -->
                        <div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="viewUserModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewUserModalLabel{{ $user->id }}">{{ __('users.profile') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                                            <div class="card card-body">
                                                <div class="row gx-4">
                                                    <div class="col-auto">
                                                        <div class="avatar avatar-xl position-relative">
                                                            @if($user->avatar)
                                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-100 border-radius-lg shadow-sm">
                                                            @else
                                                                <div class="avatar-title rounded-circle bg-primary text-white">
                                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <div class="h-100">
                                                            <h5 class="mb-1">{{ $user->name }}</h5>
                                                            <p class="mb-0 font-weight-bold text-sm">{{ __('users.roles.' . $user->role) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.email') }}</label>
                                                            <p class="form-control-static">{{ $user->email }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.phone') }}</label>
                                                            <p class="form-control-static">{{ $user->phone ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.role') }}</label>
                                                            <p class="form-control-static">{{ __('users.roles.' . $user->role) }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.branch') }}</label>
                                                            <p class="form-control-static">{{ $user->branch?->name ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.created_at') }}</label>
                                                            <p class="form-control-static">{{ $user->created_at->format('Y-m-d H:i') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.updated_at') }}</label>
                                                            <p class="form-control-static">{{ $user->updated_at->format('Y-m-d H:i') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.last_login') }}</label>
                                                            <p class="form-control-static">{{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i') : '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.password_changed') }}</label>
                                                            <p class="form-control-static">{{ $user->password_changed_at ? $user->password_changed_at->format('Y-m-d H:i') : '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('users.fields.active') }}</label>
                                                            <p class="form-control-static">
                                                                <span class="badge {{ $user->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                                    {{ $user->is_active ? __('users.status.active') : __('users.status.inactive') }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                {{ __('users.unauthorized_access') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.toggle-status').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const currentStatus = this.dataset.status;
            
            fetch(`/admin/users/${userId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update button appearance
                    this.classList.toggle('btn-secondary');
                    this.classList.toggle('btn-success');
                    
                    // Update icon
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-ban');
                    icon.classList.toggle('fa-check');
                    
                    // Update status badge
                    const statusBadge = this.closest('tr').querySelector('.badge');
                    statusBadge.classList.toggle('bg-success');
                    statusBadge.classList.toggle('bg-danger');
                    statusBadge.textContent = currentStatus == 1 
                        ? '{{ __("users.status.inactive") }}'
                        : '{{ __("users.status.active") }}';
                    
                    // Update data attribute
                    this.dataset.status = currentStatus == 1 ? '0' : '1';
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: '{{ __("common.success") }}',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("common.error") }}',
                    text: '{{ __("common.something_went_wrong") }}'
                });
            });
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
