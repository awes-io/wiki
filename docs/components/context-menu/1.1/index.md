# Context menu component (context-menu)

The context menu component is designed to display hidden by default list by clicking the button.

![context-menu](https://storage.googleapis.com/static.awes.io/docs/context-menu.gif)


## Minimal markup

The component consists of a drop-down wrapper and elements. Without elements inside
wrappers, it doesn't make sense, so the minimal markup looks like


```html
<context-menu>
    <cm-button>Click me!</cm-button>
</context-menu>
```

**Appearance**

<div class="vue-example">
<context-menu>
    <cm-button>Click me!</cm-button>
</context-menu>
</div>

**Generated markup**

```html
<div class="context-menu">
    <button aria-haspopup="true" class="context-menu__toggler context-menu__toggler-default">
       <i class="icon icon-dots"></i>
    </button>
    <div aria-expanded="false" class="context-menu__dropdown" style="display: none;">
        <ul class="context-menu__list">
            <li class="cm-item">
                <button class="cm-item__button">Click me!</button>
            </li>
        </ul>
    </div>
</div>
```

*Opening* of the drop-down list is performed by pressing the opening button, *closing* it - by clicking on the same button, link or button among [the context menu items](#elements) or by clicking outside the drop-down menu.


## Wrapper component parameters `<context-menu>`

| Name          | Type        | Default      | Description  |
|---------------|-------------|--------------|------------|
| button-class  | **String**  | *undefined*  | Additional class for the button that opens list |
| right         | **Boolean** | `false`      | Priority in [locating the list](#positioning-info) on the right border from the button that opens list |
| top           | **Boolean** | `false`      | Priority in opening the list upward [to be](#positioning-info) at the top of the opening button |
| auto-position | **Boolean** | `true`       | [Automatic positioning](#positioning-auto) of the list depending on the specified boundaries and visibility on the screen  |
| boundary      | **String**  | `body`       | Element selector - [boundaries](#positioning-bounds) for automatic list positioning |
| relocate      | **Boolean** | `true`       | By default, dropdown will be appended to body element when opened. To disable this behaviour set `:relocate="false"`. It may be useful in fixed elements with it's own scroll |


## Positioning on the screen

The drop-down list is located relative to the opening button, and by default adjoins the lower and left borders and opens downwards.

**Layout options**

**By default**

<div class="vue-example">
<context-menu :auto-position="false">
    <cm-button>Click me!</cm-button>
</context-menu>
</div>

**Top (`top`)**

<div class="vue-example">
<context-menu top :auto-position="false">
    <cm-button>Click me!</cm-button>
</context-menu>
</div>

**Right (`right`)**

<div class="vue-example">
<context-menu right :auto-position="false">
    <cm-button>Click me!</cm-button>
</context-menu>
</div>

**Top right (`top`, `right`)**

<div class="vue-example">
<context-menu top right :auto-position="false">
    <cm-button>Click me!</cm-button>
</context-menu>
</div>

**Automatic positioning**
The specified position is only a recommendation if `auto-position = true` parameter is enabled. If at a given position the drop-down list does not appear in the visibility area or does not fit into [a restrictive container](#positioning-bounds), it'll change its position so that it could:
1) appear on the screen as visible as possible
2) fit into the [boundaries](#positioning-bounds)

<div id="positioning-bounds"></div>

**Restrictive container**
The `boundary` property is a boundary selector, by default, or if an element is not found among the parents of the component by the selector, this container is a `body` page container.

*The drop-down list cannot be expanded downwards and to the right, but can fit into the boundaries so it opens up and to the left*

<div class="vue-example">
<div id="example-bounds" style="padding:50px 15px 15px; height: 100px; width: 300px; border: 1px solid gray">
    <context-menu style="float: right" boundary="#example-bounds">
        <cm-button>Click me!</cm-button>
    </context-menu>
</div>
</div>

*The drop-down list cannot fit into the boundaries when it opens up and to the left, so it opens down and to the left (this is a priority direction), trying also to be displayed as the most visible on the screen.*

<div class="vue-example">
<div id="example-bounds" style="padding:10px; height: 50px; width: 50px; border: 1px solid gray">
    <context-menu top right boundary="#example-bounds">
        <cm-button>Click me!</cm-button>
        <cm-button>Click me too!</cm-button>
        <cm-button>Click me too!</cm-button>
    </context-menu>
</div>
</div>


## Context menu items

### Button &lt;cm-button&gt;

```html
<context-menu>
    <cm-button @click="someMethod">Click me!</cm-button>
</context-menu>
```

*Properties of the `<cm-button/>` item*

| Name         | Type        | Default      | Description                          |
|:------------:|:-----------:|:------------:|--------------------------------------|
| itemClass    | **String**  | *undefined*  | Additional class for the button      |

Event handlers should be attached to the item and additional attributes can be added. Without a handler, clicking on the button will simply close the open menu. This is the kind of markup used

```html
<cm-button
         class="list-item-class"
         item-class="item-class"
         aria-label="Awesome Button!"
         @click="$notify({group: 'right-b', type: 'sucсess', title: 'Notification!'})">
     Send notification
</cm-button>
```
<div class="vue-example">
<context-menu>
    <cm-button
             class="list-item-class"
             item-class="item-class"
             aria-label="Awesome Button!"
             @click="$notify({group: 'right-b', type: 'sucсess', title: 'Notification!'})">
        Send notification
    </cm-button>
</context-menu>
</div>

It will be generated into such HTML, by clicking the `someMethod` method will be called:
```html
<li class="cm-item list-item-class">
    <button aria-label="Awesome Button!" class="cm-item__button item-class">
        Send notification
    </button>
</li>
```


### Link &lt;cm-link&gt;

```html
<context-menu>
    <cm-link href="https://some.url">This is a link elemen</cm-link>
</context-menu>
```

<div class="vue-example">
<context-menu>
    <cm-link href="https://google.com" target="_blank" rel="nofollow noopener">
         This is a link element
    </cm-link>
</context-menu>
</div>

*Properties of the `<cm-link/>` item*

| Name         | Type        | Default      | Description                          |
|:------------:|:-----------:|:------------:|--------------------------------------|
| itemClass    | **String**  | *undefined*  | Additional class for the link        |
| href*        | **String**  | *undefined*  | url or an anchor, required property  |

It is also possible to hang event handlers on the element and add additional attributes, for example, a markup like this

```html
<context-menu>
    <cm-link href="#anchor"
             class="list-item-class"
             item-class="item-class"
             data-prop="someProp"
             @click.prevent="someMethod">
         This is a link element
    </cm-link>
</context-menu>
```

<div class="vue-example">
<context-menu>
    <cm-link href="#anchor"
             class="list-item-class"
             item-class="item-class"
             data-prop="someProp"
             @click.prevent="someMethod">
         This is a link element
    </cm-link>
</context-menu>
</div>

It will be generated into such HTML, and by clicking a transition will not happen, instead `someMethod` method will be called:
```html
<li class="cm-item list-item-class">
    <a href="#anchor" data-prop="someProp" class="cm-item__link item-class">
        This is a link element
    </a>
</li>
```

### Separator &lt;cm-separator&gt;
```html
<context-menu>
    <cm-button>Above separator</cm-button>
    <cm-separator></cm-separator><!-- separator -->
    <cm-button>Below separator</cm-button>
</context-menu>
```

<div class="vue-example">
<context-menu>
    <cm-button>Above separator</cm-button>
    <cm-separator></cm-separator>
    <cm-button>Below separator</cm-button>
</context-menu>
</div>

### Panel &lt;cm-panel&gt;

The component is intended for placing content inside the context menu. See the example below.

```html
<context-menu>
    <cm-panel>
        Default panel
    </cm-panel>
    <cm-panel secondary>
        Secondary panel
    </cm-panel>
</context-menu>
```

<div class="vue-example">
<context-menu>
    <cm-panel>
        Default panel
    </cm-panel>
    <cm-panel secondary>
        Secondary panel
    </cm-panel>
</context-menu>
</div>

*Properties of the `<cm-panel/>` item*

| Name         | Type        | Default      | Description                          |
|:------------:|:-----------:|:------------:|--------------------------------------|
| secondary    | **Boolean** | `false`      | Changes the background color to a darker one |

Generated markup
```html
<li class="cm-item">
    <div class="cm-item__panel">
        Default panel
    </div>
</li>
<li class="cm-item">
    <div class="cm-item__panel is-secondary">
        Secondary panel
    </div>
</li>
```


### GET parameters in the address bar &lt;cm-query&gt;

The component is intended for inserting GET parameters into the address bar of the browser without reboot (e.g. for filtering or sorting), other components can monitor these parameters and update the data.

*Properties of the `<cm-query/>` item*

| Name         | Type        | Default      | Description                          |
|:------------:|:-----------:|:------------:|--------------------------------------|
| itemClass    | **String**  | *undefined*  | Additional class for the button      |
| param*       | **Object**  | *undefined*  | *Required Property*. Parameters that need to be substituted or be replaced in the address bar, and in case they coincide, the button shall become active. |


```html
<context-menu>
    <cm-query :param="{state: 'active'}">
        I am active
    </cm-query>
    <cm-query :param="{state: 'not-active'}">
        I am not active
    </cm-query>
</context-menu>
```

<div class="vue-example">
<context-menu>
    <cm-query :param="{state: 'active'}">
        I am active
    </cm-query>
    <cm-query :param="{state: 'not-active'}">
        I am not active
    </cm-query>
</context-menu>
</div>

This is how the HTML template of the button looks like:
```html
<li class="cm-item">
   <button class="cm-item__button is-active">
        I am active
    </button>
</li>
<li class="cm-item">
    <button class="cm-item__button">
        I am not active
    </button>
</li>
```

### AJAX request &lt;cm-ajax&gt;

The component is intended for sending data to the server with the possibility of calling the method for processing the received response, processing the `sended` event to which the response data are sent. The `serverRequest` mixin is used to send a request.

*Properties of the `<cm-ajax/>` item*

| Name         | Type        | Default      | Description                            |
|:------------:|:-----------:|:------------:|----------------------------------------|
| itemClass    | **String**  | *undefined*  | Additional class for the button        |
| params       | **Object**  | `{}`         | Data object to send                    |
| url*         | **String**  | *undefined*  | *Required parameter*. Request address  |
| method       | **String**  | `get`        | The method for conducting the request; is limited to `get`, `put`, `post`, `delete`, `patch` options          |


*Events called by the `<cm-ajax/>` item*
| Name         | Arguments        | Description                                                    |
|:------------:|:----------------:|----------------------------------------------------------------|
| sended       | data (`Object`)  | Is called after receiving a response and transmits the received data  |

```html
<context-menu>
    <cm-ajax
        method="post"
        url="https://httpbin.org/post"
        :params="{param1: 'one', param2: 'two'}"
        @sended="({ data }) => $notify({ group:'right-b', text: JSON.stringify(data) })">
        Send request
    </cm-ajax>
</context-menu>
```

<div class="vue-example">
<context-menu>
    <cm-ajax
        method="post"
        url="https://httpbin.org/post"
        :params="{param1: 'one', param2: 'two'}"
        @sended="({ data }) => $notify({ group:'right-b', text: JSON.stringify(data) })">
        Send request
    </cm-ajax>
</context-menu>
</div>


Below you can see the result in HTML
```html
<li class="cm-item">
    <button class="cm-item__button">
        Send request
    </button>
</li>
```

## Styling of the opening button

The button that opens the context menu can be changed using a <a href="https://ru.vuejs.org/v2/guide/components-slots.html" target="_blank">slot</a> named `toggler`.
The content of the slot is placed inside the `<button>` tag, so it should not contain semantically-block elements (`<div>`). Block content must be represented as `<span style="display:block;">`

**Example**

```html
<context-menu>
    <span slot="toggler" class="new-toggler">Open me</span>
    <cm-button>
        Click me!
    </cm-button>
</context-menu>

<style>
.new-toggler {
    display: inline-block;
    color: white;
    background-color: lightseagreen;
    border: 1px solid aqua;
    padding: 5px 15px;
    margin-bottom: 3px;
    border-radius: 15px;
    height: 30px;
}
</style>
```

<div class="vue-example">
<context-menu>
    <span slot="toggler" style="display: inline-block; color: white; background-color: lightseagreen; border: 1px solid aqua; padding: 5px 15px; margin-bottom: 3px; border-radius: 15px; height: 30px;">Open me</span>
    <cm-button>
        Click me!
    </cm-button>
</context-menu>
</div>
