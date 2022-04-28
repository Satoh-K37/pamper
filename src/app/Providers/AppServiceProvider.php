<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Collection; //Paginate
use Illuminate\Pagination\LengthAwarePaginator; //Paginate

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
          $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

          return new LengthAwarePaginator(
              $this->forPage($page, $perPage),
              $total ?: $this->count(),
              $perPage,
              $page,
              [
                  'path' => LengthAwarePaginator::resolveCurrentPath(),
                  'pageName' => $pageName,
              ]
          );
        });

        // 全てのリクエストをHTPPSとして処理するための処理
        if ($this->app->environment() == 'production') {
            URL::forceSchema('https');
        }
    }
}
