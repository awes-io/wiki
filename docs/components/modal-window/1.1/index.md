# The &lt;modal-window&gt; Component

It is a modal window component with a tracked history. Below you will see a visual presentation of the modal window component.

![modal-window](https://storage.googleapis.com/static.awes.io/docs/modal.gif)


<h2 id="mw-example">Example of using the component</h2>

### For standalone usage

```javascript
import Vue from 'vue'
import VueRouter from 'vue-router' // required
import modalWindow from '@awes-io/modal-window'
import '@awes-io/modal-window/dist/main.css' // optionally, for default styling

Vue.use(VueRouter) // required
Vue.use(modalWindow, { /* optional config */}) // registers `<modal-window>` component globally
```

### For AwesDotIo
include CDN-script, provided by the [platform](//awes.io)

```html
<modal-window ref="modal">
    Text in the modal window
</modal-window>

<!-- direct call of method for opening a modal window (not recommended) -->
<button @click="$refs.modal.open()">Open a window</button>


<modal-window name="my-modal">
    Text in the modal window
</modal-window>

<!-- emit the opening method in Event Bus (preferred method) -->
<button @click="$modals.$emit('modal::my-modal:open')">Open another window</button>
<!-- shorthand -->
<button @click="$modals.open('my-modal')">Open another window</button>


<!-- NOTE! if you using AwesDotIo, then you should use common Event Bus  -->
<button @click="AWES.emit('modal::my-modal:open')">Open another window</button>
```


<h2 id="mw-options">Component properties</h2>

| Name           | Type      | Default      | Description                       |
|----------------|:---------:|:------------:|-----------------------------------|
| **name**       | `String`  | modal-${uid} | The identifier of a modal window, used for calling or listening to events |
| **title**      | `String`  | `undefined`  | Heading in the modal window header |
| **theme**      | `String`  | `'default'`  | Styling modal appearance, simply adds additional class to the wrapper, e.g. `is-${theme}` |
| **param**      | `String`  | `'modal'`    | GET-parameter, that recieves a value of **name** param when window is opened. All the modals? by default, share the same GET-param. This means opening next modal closes previouse. |
| **stay**       | `Boolean` | `false`      | Should the content stay in markup, when window is closed. *Could be configured globally* |
| **bg-сlick-сlose** | `Boolean` | `true`   | Should the modal be closed by clicking on background. *Could be configured globally* |
| **lang**       | `Object`  | [lang](#mw-lang) | Overwrite default lang strings in current modal. *Could be configured globally* |

The properties, marked as **globally configured**, could be provided in `AWES_CONFIG` in camelCase. For example:

```javascript
const AWES_CONFIG = {

    // some other config...

    modalWindow: {
        stay: true,
        bgClickClose: false,
        // ... other options
    }
}
```


### Modal window ID

The identifier is used to open the window in program, as shown in the example above. This identifier also installs and tracks a hash in the browser address bar with the `modal_` prefix. Thus, you can build a page address when the modal window is open, for example, you can open the window from the example above using `http://url-of-page?modal=my-modal`.

If the `name` parameter is not passed, it will automatically be created, but it will be difficult to control. Therefore, we recommend you to always use the `name` parameter as well as monitor that they don’t duplicate on the same page, otherwise all modal windows with the same name will be opened and closed at the same time.

### Heading in the modal window header

It displays text in the modal window header. By default, it is not available and the modal window header contains only the Close button and the *Back* button if the `theme="fullscreen"` parameter is passed.

### Show a full-page window

If the `theme="fullscreen"` value is passed, a window will have a full-page view and the `Back` button will appear in the modal window header, it will function like the button of the same name in the browser navigation.

### Slots

By default, a slot displays a content of the modal window, namely the whole area under the header.


<h2 id="mw-events">Component events</h2>

### In the global event bus:

| Name                             | Data                   | Description                       |
|----------------------------------|:----------------------:|-----------------------------------|
| **modal::${name}:open**          | -                      | The event is triggered for opening a modal window. The modal window is always subscribed to it, you can also add any other handlers to it |
| **modal::${name}:close**         | -                      | The event is triggered for closing a modal window. The modal window is always subscribed to it, you can also add any other handlers to it |
| **modal::${name}:before-close**  | `{ prevented: false }` | The event is triggered before closing a modal window in order to have the possibility to cancel the window closing |

### Vue events from the component

| Name              | Data                   | Description                                 |
|-------------------|:----------------------:|---------------------------------------------|
| **closed**        | -                      | The event is triggered after closing a modal window |
| **before-close**  | `{ prevented: false }` | The event is triggered before closing a modal window in order to have the possibility to cancel the window closing |

### Example of programmatic cancellation of the window closing

Let’s assume that a window with the `some-modal` ID should not be closed until the `someCondition` condition is fulfilled.

```javascript
function preventClose(event) {

    if ( ! someCondition ) {
        event.prevented = true
        alert('Not ready yet!')
    } else {
        this.$modals.$off('modal::some-modal.before-close', preventClose)
        // in AwesDotIo - AWES.off('modal::some-modal.before-close', preventClose)
    }
}

this.$modals.$on('modal::some-modal.before-close', preventClose)
// in AwesDotIo -AWES.on('modal::some-modal.before-close', preventClose)
```

### Custom Event Bus

If you use your own Event Bus, pass it to config, during initialization. This will prevent global event bus initialization

```javascript
import Vue from 'vue'
import modalWindow from '@awes-io/modal-window'
import { EventBus } from 'path-to-your-event-bus'

Vue.use(modalWindow, {
    eventBus: EventBus
})
```

> NOTE! The event bus should have `$on`, `$off`, and `$emit` methods

<h2 id="mw-lang">Language variables</h2>

To change captions for the "Close" and "Back" buttons of the modal window, you should override the language variables as follows:

```javascript
const AWES_CONFIG = {
    key: 'your_api_key',
    modalWindow: {
        // defaults
        lang: {
            MODAL_BACK: "Go back",
            MODAL_CLOSE: "Close modal (ESC)"
        }
    }
}
```

For standalone usage, default config is provided during plugin initialization

```javascript
import Vue from 'vue'
import modalWindow from '@awes-io/modal-window'

Vue.use(modalWindow, {
    lang: {
        MODAL_BACK: "Back",
        MODAL_CLOSE: "Close a modal window"
    }
})
```

<h2 id="mw-themes">Themes</h2>

Default CSS includes such themes as `default`, `fullscreen`, `aside`, `aside-medium` and `aside-large`.

You may provide your own themes, **theme** param only specifies CSS-classes, and nothing more, everything else is CSS-magic

```html

<!-- opened modal sets proper class on `body` element -->
<body class="has-modal-awesome">

    <!-- with theme class -->
    <aside class="modal is-awesome">
        <!-- other component markup -->
    </aside>

</body>
```

Transition styling colud be done with proper [Vue transition component classes](https://vuejs.org/v2/guide/transitions.html#Transition-Classes), for this example they are:

* modal-transition-awesome-enter
* modal-transition-awesome-enter-active
* modal-transition-awesome-enter-to
* modal-transition-awesome-leave
* modal-transition-awesome-leave-active
* modal-transition-awesome-leave-to


## AJAX modal example

To show dynamically loading content, place a `&lt;content-wrapper/&gt;` component inside a modal.

> Note, that by default, content will be loaded **each time** modal is opened.
> But if you use modal with `stay` prop turned on - content will be loaded **once**, after the page load

```html
<modal-window name="ajax-example" title="AJAX modal">

    <!-- dynamic content -->
    <content-wrapper url="https://jsonplaceholder.typicode.com/users">

        <!-- loading state stylization -->
        <template slot="loading">
            <div class="h1 text-center">Loading...</div>
        </template>

        <!-- content -->
        <template slot-scope="ajaxData">
            <table-builder :default="ajaxData.data">
                <tb-column name="name"></tb-column>
                <tb-column name="email">
                    <template slot-scope="col">
                        <a :href="`mailto:${col.data.email}`">{{ col.data.email }}</a>
                    </template>
                </tb-column>
            </table-builder>
        </template><!-- / content -->

    </content-wrapper>
</modal-window>
```

<div class="vue-example">
    <button class="btn" @click="AWES.emit('modal::ajax-example:open')">AJAX modal</button>
    <modal-window name="ajax-example" title="AJAX modal">
        <content-wrapper url="https://jsonplaceholder.typicode.com/users">
            <template slot="loading">
                <div class="h1 text-center">Loading...</div>
            </template>
            <template slot-scope="ajaxData">
                <table-builder :default="ajaxData.data">
                    <tb-column name="name"></tb-column>
                    <tb-column name="email">
                        <template slot-scope="col">
                            <a :href="`mailto:${col.data.email}`">{{ col.data.email }}</a>
                        </template>
                    </tb-column>
                </table-builder>
            </template>
        </content-wrapper>
    </modal-window>
</div>