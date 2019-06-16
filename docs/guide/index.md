# Creating first section

After [installing Awes-io](https://github.com/awes-io/awes-io#installation) you can create your first `section`.

Sections are main building blocks for a project based on Awes-io platform. Let's create one and inspect its directory structure.

To generate new section we can use `awes-io/generator` package and its Artisan command:

```bash
php artisan make:section Leads
```

This command will place new controller, model, repository and resource classes within your `app/Sections/Leads` directory. As well as index blade template in `resources/views/sections/leads`.

Let's also define basic routes to controller actions like so:

```php
// routes/web.php
Route::namespace('\App\Sections\Leads\Controllers')->prefix('leads')->group(function () {
    Route::get('/', 'LeadController@index')->name('leads.index');
    Route::get('scope', 'LeadController@scope')->name('leads.scope');
});
```

And migration for new leads table:

```php
// database/migrations/XXXX_XX_XX_XXXXXX_create_leads_table.php
...
Schema::create('leads', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('name');
    $table->timestamps();
});
...
```

After migrating, we can access new section on `localhost/leads` and see basic UI:

<img src="https://static.awes.io/docs/guide/01_basic_ui.png" alt="Awes.io">

New localization file will also be created within the `resources/lang` directory, thanks to `awes-io/localization-helper` package, which we'll discuss later.

## Controller

Let's check out the newly generated controller. It includes several methods, firstly `constructor`, in which we're injecting repository (more on this later):

```php
public function __construct(LeadRepository $leads)
{
    $this->leads = $leads;
}
```

`Index` method, where we return auto-generated blade template, as well as page title and all leads:

```php
public function index(Request $request)
{
    return view('sections.leads.index', [
        'h1' => _p('pages.leads.h1', 'leads'),
        'leads' => $this->scope($request)->response()->getData()
    ]);
}
```

`_p($file_key, $default, $placeholders)` is a helper function from our localization package, [more info is available in documentation](https://github.com/awes-io/localization-helper).

Scope method, which is used to retrieve, filter and sort lead records (more on this later):

```php
public function scope(Request $request)
{
    return Lead::collection(
        $this->leads->scope($request)->smartPaginate()
    );
}
```

We're also paginating results and transforming response data via auto-generated API resource class.

## Model

`Lead` model class is pretty simple, all we have is `$orderable` property, where we add all attributes we want to sort lead records by. We will discuss sorting later, but more info can be found in [awes-io/repository package documentation](https://github.com/awes-io/repository#scope-filter-and-order)

```php
public $orderable = [];
```

## Repository

`App\Sections\Leads\Repositories\LeadRepository` class includes `$searchable` property and `entity()` method, which returns full repository model class name.

```php
protected $searchable = [];

public function entity()
{
    return Lead::class;
}
```

We will discuss repositories and their filtering and ordering features later in detail. All documentation on this topic is [available here](https://github.com/awes-io/repository)

## API resource

`App\Sections\Leads\Resources\Lead` is just a basic [Eloquent API Resource](https://laravel.com/docs/master/eloquent-resources)

## View

Auto-generated `index` template is located in `resources/views/sections/leads`.

It extends main layout of `awes-io/indigo-layout` [package which contains useful styles and blade components](https://github.com/awes-io/indigo-layout) for fast building of responsive UI.

```php
@extends('indigo-layout::main')
```

Next, there are meta title and description sections:

```php
@section('meta_title', _p('pages.leads.meta_title', 'meta_title') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.leads.meta_description', 'meta_description'))
```

Here we can see how `_p()` helper localization function is used. First argument is the file.key string, if we open newly created `resources/lang/en/pages.php` file we'll see different translation strings:

```php
<?php

return [
    "leads" => [
        "h1" => "leads",
        "meta_title" => "meta_title",
        "meta_description" => "meta_description",
        ...
    ]
];
```

The second argument is a default value, which will be added to the localization file if key doesn't exist. Thus, by the time the interface build process is completed, you will have a complete base language file, ready for translation.

Further in the template we can see `create_button` section, which determines how "floating" action button looks like:

```php
@section('create_button')
    <button class="frame__header-add" @click="AWES.emit('modal::leads.open')"><i class="icon icon-plus"></i></button>
@endsection
```

Next goes `group filter` component:

```php
@filtergroup(['filter' => ['' => 'All', '1' => 'Public', '0' => 'Private'], 'variable' => 'is_public'])
```

<img src="https://static.awes.io/docs/guide/02_filter_group_component.png" alt="Awes.io">

If we click on one of the filters, we'll see that it modifies `is_public` URL's parameter to respective value. Our component will track these changes and send server requests to get filtered data. We will return to this topic when we'll create additional filters ourselves.

After filters, we can see one more very powerful component - context menu, which in this case, controls ordering our leads by their names. 

```php
<context-menu button-class="filter__slink" right>
    <template slot="toggler">
        <span>{{  _p('pages.filter.sort_by', 'Sort by') }}</span>
    </template>
    <cm-query :param="{orderBy: 'name'}">{{ _p('pages.leads.filter.name', 'Name') }} &darr;</cm-query>
    <cm-query :param="{orderBy: 'name_desc'}">{{ _p('pages.leads.filter.name', 'Name') }} &uarr;</cm-query>
</context-menu>
```

Sorting is another topic we'll analyze in the future, when we'll build our custom filters based on repositories.

Next is the button to open main filters panel, for now, it only displays one parameter, but we'll add more, later:

```php
<button class="filter__slink" @click="$refs.filter.toggle()">
    <i class="icon icon-filter" v-if="">
        <span class="icn-dot" v-if="$awesFilters.state.active['leads']"></span>
    </i>
    {{  _p('pages.filter.title', 'Filter') }}
</button>
...
<slide-up-down ref="filter">
    <filter-wrapper name="leads">
        <div class="grid grid-gap-x grid_forms">
            <div class="cell">
                <fb-input name="name" label="{{ _p('pages.leads.filter.name', 'Name') }}"></fb-input>
            </div>
        </div>
    </filter-wrapper>
</slide-up-down>
```
<img src="https://static.awes.io/docs/guide/03_main_filters.png" alt="Awes.io">
