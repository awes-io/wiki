# The &lt;tab-builder&gt; Component

This component provides mechanism to switch between tabs. It is used in conjunction with `&lt;tb-tab&gt;` and `&lt;tb-link&gt;`. It automatically generates tabs from the default slot and ensures that they fit in a browser window within one line. The switchers which don’t fit in will be set in the special hidden switcher in the form of a dropdown list.

![tab-builder](https://storage.googleapis.com/static.awes.io/docs/tab-builder.gif)


## Components

- **tab-builder**
- [tab-nav](./tab-nav.md)
- [tab-switcher](./tab-switcher.md)


## Example of using the component

```html
<tab-builder>
    <tb-tab label="Tab 1">
        Tab 1 content
    </tb-tab>
    <tb-tab label="Tab 2">
        <p>Tab 2 content</p>
    </tb-tab>
    <tb-link label="Link" url="//google.com"></tb-link>
</tab-builder>
```
<div class="vue-example">
<tab-builder>
    <tb-tab label="Tab 1">
        Tab 1 content
    </tb-tab>
    <tb-tab label="Tab 2">
        <p>Tab 2 content</p>
    </tb-tab>
    <tb-link label="Link" url="//google.com"></tb-link>
</tab-builder>
</div>


## Component parameters

| Name       | Type     | Default              |Description        |
|------------|:--------:|----------------------|-------------------|
| **name**   | `String` | `'tab-builder-${i}'` | Tab builder ID.   |
| **active** | `Number` | `0`                  | Active item index |


## Component slots

### Default slot

All the content of default slot is passed to default slot of [tab-switcher](./tab-switcher.md)

### Toggler slots

All the toggler slots are similar to [tab-nav](./tab-nav.md) slots


## Language variables

```javascript
export default {
    TABS_HIDDEN_TOGGLER: '%s other'
}
```