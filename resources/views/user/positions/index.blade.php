<x-layouts.app :title="__('Manage Positions')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Positions') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Browse open positions') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

	<x-session-message />

	@if ($positions->count())
		<div class="overflow-x-auto">
			<table class="w-full">
				<thead>
					<tr class="bg-gray-200">
						<th class="py-2 px-4 border-b text-left">{{ __('Title') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Created At') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Applicants') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($positions as $position)
					<tr class="hover:bg-gray-100">
						<td class="py-2 px-4 border-b">{{ $position->title }}</td>
						<td class="py-2 px-4 border-b">{{ $position->created_at->format('F j, Y, g:i a') }}</td>
						<td class="py-2 px-4 border-b">{{ $position->applications->count() }} / {{ $position->max_applicants }}</td>
						<td class="py-2 px-4 border-b">
							<div class="flex space-x-2">
								<a href="{{ route('user.positions.details', $position->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">{{ __('View') }}</a>
								@if ($position->applications->count() < $position->max_applicants && !$position->applications()->where('user_id', auth()->id())->exists())
                                    <form action="{{ route('user.positions.apply', $position->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to apply to this position?')">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded cursor-pointer">{{ __('Apply') }}</button>
                                    </form>
                                @endif
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<p class="mt-4">{{ __('No positions available.') }}</p>
	@endif
</x-layouts.app>
