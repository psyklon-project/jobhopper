<x-layouts.app :title="__('Manage Positions')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Position Details') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ $position->title }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

	<x-session-message />

	<p class="mb-4"><strong>{{ __('Job description') }}:</strong></p>
	<p class="mb-4">{{ $position->description }}</p>
	
	@if ($position->applications->count() < $position->max_applicants && !$position->applications()->where('user_id', auth()->id())->exists())
		<form action="{{ route('user.positions.apply', $position->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to apply to this position?')">
			@csrf
			@method('POST')
			<button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">{{ __('Apply') }}</button>
		</form>
	@endif
</x-layouts.app>
