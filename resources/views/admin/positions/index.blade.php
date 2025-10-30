<x-layouts.app :title="__('Manage Positions')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Positions') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage positions and applications') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

	<x-session-message />
	
	<a href="{{ route('admin.positions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-3 inline-block">{{ __('Add Position') }}</a>

	@if ($positions->count())
		<div class="overflow-x-auto">
			<table class="w-full mt-5">
				<thead>
					<tr class="bg-gray-200">
						<th class="py-2 px-4 border-b text-left">{{ __('Title') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Created At') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Status') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Applicants') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($positions as $position)
					<tr class="hover:bg-gray-100">
						<td class="py-2 px-4 border-b">{{ $position->title }}</td>
						<td class="py-2 px-4 border-b">{{ $position->created_at->format('F j, Y, g:i a') }}</td>
						<td class="py-2 px-4 border-b">{{ $position->status }}</td>
						<td class="py-2 px-4 border-b">{{ $position->applications->count() }} / {{ $position->max_applicants }}</td>
						<td class="py-2 px-4 border-b">
							<div class="flex space-x-2">
								<a href="{{ route('admin.positions.show', $position->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">{{ __('View Applications') }}</a>
								<a href="{{ route('admin.positions.edit', $position->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">{{ __('Edit') }}</a>
								<form action="{{ route('admin.positions.destroy', $position->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this position?')">
									@csrf
									@method('DELETE')
									<button type="submit" class="bg-red-500 text-white px-2 py-1 rounded cursor-pointer">{{ __('Delete') }}</button>
								</form>
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
