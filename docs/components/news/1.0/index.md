# Laravel News package

Create and update news posts and categories.

## Installation

Via Composer

``` bash
$ composer require awes-io/news
```

The package will automatically register itself.

You can publish the migrations with:

```bash
php artisan vendor:publish --provider="AwesIO\News\NewsServiceProvider" --tag="migrations"
```

After migrations has been published you can create the tables by running:

```bash
php artisan migrate
```

Run seeder for news_categories table:
```bash
php artisan db:seed --class="AwesIO\News\Seeds\NewsCategoriesTableSeeder"
```

You can publish views with:

```bash
php artisan vendor:publish --provider="AwesIO\News\NewsServiceProvider" --tag="views"
```

## Configuration

You can set up routes path and naming prefixes. First publish config:

```bash
php artisan vendor:publish --provider="AwesIO\News\NewsServiceProvider" --tag="config"
```

```php
'routes' => [
    // basic routes prefixes (path & naming)
    'prefix' => 'news',
    'name_prefix' => 'news.',

    // admin routes prefixes
    'admin_prefix' => 'admin/news',
    'admin_name_prefix' => 'admin.news.',
]
// paginator type 'simple' for Paginator or 'default' for LengthAwarePaginator
'paginator' => 'simple',

// pagination per page number
'paginate_by' => 15,

// related news on show page cached
'cache_related_news' => true,
```

Model factories:

```php
factory(\AwesIO\News\Models\News::class)->make();
factory(\AwesIO\News\Models\NewsCategory::class)->create();
```

## Usage

Add to routes/web.php

```php
use AwesIO\News\Facades\News;

News::routes();
News::adminRoutes();
```

Package will register several routes:

```
+--------+----------+--------------------------------------------------+------------------------------+---------------------------------------------------------+------------+
| Domain | Method   | URI                                              | Name                         | Action                                                  | Middleware |
+--------+----------+--------------------------------------------------+------------------------------+---------------------------------------------------------+------------+
|        | GET|HEAD | admin/news                                       | admin.news.index             | AwesIO\News\Controllers\Admin\NewsController@index      | web        |
|        | POST     | admin/news                                       | admin.news.store             | AwesIO\News\Controllers\Admin\NewsController@store      | web        |
|        | GET|HEAD | admin/news/categories                            | admin.news.categories.index  | AwesIO\News\Controllers\Admin\CategoryController@index  | web        |
|        | POST     | admin/news/categories                            | admin.news.categories.store  | AwesIO\News\Controllers\Admin\CategoryController@store  | web        |
|        | GET|HEAD | admin/news/categories/create                     | admin.news.categories.create | AwesIO\News\Controllers\Admin\CategoryController@create | web        |
|        | GET|HEAD | admin/news/categories/{category}/edit-category   | admin.news.categories.edit   | AwesIO\News\Controllers\Admin\CategoryController@edit   | web        |
|        | POST     | admin/news/categories/{category}/update-category | admin.news.categories.update | AwesIO\News\Controllers\Admin\CategoryController@update | web        |
|        | GET|HEAD | admin/news/create                                | admin.news.create            | AwesIO\News\Controllers\Admin\NewsController@create     | web        |
|        | POST     | admin/news/{category}/{news}                     | admin.news.update            | AwesIO\News\Controllers\Admin\NewsController@update     | web        |
|        | GET|HEAD | admin/news/{category}/{news}/edit                | admin.news.edit              | AwesIO\News\Controllers\Admin\NewsController@edit       | web        |
|        | GET|HEAD | news                                             | news.index                   | AwesIO\News\Controllers\NewsController@index            | web        |
|        | GET|HEAD | news/{category}                                  | news.category                | AwesIO\News\Controllers\NewsController@category         | web        |
|        | GET|HEAD | news/{category}/{news}                           | news.show                    | AwesIO\News\Controllers\NewsController@show             | web        |
+--------+----------+--------------------------------------------------+------------------------------+---------------------------------------------------------+------------+
```

```php
# All news index route
'news'

# Category news route
'news/{category}'
# where {category} is unique slug

# News page route
'news/{category}/{news}'
# where {category} and {news} are unique slugs

# Admin's all news listing
'admin/news'

# Admin news creation form
'admin/news/create'

# Admin news editing form
'admin/news/{category}/{news}/edit'
# where {category} and {news} are unique slugs

# Admin all categories listing
'admin/news/categories'

# Admin category creation form
'admin/news/categories/create'

# Admin category editing form
'admin/news/categories/{category}/edit-category'
# where {category} is unique slug
```

## Testing

You can run the tests with:

```bash
composer test
```