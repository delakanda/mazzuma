<?php 

namespace Delakanda\LaravelMazzuma;

use Illuminate\Support\ServiceProvider;

class LaravelMazzumaServiceProvider extends ServiceProvider
{
  public function boot()
  {
    $this->publishes([
      __DIR__ . '/../config/laravel-mazzuma.php' => config_path('laravel-mazzuma.php'),
    ], 'config');
  }

  public function register()
  {

  }
}