# Content-wrapper

This component is intended for displaying dynamic templates. The change of data in the template automatically triggers rendering of the changed template parts.


## Components

- [base.js](./index.md)
- **content-wrapper**


## Example of use

```html
<content-wrapper
    :default="{email:'soberbrunner@example.org', pageTitle: 'This is a content wrapper example'}"
    store-data="content">
    <template slot-scope="data">
        <h1>{{ data.pageTitle }}</h1>
        <p>You can look at this email <b>{{ data.email }}</b>, got from data you've passed</p>
    </template>
</content-wrapper>
```

<div class="vue-example">
<content-wrapper
    :default="{email:'soberbrunner@example.org', pageTitle: 'This is a content wrapper example'}"
    store-data="content">
    <template slot-scope="data">
        <h1>{{ data.pageTitle }}</h1>
        <p>You can look at this email <b>{{ data.email }}</b>, got from data you've passed</p>
    </template>
</content-wrapper>
</div>


## Input parameters

| Name            | Type          | Default      | Description                                   |
|-----------------|:-------------:| -------------|-----------------------------------------------|
| `lazy`          | **String**    | `undefined`  | *Not a Vue prop*, see details below           |
| `default`       | **Any**       | `null`       | Data for the template                         |
| `store-data`    | **String**    | `'content-wrapper-${i}`  | Identifier in Vuex store  |
| `tag`           | **String**    | `'div'`      | Tag for the template wrapper                  |
| `url`           | **String**    | `undefined`  | Recive or update data with GET-request. Will not fetch data on initial render, if the `default` prop is provided, |


## Lazy components

By default, every content-wrapper is loaded on core initialization, but they could be loaded only when appears in viewport (actually, 250px below and above). This option can improve site performance. The `lazy` attribute is not binded to content-wrapper, but removed during initialization. Any value except `false` is treated like truthy.


### Lazy markup

```html
<content-wrapper lazy>
    <some-huge-component></some-huge-component>
</content-wrapper>
```


## Slots

There are four slots, available in component: named 'loading', 'error', 'empty' for additional stilization, and the default slot

### default

Is used to display component data. If the component has a `'default'` prop, or some data was requested with AJAX, it is binded to the slot scope.

### loading

Appears when AJAX request is processing

### error

Appears when a rendering error occured in a child component, or AJAX request failed

### empty

Appears when the fetched data returns null and there are no default, not scoped slots 

```html
<content-wrapper url="/api-url" lazy>

    <div slot="error" class="has-error">
        <i class="icon icon-error"></i>
        <h4>An error occured</h4>
    </div>

    <div slot="loading" class="is-loading">
        <i class="icon icon-spinner"></i>
        <h4>Loading...</h4>
    </div>

    <div slot="empty" class="is-loading">
        <i class="icon icon-empty"></i>
        <h4>No data recieved</h4>
    </div>

    <template slot-scope="data">
        <some-component v-bind="data"></some-component>
    </template>
</content-wrapper>
```