@extends('layouts.admin_new')

@section('title', __('dashboard.title'))

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body p-4">
                    <h1 class="display-5 fw-bold">{{ __('dashboard.welcome', ['name' => auth()->user()->name]) }}</h1>
                    <p class="lead">{{ __('dashboard.welcome_message') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="row g-4 mb-4">
        <!-- Users Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <div class="fs-4 me-2"><i class="fas fa-users text-primary"></i></div>
                            <h6 class="card-title mb-0">{{ __('dashboard.total_users') }}</h6>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('users.index') }}">{{ __('common.view_all') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="mb-0">{{ $statistics['users'] ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- Branches Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <div class="fs-4 me-2"><i class="fas fa-code-branch text-success"></i></div>
                            <h6 class="card-title mb-0">{{ __('dashboard.total_branches') }}</h6>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('branches.index') }}">{{ __('common.view_all') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="mb-0">{{ $statistics['branches'] ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- Towers Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <div class="fs-4 me-2"><i class="fas fa-city text-info"></i></div>
                            <h6 class="card-title mb-0">{{ __('dashboard.total_towers') }}</h6>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('towers.index') }}">{{ __('common.view_all') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="mb-0">{{ $statistics['towers'] ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- Activities Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <div class="fs-4 me-2"><i class="fas fa-chart-line text-warning"></i></div>
                            <h6 class="card-title mb-0">{{ __('dashboard.recent_activities') }}</h6>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#activities">{{ __('common.view_all') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="mb-0">{{ $statistics['activities'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('dashboard.recent_activities') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('activity.user') }}</th>
                                    <th>{{ __('activity.action') }}</th>
                                    <th>{{ __('activity.model') }}</th>
                                    <th>{{ __('activity.date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentActivities ?? [] as $activity)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span>{{ __('menu.maintenance') }}</span>ded-circle bg-primary">
                                                    {{ strtoupper(substr($activity->user->name ?? __('activity.system'), 0, 1)) }}
                                                </div>
                                            </div>
                                            <span>{{ __('menu.activities') }}</span>name ?? __('activity.system') }}</div>
                                        </div>
                                    </td>
                                    <td>{{ __('activity.actions.'.$activity->action) }}</td>
                                    <td>{{ __('models.'.$activity->model_type) }}</td>
                                    <td>{{ $activity->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <span>{{ __('nav.dashboard') }}</span>="4" class="text-center py-4">
                                        <div class="text-muted">{{ __('activity.no_records') }}</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
    // Initialize any dashboard-specific JavaScript here
});
</script>
@endpush
