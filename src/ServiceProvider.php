<?php

namespace Gbrits\Firebase\Auth;

use Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {

  /**
  * Perform post-registration booting of services.
  *
  * @return void
  */
  public function boot()
  {
    Blade::directive('firebaseuiheader', function( $config ) {
      return view('gbrits.firebase.header');
    });
    Blade::directive('firebaseuiwidget', function() {
      return view('gbrits.firebase.widget');
    });
    Blade::directive('firebaseuifooter', function() {
      return view('gbrits.firebase.footer');
    });
    $this->publishes([
      __DIR__.'/config/firebase.php' => config_path('gbrits/firebase/auth.php'),
    ], 'config');

    $this->publishes([
      __DIR__.'/../database/migrations/' => database_path('migrations'),
    ], 'migrations');

    $this->publishes([
        __DIR__.'/resources/views' => resource_path('views/gbrits/firebase'),
    ], 'views');
  }

  /**
  * Register bindings in the container.
  *
  * @return void
  */
  public function register()
  {
    //
  }

}
