<x-layouts.app :title="__('Manage Users')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage users') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

	<x-session-message />
	
	@if ($users->count())
		<div class="overflow-x-auto">
			<table class="w-full">
				<thead>
					<tr class="bg-gray-200">
						<th class="py-2 px-4 border-b text-left">{{ __('Name') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Created At') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Role') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Applications') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr class="hover:bg-gray-100">
						<td class="py-2 px-4 border-b">{{ $user->name }}</td>
						<td class="py-2 px-4 border-b">{{ $user->created_at->format('F j, Y, g:i a') }}</td>
						<td class="py-2 px-4 border-b">{{ ucfirst($user->role->value) }}</td>
						<td class="py-2 px-4 border-b">{{ $user->applications->count() }}</td>
						<td class="py-2 px-4 border-b">
							<div class="flex space-x-2">
								<a href="{{ route('admin.users.show', $user->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">{{ __('View') }}</a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endif
</x-layouts.app>
