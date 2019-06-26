# Filter-wrapper for the form-builder

The &lt;filter-wrapper&gt; component is an add-in for the &lt;form-builder&gt;, it allows to use a form for the work with GET parameters in the address bar instead of sending a request to the server.

Below you can see a clear example of using such type of filter on your website.

![filter-wrapper](https://storage.googleapis.com/static.awes.io/docs/filter-wrapper.gif)

## Components
* **Filter Wrapper**
* [Filter Builder](./filter-builder.md)

<h2 id="fw-example">Example of use</h2>

The necessary fields are located within the component, they are exactly the same as in `&lt;form-builder&gt;`, only with one difference: the `name` property in the  parent elements defines the name of the GET parameter.

Here is the implementation of the <filter-wrapper> component:

```html
<filter-wrapper name="example">
    <fb-input name="text" label="Text"></fb-input>
    <fb-select name="array" label="Array"
    :select-options="[{name: 'Option 1', value: 'option_one'}, {name: 'Option 2', value: 'option_two'}]"></fb-select>
</filter-wrapper>
```


<h2 id="fw-options">Component properties</h2>

| Name           | Type      | Default       | Description                       |
|----------------|:---------:|:-------------:|-----------------------------------|
| **name**       | `String`  | filter-${uid} | Unique identifier (ID)            |
| **send-text**  | `String`  | `Apply`       | Text in the “Apply” button        |
| **reset-text** | `String`  | `Reset`       | Text in the “Reset” button        |
| **auto-submit**| `Boolean` | `undefined`   | If `true` the filter will be applied on fields value change |

The filter has an *active state (Boolean)*, namely there are such parameters in the address bar which match the field names in the filter. You can get this value from the storage in the `$awesFilters` variable by the filter name, for example:

```html
<span>Example filter is {{ $awesFilters.state.active['example'] ? '' : 'not' }} active</span>
```


<h2 id="fw-events">Component events</h2>

The table below describes the Vue events called by the component.

| Name               | Data           | Description                                                  |
|--------------------|:--------------:|--------------------------------------------------------------|
| **status-changed** | true/false     | The parameter in the address bar (don’t) match the fields in the filter |
| **applied**        | `$route.query` | The “Apply” button is pressed                                    |
| **reseted**        | `$route.query` | The “Reset” button is pressed                                     |

The events such as **applied** and **reseted** return a new value of parameters in the address bar.

*!! Please note that ALL parameters of the address bar are passed, and not only those specified in the filter fields !!*

If there is no handler for the **canceled** event, the “Cancel” button will not be displayed.


## Component slots

### Middle button and after button

A slot to append additional buttons

```html
<filter-wrapper>
    <fb-input name="text" label="Text"></fb-input>

    <template slot="buttons-middle">
        <button>
            Middle
        </button>
    </template>

    <template slot="buttons-after">
        <button>
            After
        </button>
    </template>
</filter-wrapper>
```

<div class="vue-example">
    <filter-wrapper>
        <fb-input name="text" label="Text"></fb-input>

        <template slot="buttons-middle">
            <button>
                Middle
            </button>
        </template>

        <template slot="buttons-after">
            <button>
                After
            </button>
        </template>
    </filter-wrapper>
</div>