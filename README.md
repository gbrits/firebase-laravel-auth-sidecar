[![Total Downloads](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/downloads)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)

# Firebase Add-on for Laravel (Sidecar)

![Google Latched onto Laravel](/screenshots/sidecar.jpg)

## Installation

#### Via Composer Require

You may install by running the `composer require` command in your terminal:
```
composer require gbrits/firebase-laravel-auth-sidecar
```

#### Add your Firebase project ID, API key and auth domain into your `.env`

```
FIREBASE_API_KEY=AIzXXgibberxJf4_5rlradjabberTsMpX
FIREBASE_AUTH_DOMAIN=acme.firebaseapp.com
FIREBASE_DATABASE_URL=https://acme.firebaseio.com
FIREBASE_PROJECT_ID=acme
FIREBASE_STORAGE_BUCKET=acme.appspot.com
FIREBASE_MESSAGING_SENDER_ID=800813513371
```

#### Add the service provider to your `config/app.php`

```
Gbrits\Firebase\Auth\ServiceProvider::class,
```

#### Clear the cache `php artisan config:cache` and publish vendor files

```
php artisan vendor:publish --provider="Gbrits\Firebase\Auth\ServiceProvider"
```

#### Minor adjustment to `Http/Controllers/Auth/LoginController.php`
```
use Gbrits\Firebase\Auth\Http\AuthController as BaseController;
class LoginController extends BaseController
```

#### Add some routes to `web.php`

```
Route::post('auth', 'Auth\LoginController@postAuth')->name('postAuth');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
```

#### Add some Blade components to your existing layout

##### To be placed in the header:
```
@firebaseuiheader
```
##### To be placed in the body:
```
@firebaseuiwidget
```
##### To be placed in the footer:
```
@firebaseuifooter
```

#### Screenshots

![FirebaseUI Web](/screenshots/sign-in-providers.png)

#### Dependencies

* [Firebase php JWT](https://github.com/firebase/php-jwt)
* [FirebaseUI Web](https://github.com/firebase/firebaseui-web)
