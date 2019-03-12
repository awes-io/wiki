# The &lt;tab-builder&gt; Component

This component provides mechanism to switch between tabs. It is used in conjunction with [&lt;tb-tab&gt;](#tab-tbtab) and [&lt;tb-link&gt;](#tab-tblink). It automatically generates tabs from the default slot and ensures that they fit in a browser window within one line. The switchers which don’t fit in will be set in the special hidden switcher in the form of a dropdown list.

![tab-builder](https://storage.googleapis.com/static.awes.io/docs/tab-builder.gif)

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


## Component slots

### Default slot

It is intended for inserting only such components as [&lt;tb-tab&gt;](#tab-tbtab) and [&lt;tb-link&gt;](#tab-tblink). Any other content will be ignored. The top-down order in which the components are placed in this slot determines the order of buttons, namely the order from left to right in the tab switchers and the top-down order in the hidden switcher.

### The `tab-toggler` slot of visible switchers 

The tab-toggler slot should be placed within the tab-builder component. The code snippet for the slot of this type should look like:

```html
<tab-builder>
    <template slot="tab-toggler" slot-scope="toggler">
        {{ toggler.item.label }}
        {{ toggler.isActive ? '&checkmark;' : '&times;'}}
    </template>
    <tb-tab label="Tab 1">
        Tab 1 content
    </tb-tab>
    <tb-tab label="Tab 2">
        <p>Tab 2 content</p>
    </tb-tab>
</tab-builder>
```

<div class="vue-example">
<tab-builder>
    <template slot="tab-toggler" slot-scope="toggler">
        {{ toggler.item.label }}
        {{ toggler.isActive ? '&checkmark;' : '&times;'}}
    </template>
    <tb-tab label="Tab 1">
        Tab 1 content
    </tb-tab>
    <tb-tab label="Tab 2">
        <p>Tab 2 content</p>
    </tb-tab>
</tab-builder>
</div>

#### Parameters passed to the slot

| Name           | Type      | Description                                                        |
|----------------|:---------:|--------------------------------------------------------------------|
| **item.label** | `String`  | Caption of the tab switching button                                |
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
| **label**      | `String`  | Caption for the button in the hidden switcher |
| **activeTab**  | `Number`  | Index of active item                   |


<h2 id="tab-tbtab">The &lt;tb-tab&gt; Component</h2>

### Properties

| Name         | Type     | Default      | Description                           |
|--------------|:--------:|:------------:|---------------------------------------|
| **label(*)** | `String` | `undefined`  | Caption for the tab switching button  |


<h2 id="tab-tblink">The &lt;tb-link&gt; Component</h2>

### Properties

| Name         | Type     | Default      | Description         |
|--------------|:--------:|:------------:|---------------------|
| **label(*)** | `String` | `undefined`  | Text within link    |
| **url(*)**   | `String` | `undefined`  | Link address        |


## Language variables

```javascript
export default {
    TABS_HIDDEN_TOGGLER: '%s other'
}
```