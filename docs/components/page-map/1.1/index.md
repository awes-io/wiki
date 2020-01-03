# The &lt;page-map&gt; Component

It is a component for automatic content navigation. It creates anchor links from headings in the specified page area, provides scrolling to headings and shows the current position.

What this means in practice, you can see below:

![page-map](https://storage.googleapis.com/static.awes.io/docs/page-map.gif)


## Example of using the component

```html
<page-map content="#content"></page-map>
<div id="content">
    <h1>Heading</h1>
    <p>paragraph</p>
    <h2>Subheading</h2>
    <p>paragraph</p>
</div>
```

<div class="vue-example">
    <page-map content="#content" targets=".example-heading"></page-map>
    <div id="content">
        <h1 class="example-heading">Heading</h1>
        <p>paragraph</p>
        <h2 class="example-heading">Subheading</h2>
        <p>paragraph</p>
    </div>
</div>

## Component properties

| Name           | Type      | Default      | Description                                        |
|----------------|:---------:|:------------:|----------------------------------------------------|
| **content**    | `String`  | `'body'`     | CSS selector of the element with content for navigating |
| **exclude**    | `String`  | `undefined`  | CSS selector of elements to exclude from navigation. The element excludes if it matches selector or is a child of an element, that matches selector |
| **targets**    | `String`  | `'h1, h2, h3, h4, h5, h6'` | CSS selector of elements for navigating |
| **offset**     | `Number`  | `0`      | Offset in pixels from the heading after scrolling to it  |
| **sticky**     | `Boolean, Object` | `{top: 10}`       | It allows freezing of navigation in the container. You can pass a value of the offset from the top and bottom of the container, for example: `{top: 5, bottom: 10}` |

If the `sticky` parameter is specified and it is not false, but the container height of element is less than the window height or the free container space is less than the element height, the element will not be fixed.

## Component slots

The component has 2 named slots, called `before` and `after`, to render content before or after the links list

```html
<page-map content="#content">
    <template #before>
        <p>Before list</p>
        <hr>
    </template>
    <template #after>
        <hr>
        <p>After list</p>
    </template>
</page-map>
<div id="content">
    <h1>Heading</h1>
    <p>paragraph</p>
    <h2>Subheading</h2>
    <p>paragraph</p>
</div>
```

<div class="vue-example">
    <page-map content="#content" targets=".example-heading">
        <template #before>
            <p>Before list</p>
            <hr>
        </template>
        <template #after>
            <hr>
            <p>After list</p>
        </template>
    </page-map>
    <div id="content">
        <h1 class="example-heading">Heading</h1>
        <p>paragraph</p>
        <h2 class="example-heading">Subheading</h2>
        <p>paragraph</p>
    </div>
</div>