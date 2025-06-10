@extends('layouts.admin')

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
        <x-stats-card
            title="{{ __('dashboard.total_users') }}"
            value="{{ $statistics['users'] ?? 0 }}"
            icon="users"
            color="primary"
            route="{{ route('admin.users.index') }}"
        />

        <x-stats-card
            title="{{ __('dashboard.total_branches') }}"
            value="{{ $statistics['branches'] ?? 0 }}"
            icon="code-branch"
            color="success"
            route="{{ route('admin.branches.index') }}"
        />

        <x-stats-card
            title="{{ __('dashboard.total_towers') }}"
            value="{{ $statistics['towers'] ?? 0 }}"
            icon="city"
            color="info"
            route="{{ route('admin.towers.index') }}"
        />

        <x-stats-card
            title="{{ __('dashboard.recent_activities') }}"
            value="{{ $statistics['activities'] ?? 0 }}"
            icon="chart-line"
            color="warning"
            route="#activities"
        />
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
                                            <div class="avatar avatar-sm me-2 rounded-circle bg-primary text-white">
                                                {{ strtoupper(substr($activity->user->name ?? __('activity.system'), 0, 1)) }}
                                            </div>
                                            <span>{{ $activity->user->name ?? __('activity.system') }}</span>
                                        </div>
                                    </td>
                                    <td>{{ __('activity.actions.' . $activity->action) }}</td>
                                    <td>{{ __('models.' . $activity->model_type) }}</td>
                                    <td>{{ $activity->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
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