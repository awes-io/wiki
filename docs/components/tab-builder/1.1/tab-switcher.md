# The &lt;tab-switcher&gt; component

This component shows content of `active` tab and provides transition between tabs


## Components

- [tab-builder](./tab-builder.md)
- [tab-nav](./tab-nav.md)
- **tab-switcher**


## Component parameters

| Name       | Type     | Default | Description       |
|------------|:--------:|---------|-------------------|
| **active** | `Number` | `0`     | Which tab to show |


## Default slot

It is intended for inserting only such components as [&lt;tb-tab&gt;](#tab-tbtab) and [&lt;tb-link&gt;](#tab-tblink). Any other content will be ignored. The top-down order in which the components are placed in this slot determines the order of buttons, namely the order from left to right in the tab switchers and the top-down order in the hidden switcher.


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