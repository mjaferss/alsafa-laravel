<section class="space-y-6">
    <div class="text-muted mb-4">
        {{ __('profile.delete_warning') }}
    </div>

    <button type="button" 
            class="btn bg-gradient-danger" 
            data-bs-toggle="modal" 
            data-bs-target="#confirmUserDeletionModal">
        {{ __('profile.delete_button') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">{{ __('profile.delete_account') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="mb-3">{{ __('profile.delete_confirm') }}</p>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('profile.current_password') }}</label>
                            <input type="password" 
                                   class="form-control" 
                                   name="password" 
                                   id="password"
                                   placeholder="{{ __('profile.current_password') }}" 
                                   required />
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('profile.cancel') }}
                        </button>
                        <button type="submit" class="btn bg-gradient-danger">
                            {{ __('profile.delete_button') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
