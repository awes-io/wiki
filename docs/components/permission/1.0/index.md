# Laravel roles & permissions

Build around [spatie/laravel-permission package] (https://github.com/spatie/laravel-permission)

## Installation

Via Composer

``` bash
$ composer require awes-io/permission
```

The package will automatically register itself.

You can publish migration with:

```bash
php artisan vendor:publish --provider="AwesIO\Permission\PermissionServiceProvider" --tag="migrations"
```

After migration has been published you can create tables by running:

```bash
php artisan migrate
```

You can publish package views:

```bash
php artisan vendor:publish --provider="AwesIO\Permission\PermissionServiceProvider" --tag="views"
```

Run seeder for roles and permissions tables:

```bash
php artisan db:seed --class="AwesIO\Permission\Seeds\PermissionTablesSeeder"
```

## Configuration

You can set up routes path and naming prefixes. First publish config:

```bash
php artisan vendor:publish --provider="AwesIO\Permission\PermissionServiceProvider" --tag="config"
```

```php
'routes' => [
    // roles routes prefixes (path & naming)
    'roles_prefix' => 'roles',
    'roles_name_prefix' => 'roles.',

    // permissions routes prefixes
    'permissions_prefix' => 'permissions',
    'permissions_name_prefix' => 'permissions.',
]
```

## Usage

Add to routes/web.php

```php
Permission::routes();
```

Package will register several routes:

```
+--------+----------+--------------------+--------------------+-----------------------------------------------------------+------------+
| Domain | Method   | URI                | Name               | Action                                                    | Middleware |
+--------+----------+--------------------+--------------------+-----------------------------------------------------------+------------+
|        | GET|HEAD | permissions        | permissions.index  | AwesIO\Permission\Controllers\PermissionController@index  | web        |
|        | POST     | permissions        | permissions.store  | AwesIO\Permission\Controllers\PermissionController@store  | web        |
|        | POST     | permissions/assign | permissions.assign | AwesIO\Permission\Controllers\PermissionController@assign | web        |
|        | POST     | permissions/revoke | permissions.revoke | AwesIO\Permission\Controllers\PermissionController@revoke | web        |
|        | GET|HEAD | roles              | roles.index        | AwesIO\Permission\Controllers\RoleController@index        | web        |
|        | POST     | roles              | roles.store        | AwesIO\Permission\Controllers\RoleController@store        | web        |
|        | POST     | roles/assign       | roles.assign       | AwesIO\Permission\Controllers\RoleController@assign       | web        |
|        | POST     | roles/revoke       | roles.revoke       | AwesIO\Permission\Controllers\RoleController@revoke       | web        |
+--------+----------+--------------------+--------------------+-----------------------------------------------------------+------------+
```

```php
# Routes for permissions management
'permissions.'

# Routes for roles management
'roles.'
```

Add `AwesIO\Permission\Traits\HasRoles` trait to your `User` model(s):

```php
use AwesIO\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
}
```

## Testing

You can run the tests with:

```bash
composer test
```