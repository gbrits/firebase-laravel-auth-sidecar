[![Latest Stable Version](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/v/stable)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![Total Downloads](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/downloads)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![Monthly Downloads](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/d/monthly)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![Daily Downloads](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/d/daily)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![License](https://poser.pugx.org/gbrits/firebase-laravel-auth-sidecar/license)](https://packagist.org/packages/gbrits/firebase-laravel-auth-sidecar)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=3TGHRLQAXRL6L&currency_code=AUD&source=url)

# Firebase Laravel Auth Sidecar

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

#### Publish vendor files (Blade directive views)

```
php artisan vendor:publish --provider="Gbrits\Firebase\Auth\ServiceProvider"
```

#### Minor adjustment to include the trait `Http/Controllers/Auth/LoginController.php`

```
use Gbrits\Firebase\Auth\AuthenticatesUsers;
class LoginController extends Controller {
  use RegistersUsers, AuthenticatesUsers, ValidatesRequests;
```

#### Add fillable Firebase fields to your user model `App/User.php`

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

#### Add some *Blade* components to your existing layout

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

#### :tada: Finally, clear the config cache and then clear the view cache. In that order:

```
php artisan config:cache
php artisan view:cache
```

Specifically in that order, as the Laravel directives utilise config values. Be sure to clear the view cache with every alteration you make to the directive views (in the vendor files), otherwise your changes won't apply.

#### Screenshots

![FirebaseUI Web](/screenshots/sign-in-providers.png)

#### Dependencies

* [Firebase php JWT](https://github.com/firebase/php-jwt)
* [FirebaseUI Web](https://github.com/firebase/firebaseui-web)

#### Donate

Oh go on, [buy me a beer](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=3TGHRLQAXRL6L&currency_code=AUD&source=url). Or a sugarfree Rockstar. 
