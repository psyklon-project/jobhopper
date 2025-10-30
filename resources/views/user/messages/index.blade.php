<x-layouts.app :title="__('Inbox')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Inbox') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Read your notifications') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

	<x-session-message />

	@if ($messages->count())
		<div class="overflow-x-auto">
			<table class="w-full">
				<thead>
					<tr class="bg-gray-200">
						<th class="py-2 ps-4 border-b"></th>
						<th class="py-2 px-4 border-b text-left">{{ __('Created At') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Message') }}</th>
						<th class="py-2 px-4 border-b text-left">{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($messages as $message)
					<tr class="hover:bg-gray-100">
						<td class="py-2 ps-4 border-b text-center">
							@if (!$message->is_read)
								<span class="inline-block h-3 w-3 rounded-full bg-green-500" title="{{ __('Unread') }}"></span>
							@endif
						</td>
						<td class="py-2 px-4 border-b">{{ $message->created_at->format('F j, Y, g:i a') }}</td><td class="py-2 px-4 border-b">{{ $message->message }}</td>
						<td class="py-2 px-4 border-b">
							<div class="flex space-x-2">
								@if(!$message->is_read)
									<a href="{{ route('user.messages.read', $message->id) }}" class="bg-green-500 text-white px-2 py-1 rounded">{{ __('Mark as read') }}</a>
								@else
									<a href="{{ route('user.messages.unread', $message->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">{{ __('Mark as unread') }}</a>
								@endif
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<p class="mt-4">{{ __('No messages available.') }}</p>
	@endif
</x-layouts.app>
