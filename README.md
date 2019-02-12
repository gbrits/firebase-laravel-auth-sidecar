[![Total Downloads](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/downloads)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)

# Firebase Add-on for Laravel (Sidecar)

## Installation

#### Via Composer Require

You may install by running the `composer require` command in your terminal:
```
composer require gbrits/firebase-laravel-auth-sidecar
```

**Add your Firebase project ID, API key and auth domain into your `.env`**

```
FIREBASE_PROJECT_ID=__________
FIREBASE_API_KEY=__________
FIREBASE_AUTH_DOMAIN=__________
```

**Add the service provider to your `config/app.php`**

```
Gbrits\Firebase\Auth\ServiceProvider::class,
```

**Clear the cache `php artisan config:cache`**

**Publish vendor files**

```
php artisan vendor:publish --provider="Gbrits\Firebase\Auth\ServiceProvider"
```

**Minor adjustment to `Http/Controllers/Auth/LoginController.php`**
```
use Gbrits\Firebase\Auth\Http\AuthController as BaseController;
class LoginController extends BaseController
```

**Add some routes to `web.php`**

```
Route::get('auth', 'Auth\LoginController@getAuth')->name('getAuth');
Route::post('auth', 'Auth\LoginController@postAuth')->name('postAuth');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
```

## Screenshots

![FirebaseUI Web](/screenshots/sign-in-providers.png)

## Dependencies

* [Firebase php JWT](https://github.com/firebase/php-jwt)
* [FirebaseUI Web](https://github.com/firebase/firebaseui-web)
