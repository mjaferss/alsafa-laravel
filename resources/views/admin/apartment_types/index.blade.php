@extends('layouts.admin')

@section('title', __('apartment_types.list'))

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">{{ __('apartment_types.list_title') }}</h5>
                        @can('create', App\Models\ApartmentType::class)
                            <a href="{{ route('admin.apartment-types.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-2"></i> {{ __('apartment_types.add_new') }}
                            </a>
                        @endcan
                    </div>

                    <!-- Advanced Search Form -->
                    <form action="{{ route('admin.apartment-types.index') }}" method="GET" class="row g-3">
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
                            <select class="form-select" name="is_active" aria-label="{{ __('apartment_types.fields.status') }}">
                                <option value="">{{ __('apartment_types.fields.status') }}</option>
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
                            <a href="{{ route('admin.apartment-types.index') }}" class="btn btn-secondary w-100">
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
                                        {{ app()->getLocale() == 'ar' ? __('apartment_types.fields.name_ar') : __('apartment_types.fields.name_en') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('apartment_types.fields.status') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 d-none d-md-table-cell">
                                        {{ __('apartment_types.fields.created_at') }}
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        {{ __('common.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($types as $type)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm {{ $type->is_active ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                            {{ $type->is_active ? __('common.active') : __('common.inactive') }}
                                        </span>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <p class="text-sm mb-0">{{ $type->created_at->format('Y-m-d') }}</p>
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
                                                            data-bs-target="#viewTypeModal{{ $type->id }}">
                                                        <i class="fas fa-eye me-2"></i> {{ __('apartment_types.actions.view') }}
                                                    </button>
                                                </li>
                                                @can('update', $type)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.apartment-types.edit', $type) }}">
                                                        <i class="fas fa-edit me-2"></i> {{ __('apartment_types.actions.edit') }}
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('delete', $type)
                                                <li>
                                                    <form action="{{ route('admin.apartment-types.destroy', $type) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('{{ __('apartment_types.confirmations.delete') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash me-2"></i> {{ __('apartment_types.actions.delete') }}
                                                        </button>
                                                    </form>
                                                </li>
                                                @endcan
                                                @can('update', $type)
                                                <li>
                                                    <form action="{{ route('admin.apartment-types.toggle-status', $type) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas {{ $type->is_active ? 'fa-ban' : 'fa-check' }} me-2"></i>
                                                            {{ $type->is_active ? __('apartment_types.deactivate') : __('apartment_types.activate') }}
                                                        </button>
                                                    </form>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- View Type Modal -->
                                <div class="modal fade" 
                                     id="viewTypeModal{{ $type->id }}" 
                                     tabindex="-1" 
                                     aria-labelledby="viewTypeModalLabel{{ $type->id }}" 
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewTypeModalLabel{{ $type->id }}">
                                                    {{ __('apartment_types.details') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card card-body">
                                                    <div class="row gx-4">
                                                        <div class="col-auto">
                                                            <div class="avatar avatar-xl position-relative">
                                                                <div class="bg-gradient-primary rounded-circle h-100 w-100 d-flex align-items-center justify-content-center">
                                                                    <i class="fas fa-home text-white fa-2x"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto my-auto">
                                                            <div class="h-100">
                                                                <h5 class="mb-1">
                                                                    {{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('apartment_types.fields.name_ar') }}</label>
                                                                <p class="form-control-static">{{ $type->name_ar }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('apartment_types.fields.name_en') }}</label>
                                                                <p class="form-control-static">{{ $type->name_en }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('apartment_types.fields.status') }}</label>
                                                                <p class="form-control-static">
                                                                    <span class="badge {{ $type->is_active ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                                                        {{ $type->is_active ? __('common.active') : __('common.inactive') }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">{{ __('apartment_types.fields.created_at') }}</label>
                                                                <p class="form-control-static">{{ $type->created_at->format('Y-m-d H:i') }}</p>
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
                                    <td colspan="4" class="text-center py-4">
                                        <p class="mb-0">{{ __('common.no_records') }}</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $types->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 