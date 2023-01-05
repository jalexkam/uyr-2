<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $file_list = glob(app_path().'/Helpers/*.php');
        foreach ($file_list as $key => $file) {
            require_once($file);
        }
    }
}
