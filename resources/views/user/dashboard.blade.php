<x-layouts.app :title="__('Dashboard')">
	<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
		<div class="grid auto-rows-min gap-4 md:grid-cols-3">
			<div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 text-center">
				<flux:heading size="md" level="2" class="p-2">{{ __('Accepted') }}</flux:heading>
				<flux:separator variant="subtle" />
				<h2 class="text-2xl font-bold p-4 text-green-500">{{ $acceptedCount }}</h2>
			</div>
			<div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 text-center">
				<flux:heading size="md" level="2" class="p-2">{{ __('Rejected') }}</flux:heading>
				<flux:separator variant="subtle" />
				<h2 class="text-2xl font-bold p-4 text-red-500">{{ $rejectedCount }}</h2>
			</div>
			<div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 text-center">
				<flux:heading size="md" level="2" class="p-2">{{ __('Pending') }}</flux:heading>
				<flux:separator variant="subtle" />
				<h2 class="text-2xl font-bold p-4">{{ $pendingCount }}</h2>
			</div>
		</div>
		<div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
			<flux:heading size="lg" level="2" class="p-4">{{ __('My Applications') }}</flux:heading>
			<flux:separator variant="subtle" />
			<div class="h-full overflow-y-auto">
				@if($applications->count())
					<table class="w-full">
						<thead>
							<tr class="bg-gray-200">
								<th class="py-2 px-4 border-b text-left">{{ __('Position') }}</th>
								<th class="py-2 px-4 border-b text-left">{{ __('Applied At') }}</th>
								<th class="py-2 px-4 border-b text-left">{{ __('Status') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($applications as $application)
								<tr class="hover:bg-gray-100">
									<td class="py-2 px-4 border-b">{{ $application->position->title }}</td>
									<td class="py-2 px-4 border-b">{{ $application->created_at->format('F j, Y, g:i a') }}</td>
									<td class="py-2 px-4 border-b">
									<x-application-status :status="$application->status" />
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<p>{{ __('You have not applied to any positions yet.') }}</p>
				@endif
			</div>
		</div>
	</div>
</x-layouts.app>
