<x-layouts.app :title="__('Create Task')">
	<div class="relative mb-6 w-full">
		<flux:heading size="xl" level="1">{{ __('Create Position') }}</flux:heading>
		<flux:subheading size="lg" class="mb-6">{{ __('Add a new position to the database') }}</flux:subheading>
		<flux:separator variant="subtle" />
	</div>

    <div class="flex items-start max-md:flex-col">
        <div class="flex-1 self-stretch max-md:pt-6">
			<form action="{{ route('admin.positions.store') }}" method="POST" class="space-y-4">
				@csrf
				<flux:input name="title" :label="__('Title')" type="text" required autofocus autocomplete="title" />
				<flux:textarea name="description" :label="__('Description')" required autocomplete="description" />
				<div class="flex flex-row gap-4">
					<div class="flex-1">
						<flux:select name="status" :label="__('Status')" required>
							<option value="open">{{ __('Open') }}</option>
							<option value="closed">{{ __('Closed') }}</option>
						</flux:select>
					</div>
					<div class="flex-1">
						<flux:input name="max_applicants" :label="__('Max Applicants')" type="number" min="1" required autocomplete="max_applicants" />
					</div>
				</div>
				
				<flux:button variant="primary" type="submit" class="w-full">
					{{ __('Save') }}
				</flux:button>
			</form>
        </div>
    </div>
</x-layouts.app>
