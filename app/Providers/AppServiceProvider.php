<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;


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
    public function boot()
    {
        Validator::extend('participant_count', function ($attribute, $value, $parameters, $validator) {
            $jurusan = $validator->getData()['jurusan'];
            if (in_array($jurusan, ['TKJ', 'TJA', 'SIJA']) && in_array($value, [1, 2])) {
                return true;
            }
            if (in_array($jurusan, ['RPL', 'Broadcasting', 'MM']) && $value == 1) {
                return true;
            }
            return false;
        });
    }
}