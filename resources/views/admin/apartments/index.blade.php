@extends('layouts.admin')

@section('title', __('apartments.list'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('apartments.list_title') }}</h5>
                @can('create', App\Models\Apartment::class)
                    <a href="{{ route('admin.apartments.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
                        <i class="fas fa-plus me-2"></i> {{ __('apartments.add_new') }}
                    </a>
                @endcan
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
                        <button type="submit" class="btn bg-gradient-info w-100 mb-0">
                            <i class="fas fa-search me-2"></i> {{ __('common.search') }}
                        </button>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('admin.apartments.index') }}" class="btn bg-gradient-secondary w-100 mb-0">
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
                            <td>
                                <div class="d-flex px-2">
                                    <div>
                                        <h6 class="mb-0 text-sm">{{ $apartment->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-sm font-weight-bold mb-0">
                                    {{ app()->getLocale() == 'ar' ? $apartment->tower->name_ar : $apartment->tower->name_en }}
                                </p>
                            </td>
                            <td>
                                <p class="text-sm font-weight-bold mb-0">
                                    {{ app()->getLocale() == 'ar' ? $apartment->type->name_ar : $apartment->type->name_en }}
                                </p>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $apartment->floor_number }}</p>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $apartment->cost }}</p>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $apartment->created_at->format('Y-m-d') }}</p>
                            </td>
                            <td class="align-middle text-center">
                                <div class="ms-auto">
                                    <button class="btn btn-link text-dark px-3 mb-0" type="button" id="dropdownMenuButton{{ $apartment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton{{ $apartment->id }}">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewApartmentModal{{ $apartment->id }}">
                                                <i class="fas fa-eye me-2"></i> {{ __('apartments.actions.view') }}
                                            </a>
                                        </li>
                                        @can('update', $apartment)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.apartments.edit', $apartment) }}">
                                                    <i class="fas fa-edit me-2"></i> {{ __('apartments.actions.edit') }}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('delete', $apartment)
                                            <li>
                                                <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('{{ __('apartments.confirmations.delete') }}')">
                                                        <i class="fas fa-trash me-2"></i> {{ __('apartments.actions.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endcan
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
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.name') }}</label>
                                                            <p class="text-sm">{{ $apartment->name }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.tower') }}</label>
                                                            <p class="text-sm">
                                                                {{ app()->getLocale() == 'ar' ? $apartment->tower->name_ar : $apartment->tower->name_en }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.type') }}</label>
                                                            <p class="text-sm">
                                                                {{ app()->getLocale() == 'ar' ? $apartment->type->name_ar : $apartment->type->name_en }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.floor_number') }}</label>
                                                            <p class="text-sm">{{ $apartment->floor_number }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.cost') }}</label>
                                                            <p class="text-sm">{{ $apartment->cost }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.created_at') }}</label>
                                                            <p class="text-sm">{{ $apartment->created_at->format('Y-m-d H:i') }}</p>
                                                        </div>
                                                    </div>

                                                    <!-- Beneficiary Information -->
                                                    <div class="col-12 mt-4">
                                                        <h6 class="mb-3">{{ __('apartments.beneficiary_info') }}</h6>
                                                        <hr class="horizontal dark my-3">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.beneficiary_type') }}</label>
                                                            <p class="text-sm">
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
                                                            <label class="form-control-label h6">{{ __('apartments.fields.beneficiary_id') }}</label>
                                                            <p class="text-sm">{{ $apartment->beneficiary_id ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.beneficiary_name_ar') }}</label>
                                                            <p class="text-sm">{{ $apartment->beneficiary_name_ar ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.beneficiary_name_en') }}</label>
                                                            <p class="text-sm">{{ $apartment->beneficiary_name_en ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.beneficiary_mobile') }}</label>
                                                            <p class="text-sm">{{ $apartment->beneficiary_mobile ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label h6">{{ __('apartments.fields.beneficiary_email') }}</label>
                                                            <p class="text-sm">{{ $apartment->beneficiary_email ?? '-' }}</p>
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
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-sm mb-0">{{ __('common.no_records') }}</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($apartments->hasPages())
                <div class="card-footer py-3">
                    {{ $apartments->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 