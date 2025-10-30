<x-layouts.app :title="__('View Applications')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('View Applications') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ $position->title }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

	<x-session-message />

	@if ($position->applications->count())
		<div class="overflow-x-auto">
			<table class="w-full">
				<thead>
					<tr class="bg-gray-200">
						<th class="py-2 px-4 border-b text-left">{{ __('User') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Applied At') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Status') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($position->applications as $application)
					<tr class="hover:bg-gray-100">
						<td class="py-2 px-4 border-b">{{ $application->user->name }}</td>
						<td class="py-2 px-4 border-b">{{ $application->created_at->format('F j, Y, g:i a') }}</td>
						<td class="py-2 px-4 border-b">
							<x-application-status :status="$application->status" />
						</td>
						<td class="py-2 px-4 border-b">
							<div class="flex space-x-2">
								<a href="{{ route('admin.users.show', $application->user->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">{{ __('View User') }}</a>
								@if($application->status === 'pending')
									<form action="{{ route('admin.applications.accept', $application->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to accept this application?')">
										@csrf
										<button type="submit" class="bg-green-500 text-white px-2 py-1 rounded cursor-pointer">{{ __('Accept') }}</button>
									</form>
									<form action="{{ route('admin.applications.reject', $application->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to reject this application?')">
										@csrf
										<button type="submit" class="bg-red-500 text-white px-2 py-1 rounded cursor-pointer">{{ __('Reject') }}</button>
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
