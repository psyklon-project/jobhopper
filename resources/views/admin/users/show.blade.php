<x-layouts.app :title="__('View User')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('View User') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ $user->name }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

	<div class="space-y-4">
		<table class="m-0 border-collapse">
			<tbody>
				<tr>
					@if($user->profile_picture)
						<td class="pe-4 py-2" style="vertical-align:top"><img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="object-cover rounded-full" style="min-width:200px;max-width:200px;min-height:200px;max-height:200px"></td>
						<td class="ps-4" style="vertical-align:top">
					@else
						<td style="vertical-align:top">
					@endif
						<p class="py-2"><strong>{{ __('Name') }}:</strong> {{ $user->name }}</p>
						<p class="py-2"><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
						<p class="py-2"><strong>{{ __('Registered At') }}:</strong> {{ $user->created_at->format('F j, Y, g:i a') }}</p>
						<p class="py-2"><strong>{{ __('Bio') }}:</strong><br>{{ $user->bio ?? __('N/A') }}</p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

</x-layouts.app>
