<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\Message;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('is-admin', function ($user) {
            return $user->role === Role::ADMINISTRATOR;
        });

        Gate::define('is-user', function ($user) {
            return $user->role === Role::USER;
        });

		View::composer('components.layouts.app.sidebar', function ($view) {
            $unread = Message::where('user_id', auth()->id())
				->where('is_read', false)
				->count();
			
            $view->with('unreadMessageCount', $unread);
        });
    }
}
