@switch($status)
	@case('accepted')
		<span class="text-green-500">{{ __('Accepted') }}</span>
		@break
	@case('rejected')
		<span class="text-red-500">{{ __('Rejected') }}</span>
		@break
	@default
		<span>{{ __('Pending') }}</span>
@endswitch
