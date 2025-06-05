@extends('layouts.admin_new')

@section('title', __('apartments.list'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('apartments.list_title') }}</h5>
                @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                    <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-2"></i> {{ __('apartments.add_new') }}
                    </a>
                @endif
            </div>
            <div class="mt-3">
                <form action="{{ route('admin.apartments.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="{{ __('common.search') }}" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="tower_id">
                            <option value="">{{ __('apartments.select_tower') }}</option>
                            @foreach($towers as $tower)
                                <option value="{{ $tower->id }}" {{ request('tower_id') == $tower->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $tower->name_ar : $tower->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="apartment_type_id">
                            <option value="">{{ __('apartments.select_type') }}</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ request('apartment_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">{{ __('common.search') }}</button>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-redo"></i>
                        </a>
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
                                {{ __('apartments.fields.name') }}
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                {{ __('apartments.fields.tower') }}
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                {{ __('apartments.fields.type') }}
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">
                                {{ __('apartments.fields.floor_number') }}
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">
                                {{ __('apartments.fields.cost') }}
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">
                                {{ __('apartments.fields.created_at') }}
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                {{ __('common.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($apartments as $apartment)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $apartment->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <p class="text-sm mb-0">
                                    {{ app()->getLocale() == 'ar' ? $apartment->tower->name_ar : $apartment->tower->name_en }}
                                </p>
                            </td>
                            <td class="align-middle">
                                <p class="text-sm mb-0">
                                    {{ app()->getLocale() == 'ar' ? $apartment->type->name_ar : $apartment->type->name_en }}
                                </p>
                            </td>
                            <td class="align-middle d-none d-md-table-cell">
                                <p class="text-sm mb-0">{{ $apartment->floor_number }}</p>
                            </td>
                            <td class="align-middle d-none d-md-table-cell">
                                <p class="text-sm mb-0">{{ $apartment->cost }}</p>
                            </td>
                            <td class="align-middle d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $apartment->created_at->format('Y-m-d') }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <div class="dropdown">
                                    <button class="btn btn-link text-secondary mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" style="position: absolute; z-index: 1000;">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewApartmentModal{{ $apartment->id }}">
                                                <i class="fas fa-eye me-2"></i> {{ __('apartments.actions.view') }}
                                            </a>
                                        </li>
                                        @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.apartments.edit', $apartment) }}">
                                                    <i class="fas fa-edit me-2"></i> {{ __('apartments.actions.edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('{{ __('apartments.confirmations.delete') }}')">
                                                        <i class="fas fa-trash me-2"></i> {{ __('apartments.actions.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- View Apartment Modal -->
                        <div class="modal fade" id="viewApartmentModal{{ $apartment->id }}" tabindex="-1" aria-labelledby="viewApartmentModalLabel{{ $apartment->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewApartmentModalLabel{{ $apartment->id }}">{{ __('apartments.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-body">
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.name') }}</label>
                                                        <p class="form-control-static">{{ $apartment->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.tower') }}</label>
                                                        <p class="form-control-static">
                                                            {{ app()->getLocale() == 'ar' ? $apartment->tower->name_ar : $apartment->tower->name_en }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.type') }}</label>
                                                        <p class="form-control-static">
                                                            {{ app()->getLocale() == 'ar' ? $apartment->type->name_ar : $apartment->type->name_en }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.floor_number') }}</label>
                                                        <p class="form-control-static">{{ $apartment->floor_number }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.cost') }}</label>
                                                        <p class="form-control-static">{{ $apartment->cost }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.created_at') }}</label>
                                                        <p class="form-control-static">{{ $apartment->created_at->format('Y-m-d H:i') }}</p>
                                                    </div>
                                                </div>

                                                <!-- بيانات المستفيد -->
                                                <div class="col-12 mt-4">
                                                    <h6 class="mb-3">{{ __('apartments.beneficiary_info') }}</h6>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.beneficiary_type') }}</label>
                                                        <p class="form-control-static">
                                                            @if($apartment->beneficiary_type)
                                                                {{ __('apartments.beneficiary_types.' . $apartment->beneficiary_type) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.beneficiary_id') }}</label>
                                                        <p class="form-control-static">{{ $apartment->beneficiary_id ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.beneficiary_name_ar') }}</label>
                                                        <p class="form-control-static">{{ $apartment->beneficiary_name_ar ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.beneficiary_name_en') }}</label>
                                                        <p class="form-control-static">{{ $apartment->beneficiary_name_en ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.beneficiary_mobile') }}</label>
                                                        <p class="form-control-static">{{ $apartment->beneficiary_mobile ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('apartments.fields.beneficiary_email') }}</label>
                                                        <p class="form-control-static">{{ $apartment->beneficiary_email ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="mb-0">{{ __('common.no_records') }}</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($apartments->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $apartments->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .dropdown-menu {
        min-width: 10rem;
        max-width: none;
        transform: none !important;
        left: auto !important;
        right: 0 !important;
        top: 100% !important;
        margin-top: 0.125rem !important;
    }
    .table-responsive {
        overflow: visible !important;
    }
</style>
@endpush

@endsection 