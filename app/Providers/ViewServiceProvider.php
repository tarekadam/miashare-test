<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void{
        View::composer('home', function ($view){
            $view->with('tasks', Task::all());
        });

    }
}
