<?php

namespace App\Providers;

use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer('admin.*', function ($view): void {
            $pendingCutiCount = 0;

            try {
                if (Schema::hasTable('leave_requests')) {
                    $pendingCutiCount = LeaveRequest::where('status', 'menunggu')->count();
                }
            } catch (\Throwable $e) {
                $pendingCutiCount = 0;
            }

            $view->with('pendingCutiCount', $pendingCutiCount);
        });
    }
}
