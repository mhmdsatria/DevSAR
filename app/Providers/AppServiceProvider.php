<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Pelayanan;
use App\Models\Statistic;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\VisitorStatisticsController;

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
        View::composer('*', function ($view) {
            try {
                $visitorStatisticsController = new VisitorStatisticsController();
                $stat = $visitorStatisticsController->getStatistics();
                $view->with('stat', $stat);
            } catch (\Exception $e) {
                Log::error("Error saat memuat statistik pengunjung di View Composer: " . $e->getMessage());
                $view->with('stat', [
                    'today' => 0, 'yesterday' => 0, 'this_week' => 0, 'this_month' => 0, 'this_year' => 0,
                ]);
            }
        });



        Blade::component('components.carousel', 'carousel');

        View::composer('components.navbar', function ($view) {
            $view->with('daftar_layanan', Pelayanan::all());

            if (Schema::hasTable('statistics')) {
                $data = Statistic::first();
                $view->with('stat_data', $data);
            }
        });
    }
}
