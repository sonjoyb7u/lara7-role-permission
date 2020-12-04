## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

## Using Proccess Of Laravel Spatie/Permission
First of all, go to link:-
    https://spatie.be/docs/laravel-permission/v3/installation-laravel.
Than you can install the package via composer:- 
    composer require spatie/laravel-permission

Optional: The service provider will automatically get registered. Or you may manually add the service provider in your config/app.php file:-
    'providers' => [
        Spatie\Permission\PermissionServiceProvider::class,
    ];

You should publish the migration and the config/permission.php config file with:-
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

Clear your config cache. This package requires access to the permission config. Generally it's bad practice to do config-caching in a development environment. If you've been caching configurations locally, clear your config cache with either of these commands:-
    php artisan optimize:clear Or php artisan config:clear
 
Run the migrations: After the config and migration have been published and configured, you can create the tables for this package by running:-
    - php artisan migrate

Add the necessary trait to your User model: Consult the Basic Usage section of the docs for how to get started using the features of this package.
    Go to the link:-
    https://spatie.be/docs/laravel-permission/v3/prerequisites
    Than use this traits class in user model:-
        use Spatie\Permission\Traits\HasRoles;
        class User extends Authenticatable
        {
            use HasRoles;
        }
    
  

## Contributing
Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct
In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities
If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
