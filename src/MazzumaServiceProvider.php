<?php 

namespace Delakanda\Mazzuma;

use Illuminate\Support\ServiceProvider;

class MazzumaServiceProvider extends ServiceProvider
{
  public function boot()
  {
    $this->publishes([
      __DIR__ . '/../config/mazzuma.php' => config_path('mazzuma.php'),
    ], 'config');
  }

  public function register()
  {
    $this->app->bind('Mazzuma', function () {
      return new Mazzuma;
    });

    $this->app->alias('Mazzuma', Mazzuma::class);
  }
}