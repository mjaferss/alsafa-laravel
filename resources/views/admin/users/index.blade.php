@extends('layouts.admin')

@section('title', __('users.list'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('users.list_title') }}</h5>
                @can('create', App\Models\User::class)
                    <a href="{{ route('admin.users.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
                        <i class="fas fa-plus me-2"></i> {{ __('users.add_new') }}
                    </a>
                @endcan
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
                        <button type="submit" class="btn bg-gradient-info w-100 mb-0">
                            <i class="fas fa-search me-2"></i> {{ __('common.search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('users.fields.name') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-lg-table-cell">{{ __('users.fields.email') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('users.fields.role') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-lg-table-cell">{{ __('users.fields.branch') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('users.fields.active') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">{{ __('users.fields.created_at') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">{{ __('common.action_text') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <div>
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
                                <span class="badge badge-sm {{ $user->is_active ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                    {{ $user->is_active ? __('users.status.active') : __('users.status.inactive') }}
                                </span>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $user->created_at->format('Y-m-d') }}</p>
                            </td>
                            <td class="align-middle text-center">
                                <div class="ms-auto">
                                    <button class="btn btn-link text-dark px-3 mb-0" type="button" id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton{{ $user->id }}">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user->id }}">
                                                <i class="fas fa-eye me-2"></i> {{ __('users.actions.view') }}
                                            </a>
                                        </li>
                                        @if(auth()->user()->role === 'super_admin' || (auth()->user()->role === 'manager' && $user->role !== 'super_admin'))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}">
                                                    <i class="fas fa-edit me-2"></i> {{ __('users.actions.edit') }}
                                                </a>
                                            </li>
                                        @endif
                                        @if(auth()->user()->role === 'super_admin' || (auth()->user()->role === 'manager' && $user->role !== 'super_admin' && $user->role !== 'manager'))
                                            <li>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('{{ __('users.confirm_delete') }}')">
                                                        <i class="fas fa-trash me-2"></i> {{ __('users.actions.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                @can('update', $user)
                                    <button type="button" class="btn btn-link {{ $user->is_active ? 'text-danger' : 'text-success' }} mb-0 px-3" 
                                            onclick="toggleUserStatus({{ $user->id }}, {{ $user->is_active ? 1 : 0 }})"
                                            title="{{ $user->is_active ? __('users.status.inactive') : __('users.status.active') }}">
                                        <i class="fas {{ $user->is_active ? 'fa-ban' : 'fa-check' }} text-xs"></i>
                                    </button>
                                @endcan
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
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row gx-4">
                                                    <div class="col-auto">
                                                        <div class="avatar avatar-xl position-relative">
                                                            @if($user->avatar)
                                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-100 border-radius-lg shadow-sm">
                                                            @else
                                                                <div class="avatar-title rounded-circle bg-gradient-primary text-white">
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
                                                            <label class="form-control-label h6">{{ __('users.fields.email') }}</label>
                                                            <p class="text-sm">{{ $user->email }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('users.fields.phone') }}</label>
                                                            <p class="text-sm">{{ $user->phone ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('users.fields.role') }}</label>
                                                            <p class="text-sm">{{ __('users.roles.' . $user->role) }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('users.fields.branch') }}</label>
                                                            <p class="text-sm">{{ $user->branch?->name ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('users.fields.created_at') }}</label>
                                                            <p class="text-sm">{{ $user->created_at->format('Y-m-d H:i') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('users.fields.updated_at') }}</label>
                                                            <p class="text-sm">{{ $user->updated_at->format('Y-m-d H:i') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('users.fields.last_login') }}</label>
                                                            <p class="text-sm">{{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i') : '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('users.fields.password_changed') }}</label>
                                                            <p class="text-sm">{{ $user->password_changed_at ? $user->password_changed_at->format('Y-m-d H:i') : '-' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="card-footer py-3">
                    <nav aria-label="{{ __('pagination.pages') }}">
                        <ul class="pagination justify-content-center mb-0">
                            {{-- Previous Page Link --}}
                            @if($users->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link bg-transparent border-0" aria-hidden="true">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link bg-transparent border-0" href="{{ $users->previousPageUrl() }}" rel="prev">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                @if($page == $users->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link bg-gradient-primary border-0">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link bg-transparent border-0" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if($users->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link bg-transparent border-0" href="{{ $users->nextPageUrl() }}" rel="next">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link bg-transparent border-0" aria-hidden="true">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    <p class="text-sm text-center text-secondary mt-2 mb-0">
                        {{ __('pagination.showing') }} {{ $users->firstItem() }}-{{ $users->lastItem() }} {{ __('pagination.of') }} {{ $users->total() }} {{ __('pagination.entries') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
console.log('Loading users index script...');

// Initialize dropdowns
document.addEventListener('DOMContentLoaded', function() {
    var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl)
    });
});

// Toggle user status function
function toggleUserStatus(userId, currentStatus) {
    if (confirm(currentStatus ? '{{ __("users.confirm_deactivate") }}' : '{{ __("users.confirm_activate") }}')) {
        fetch(`{{ url('admin/users') }}/${userId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('{{ __("common.error_occurred") }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('{{ __("common.error_occurred") }}');
        });
    }
}
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
    .pagination .page-link {
        padding: 0.5rem 0.75rem;
        margin: 0 3px;
        color: #67748e;
        transition: all 0.2s ease;
        border-radius: 0.5rem;
    }
    
    .pagination .page-link:hover {
        background-color: #e9ecef;
        color: #344767;
    }

    .pagination .page-item.active .page-link {
        color: #fff;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.125);
    }

    .pagination .page-item.disabled .page-link {
        color: #d3d3d3;
    }

    @media (max-width: 768px) {
        .pagination {
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
        }
    }
</style>
@endpush
