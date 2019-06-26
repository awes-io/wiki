# Filter-builder

The &lt;filter-builder&gt; component is intended for working with GET parameters in the address bar.

Let’s learn more about this component.

## Components
* [Filter Wrapper](./filter-wrapper.md)
* **Filter Builder**

## <a name="frb-example"></a> Example of use

```html
<filter-builder label="Active" :param="{active: 'true'}"></filter-builder>
```

<div class="vue-example">
<filter-builder label="Active" :param="{active: 'true'}"></filter-builder>
</div>


## <a name="frb-options"></a> Component properties

| Name           | Type       | Default       | Description                         |
|----------------|:----------:|:-------------:|-------------------------------------|
| **label (*)**  | `String`   | filter-${uid} | Text in the filter                  |
| **param**      | `Object`   | `{}`          | Name and value of the GET parameter |
| **active**     | `Boolean`  | `false`       | Set param on component mount event  |
