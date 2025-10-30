<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
	use \Livewire\WithFileUploads;

    public string $name = '';
    public string $email = '';
	public string $bio = '';
	public string $profilePicture = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
		$user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
		$this->bio = $user->bio ?? '';
		$this->profilePicture = $user->profile_picture ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],

			'bio' => ['nullable', 'string'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

	/**
	 * Handle the profile picture upload.
	 */
	public function updatedProfilePicture($value)
	{
		$user = Auth::user();
    	$oldProfilePicture = $user->profile_picture;

		$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
		$extension = $value->getClientOriginalExtension();
		if (!in_array($extension, $allowedExtensions)) {
			throw new \Illuminate\Validation\ValidationException(
				'profilePicture',
				__('The profile picture must be a file of type: :types.', ['types' => implode(', ', $allowedExtensions)])
			);
		}

		$path = $value->store('profile_pictures', 'public');

		if ($oldProfilePicture) {
			$oldFilePath = public_path('storage/' . $oldProfilePicture);
			if (file_exists($oldFilePath)) {
				unlink($oldFilePath);
			}
		}

		$user = Auth::user();
		$user->profile_picture = $path;
		$user->save();
	}

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6" enctype="multipart/form-data">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

			<div>
				<flux:input wire:model="profilePicture" :label="__('Profile Picture')" type="file" accept="image/*" />
				@error('profilePicture') <span class="text-red-500">{{ $message }}</span> @enderror
			</div>

			<div>
				<flux:textarea wire:model="bio" :label="__('Bio')" rows="4" />
			</div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full" data-test="update-profile-button">
                        {{ __('Save') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
