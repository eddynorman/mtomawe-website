<section>
    <header class="mb-3">
        <h2 class="h5">{{ __('Delete Account') }}</h2>
        <p class="text-body-secondary small mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button type="button" data-bs-toggle="modal" data-bs-target="#deleteUserModal">{{ __('Delete Account') }}</x-danger-button>

    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true" data-show-on-load="{{ $errors->userDeletion->isNotEmpty() ? '1' : '0' }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h2 class="modal-title h5" id="deleteUserModalLabel">{{ __('Confirm deletion') }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-body-secondary small">{{ __('Please enter your password to confirm you would like to permanently delete your account.') }}</p>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1" placeholder="{{ __('Password') }}" />
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>
                    <div class="modal-footer">
                        <x-secondary-button type="button" data-bs-dismiss="modal">{{ __('Cancel') }}</x-secondary-button>
                        <x-danger-button>{{ __('Delete Account') }}</x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
