# laravel-security-checker
[![Latest Stable Version](https://poser.pugx.org/lowerends/laravel-security-checker/v/stable)](https://packagist.org/packages/lowerends/laravel-security-checker) [![Total Downloads](https://poser.pugx.org/lowerends/laravel-security-checker/downloads)](https://packagist.org/packages/lowerends/laravel-security-checker) [![Latest Unstable Version](https://poser.pugx.org/lowerends/laravel-security-checker/v/unstable)](https://packagist.org/packages/lowerends/laravel-security-checker) [![License](https://poser.pugx.org/lowerends/laravel-security-checker/license)](https://packagist.org/packages/lowerends/laravel-security-checker)

This package makes it easy to integrate the Symfony Security Checker tool into your Laravel project. It exposes an artisan command to check against the Security Advisories Database.

## Installation

Require this package with composer:

```
composer require lowerends/laravel-security-checker
```

Then, add the ServiceProvider to the providers array in `config/app.php`:

```
'providers' => [
   ...
   'Lowerends\SecurityChecker\ServiceProvider',
```

## Usage

You can now check your Laravel project for known security issues by running the following artisan command:

```
artisan security:check
```

A convenient way to use this command is to add it to the post-update scripts in your project's `composer.json` file (extracted from the default Laravel `composer.json` file):

```
...
"scripts": {
    "post-install-cmd": [
            "php artisan clear-compiled",
            "php artisan optimize"
        ],
        "pre-update-cmd": [
            "php artisan clear-compiled"
        ],
        "post-update-cmd": [
            "php artisan optimize",
            "php artisan security:check"
        ],
        "post-root-package-install": [
            "php -r \"copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "php artisan key:generate"
        ]
},
...
```

The output will tell you if there are known security issues and if so, list them in order for you to take the necessary actions.

## License

The Laravel Security Checker is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
