@extends('layouts.admin')

@section('title', __('towers.show'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('towers.details') }}</h5>
                <div>
                    @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                        <a href="{{ route('admin.towers.edit', $tower) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-2"></i>{{ __('towers.actions.edit') }}
                        </a>
                    @endif
                    <a href="{{ route('admin.towers.index') }}" class="btn btn-light btn-sm ms-2">
                        <i class="fas fa-arrow-left me-2"></i>{{ __('common.back') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">{{ __('towers.basic_info') }}</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between px-0 pt-0">
                                    <span class="text-sm">{{ __('towers.fields.name_ar') }}</span>
                                    <span class="text-sm font-weight-bold">{{ $tower->name_ar }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-sm">{{ __('towers.fields.name_en') }}</span>
                                    <span class="text-sm font-weight-bold">{{ $tower->name_en }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-sm">{{ __('towers.fields.branch') }}</span>
                                    <span class="text-sm font-weight-bold">
                                        {{ app()->getLocale() == 'ar' ? $tower->branch->name_ar : $tower->branch->name_en }}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-sm">{{ __('towers.fields.status') }}</span>
                                    <span class="badge badge-sm bg-gradient-{{ $tower->status === 'active' ? 'success' : ($tower->status === 'under_maintenance' ? 'warning' : 'danger') }}">
                                    <span class="badge {{ $tower->is_active ? 'bg-success' : 'bg-danger' }}">
    {{ $tower->is_active ? __('common.active') : __('common.inactive') }}
</span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">{{ __('towers.structure_info') }}</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between px-0 pt-0">
                                    <span class="text-sm">{{ __('towers.fields.floors_count') }}</span>
                                    <span class="text-sm font-weight-bold">{{ $tower->floors_count }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-sm">{{ __('towers.fields.apartments_per_floor') }}</span>
                                    <span class="text-sm font-weight-bold">{{ $tower->apartments_per_floor }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-sm">{{ __('towers.fields.total_apartments') }}</span>
                                    <span class="text-sm font-weight-bold">{{ $tower->floors_count * $tower->apartments_per_floor }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">{{ __('towers.description') }}</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-sm mb-2">{{ __('towers.fields.description_ar') }}</h6>
                                    <p class="text-sm mb-4">{{ $tower->description_ar ?: __('common.not_available') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-sm mb-2">{{ __('towers.fields.description_en') }}</h6>
                                    <p class="text-sm">{{ $tower->description_en ?: __('common.not_available') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 