<?php

namespace App\Providers;

use DateTime;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        /**
         * `APP_DEBUG=true` の場合 SQL ログを出力する
         */
        if (config('app.debug')) {
            DB::listen(function (QueryExecuted $query) {
                $sql = $query->sql;
                if (app()->environment('local')) {
                    /** `php artisan queue:work --sleep=3` 実行時のログを抑制する(cache) */
                    if (str($sql)->contains('SELECT * FROM `cache` WHERE `key` =')) {
                        return;
                    }
                    /** `php artisan queue:work --sleep=3` 実行時のログを抑制する(jobs) */
                    if (str($sql)->contains('SELECT * FROM `jobs` WHERE `queue` =')) {
                        return;
                    }
                }
                // add bindings to query
                foreach ($query->bindings as $binding) {
                    $binding = $binding ?? '';
                    if ($binding instanceof DateTime) {
                        $binding = new Carbon($binding);
                    }
                    $binding = $query->connection->getPdo()->quote($binding);
                    $binding = str_replace('\\', '\\\\', $binding);
                    $sql = preg_replace('/\?/', $binding, $sql, 1);
                }
                // highlight keywords
                $keywords = [
                    'select', 'insert', 'update', 'delete', 'where', 'from', 'limit', 'is', 'null', 'having', 'group by',
                    'order by', 'asc', 'desc',
                ];
                $regexp = '/\b' . implode('\b|\b', $keywords) . '\b/i';
                $sql = preg_replace_callback($regexp, function ($match) {
                    return strtoupper($match[0]);
                }, $sql);
                logger($sql, ['time' => $query->time, 'databaseName' => $query->connection->getDatabaseName(),]);
            });
        }
    }
}
