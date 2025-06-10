@extends('layouts.admin')

@section('title', __('profile.edit_profile'))

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 bg-gradient-primary">
                    <h6 class="text-white">{{ __('profile.profile_information') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="p-4">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header pb-0 bg-gradient-info">
                    <h6 class="text-white">{{ __('profile.update_password') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="p-4">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header pb-0 bg-gradient-danger">
                    <h6 class="text-white">{{ __('profile.delete_account') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="p-4">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
    }
    .card-header {
        border-radius: 0.75rem 0.75rem 0 0;
        padding: 1.5rem;
    }
    .card-body {
        padding: 0;
    }
    .form-control:focus {
        border-color: #5e72e4;
        box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
    }
    .btn-primary {
        background-color: #5e72e4;
        border-color: #5e72e4;
    }
    .btn-primary:hover {
        background-color: #324cdd;
        border-color: #324cdd;
    }
    .btn-danger {
        background-color: #f5365c;
        border-color: #f5365c;
    }
    .btn-danger:hover {
        background-color: #ec0c38;
        border-color: #ec0c38;
    }
    .text-danger {
        color: #f5365c !important;
    }
</style>
@endpush
@endsection
