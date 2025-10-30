<x-layouts.app :title="__('Edit Position')">
	<div class="relative mb-6 w-full">
		<flux:heading size="xl" level="1">{{ __('Edit Position') }}</flux:heading>
		<flux:subheading size="lg" class="mb-6">{{ __('Update the details of an existing position') }}</flux:subheading>
		<flux:separator variant="subtle" />
	</div>

	<div class="flex items-start max-md:flex-col">
		<div class="flex-1 self-stretch max-md:pt-6">
			<form action="{{ route('admin.positions.update', $position->id) }}" method="POST" class="space-y-4">
				@csrf
				@method('PUT')
				<flux:input name="title" :label="__('Title')" type="text" value="{{ old('title', $position->title) }}" required autofocus autocomplete="title" />
				<flux:textarea name="description" :label="__('Description')" required autocomplete="description">{{ old('description', $position->description) }}</flux:textarea>
				<div class="flex flex-row gap-4">
					<div class="flex-1">
						<flux:select name="status" :label="__('Status')" required>
							<option value="open"{{ old('status', $position->status) == 'open' ? ' selected' : '' }}>{{ __('Open') }}</option>
							<option value="closed"{{ old('status', $position->status) == 'closed' ? ' selected' : '' }}>{{ __('Closed') }}</option>
						</flux:select>
					</div>
					<div class="flex-1">
						<flux:input name="max_applicants" :label="__('Max Applicants')" type="number" min="1" value="{{ old('max_applicants', $position->max_applicants) }}" required autocomplete="max_applicants" />
					</div>
				</div>
				
				<flux:button variant="primary" type="submit" class="w-full">
					{{ __('Update') }}
				</flux:button>
			</form>
		</div>
	</div>
</x-layouts.app>
