@extends('layouts.admin_new')

@section('title', __('sections.list'))

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('sections.list_title') }}</h5>
                @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                    <a href="{{ route('admin.sections.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-2"></i> {{ __('sections.add_new') }}
                    </a>
                @endif
            </div>
            <div class="mt-3">
                <form action="{{ route('admin.sections.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" placeholder="{{ __('common.search') }}" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="is_active">
                            <option value="">{{ __('sections.fields.status') }}</option>
                            <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>{{ __('common.active') }}</option>
                            <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>{{ __('common.inactive') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">{{ __('common.search') }}</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary w-100">{{ __('common.reset') }}</a>
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
                                {{ app()->getLocale() == 'ar' ? __('sections.fields.name_ar') : __('sections.fields.name_en') }}
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('sections.fields.cost') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('sections.fields.status') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">{{ __('sections.fields.created_at') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">{{ __('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sections as $section)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">
                                            {{ app()->getLocale() == 'ar' ? $section->name_ar : $section->name_en }}
                                        </h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <p class="text-sm font-weight-bold mb-0">{{ number_format($section->cost, 2) }}</p>
                            </td>
                            <td class="align-middle">
                                <span class="badge {{ $section->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $section->is_active ? __('common.active') : __('common.inactive') }}
                                </span>
                            </td>
                            <td class="align-middle d-none d-md-table-cell">
                                <p class="text-sm font-weight-bold mb-0">{{ $section->created_at->format('Y-m-d') }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-icon-only text-dark mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewSectionModal{{ $section->id }}">
                                                <i class="fas fa-eye me-2"></i> {{ __('sections.actions.view') }}
                                            </a>
                                        </li>
                                        @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.sections.edit', $section) }}">
                                                    <i class="fas fa-edit me-2"></i> {{ __('sections.actions.edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('{{ __('sections.confirmations.delete') }}')">
                                                        <i class="fas fa-trash me-2"></i> {{ __('sections.actions.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.sections.toggle-status', $section) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas {{ $section->is_active ? 'fa-ban' : 'fa-check' }} me-2"></i>
                                                        {{ $section->is_active ? __('sections.deactivate') : __('sections.activate') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- View Section Modal -->
                        <div class="modal fade" id="viewSectionModal{{ $section->id }}" tabindex="-1" aria-labelledby="viewSectionModalLabel{{ $section->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewSectionModalLabel{{ $section->id }}">{{ __('sections.details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
                                            <div class="card card-body">
                                                <div class="row gx-4">
                                                    <div class="col-auto my-auto">
                                                        <div class="h-100">
                                                            <h5 class="mb-1">{{ app()->getLocale() == 'ar' ? $section->name_ar : $section->name_en }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('sections.fields.name_ar') }}</label>
                                                            <p class="form-control-static">{{ $section->name_ar }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('sections.fields.name_en') }}</label>
                                                            <p class="form-control-static">{{ $section->name_en }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('sections.fields.cost') }}</label>
                                                            <p class="form-control-static">{{ number_format($section->cost, 2) }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('sections.fields.status') }}</label>
                                                            <p class="form-control-static">
                                                                <span class="badge {{ $section->is_active ? 'bg-success' : 'bg-danger' }}">
                                                                    {{ $section->is_active ? __('common.active') : __('common.inactive') }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('sections.fields.created_by') }}</label>
                                                            <p class="form-control-static">{{ $section->creator->name }}</p>
                                                        </div>
                                                    </div>
                                                    @if($section->updater)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('sections.fields.updated_by') }}</label>
                                                            <p class="form-control-static">{{ $section->updater->name }}</p>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('sections.fields.created_at') }}</label>
                                                            <p class="form-control-static">{{ $section->created_at->format('Y-m-d H:i') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{ __('sections.fields.updated_at') }}</label>
                                                            <p class="form-control-static">{{ $section->updated_at->format('Y-m-d H:i') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                {{ __('sections.unauthorized_access') }}
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
                    {{ $sections->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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