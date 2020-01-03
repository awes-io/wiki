# The &lt;tab-nav&gt; component

This component used internally by [tab-builder](./tab-builder.md), but it can be used standalone, to create, for example, a responsive tab-like navigation.


## Components

- [tab-builder](./tab-builder.md)
- **tab-nav**
- [tab-switcher](./tab-switcher.md)


## Component parameters

| Name         | Type     | Default     | Description       |
|--------------|:--------:|-------------|-------------------|
| **name**     | `String` | `undefined` | Component ID. When defined, adds a GET-parameter, which value is equal to current active item index. |
| **links(*)** | `Array`  | `undefined` | **Required**. Array of [link objects](#link-object)  |
| **active**   | `Number` | `0`         | Active item index |


<h2 id="tb-nav-link-schema">Link schema</h2>

```javascript
/**
 * @class LinkItem
 *
 * @property {String} LinkItem.name - required, visible name
 * @property {String} LinkItem.link - URL, if <a> element is needed, otherwise a <button> will be created
 * @property {Boolean} LinkItem.active - sets the component active tab to first found item with true value
 */

// button with name
{
    name: 'Tab 1'
}

// anchor with url
{
    name: 'External link',
    link: '//some-website.com'
}

// second tab will be active
[{
    name: 'Tab 1'
},
{
    name: 'Tab 2',
    active: true
}]
```

## Component slots

### The `tab-toggler` slot of visible switchers 

The tab-toggler slot should be placed within the tab-builder component. The code snippet for the slot of this type should look like:

```html
<tab-nav>
    <template slot="tab-toggler" slot-scope="toggler">
        {{ toggler.item.label }}
        {{ toggler.isActive ? '&checkmark;' : '&times;'}}
    </template>
</tab-nav>
```

#### Parameters passed to the slot

| Name           | Type      | Description                                                        |
|----------------|:---------:|--------------------------------------------------------------------|
| **item.name**  | `String`  | Caption of the tab switching button                                |
| **item.url**   | `String`  | Link address for `&lt;tb-link&gt;` or `null` for `&lt;tb-tab&gt;`  |
| **isActive**   | `Boolean` | Shows whether this item is active or not                           |
| **index**      | `Number`  | Item index                                                         |


### The `tab-hidden` slot of hidden switchers 

It is similar to the slot of visible switchers.

### The `tab-hidden-open` slot of the button of hidden switchers 

Parameters passed to the slot

| Name           | Type      | Description                            |
|----------------|:---------:|----------------------------------------|
| **items**      | `Array`   | List of all buttons and links          |
| **hiddenIdx**  | `Array`   | Index array of hidden buttons          |
| **name**       | `String`  | Caption for the button in the hidden switcher |
| **activeTab**  | `Number`  | Index of active item                   |
