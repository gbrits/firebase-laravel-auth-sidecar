# Firebase Add-on for Laravel (Sidecar)

## Installation

#### Via Composer Require

You may install by running the `composer require` command in your terminal:
```
composer require gbrits/firebase-laravel-auth-sidecar
```

**Add Service Provider to your `config/app.php` file**

```
Gbrits\Firebase\Auth\ServiceProvider::class,
```

**Run `php artisan` command to publish package files into your app**

```
php artisan vendor:publish --provider="Gbrits\Firebase\Auth\ServiceProvider"
```

**Add your firebase project id, api key and auth domain in `.env` file**

```
FIREBASE_PROJECT_ID=__________
FIREBASE_API_KEY=__________
FIREBASE_AUTH_DOMAIN=__________
```

## Screenshots

![FirebaseUI Web](/screenshots/sign-in-providers.png)

## Dependencies

* [Firebase php JWT](https://github.com/firebase/php-jwt)
* [FirebaseUI Web](https://github.com/firebase/firebaseui-web)
