[![Latest Stable Version](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/v/stable)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![Total Downloads](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/downloads)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![Monthly Downloads](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/d/monthly)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![Daily Downloads](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/d/daily)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![License](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/license)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)

# Firebase Laravel Auth Sidecar

![Google Latched onto Laravel](/screenshots/sidecar.jpg)

## Installation

Please keep in mind this is not a 'one-size-fits-all' installation that just handles everything for you. You could have Laravel Nova installed or any number of custom modifications to your user table - you will have to make minor adjustments to the 'AuthController' in the vendor files to fit your installation. Please do not log issues with questions, you can email me on github@maximus.agency.

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

#### Clear the cache `php artisan config:cache` and publish vendor files (Blade directive views)

```
php artisan vendor:publish --provider="Gbrits\Firebase\Auth\ServiceProvider"
```

#### Minor adjustment to include the trait `Http/Controllers/Auth/LoginController.php`

```
use Gbrits\Firebase\Auth\AuthenticatesUsers;
class LoginController extends Controller {
  use RegistersUsers, AuthenticatesUsers, ValidatesRequests;
```

### Add fillable Firebase fields to your user model `App/User.php`

```
$fillable = [
  ~ all your other fields ~, 'id_token', 'photo_url'
];
```

#### Add some routes to `web.php`

```
Route::post('auth', 'Auth\LoginController@postAuth')->name('postAuth');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
```

#### :tada: Add some *Blade* components to your existing layout

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
