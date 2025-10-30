@if(auth()->user()->profile_picture)
	<img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" class="h-full w-full object-cover">
@else
	{{ auth()->user()->initials() }}
@endif
