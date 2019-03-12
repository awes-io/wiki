# The &lt;modal-window&gt; Component

It is a modal window component with a tracked history. Below you will see a visual presentation of the modal window component.

![modal-widndow](https://storage.googleapis.com/static.awes.io/docs/modal.gif)


<h2 id="mw-example">Example of using the component</h2>

```html
<modal-window ref="modal">
    Text in the modal window
</modal-window>

<!-- direct call of method for opening a modal window (not recommended) -->
<button @click="$refs.modal.open()">Open a window</button>


<modal-window name="good-modal">
    Text in the modal window
</modal-window>

<!-- call of the event for opening a modal window (preferred method) -->
<button @click="AWES.emit(modal::good-modal.open)">Open another window</button>
```


<h2 id="mw-options">Component properties</h2>

| Name           | Type      | Default      | Description                       |
|----------------|:---------:|:------------:|-----------------------------------|
| **name**       | `String`  | modal-${uid} | The identifier of a modal window, used for calling or listening to events |
| **title**      | `String`  | `undefined`  | Heading in the modal window header |
| **fullscreen** | `Boolean` | `false`      | Show a full-page window           |

### Modal window ID

The identifier is used to open the window in program, as shown in the example above. This identifier also installs and tracks a hash in the browser address bar with the `modal_` prefix. Thus, you can build a page address when the modal window is open, for example, you can open the window from the example above using `http://url-of-page#modal_good-modal`.

If the `name` parameter is not passed, it will automatically be created, but it will be difficult to control. Therefore, we recommend you to always use the `name` parameter as well as monitor that they don’t duplicate on the same page, otherwise all modal windows with the same name will be opened and closed at the same time.

### Heading in the modal window header

It displays text in the modal window header. By default, it is not available and the modal window header contains only the Close button and the *Back* button if the `fullscreen` parameter is passed.

### Show a full-page window

If the `true` value is passed, a window will have a full-page view and the `Back` button will appear in the modal window header, it will function like the button of the same name in the browser navigation.

### Slots

By default, a slot displays a content of the modal window, namely the whole area under the header.


<h2 id="mw-events">Component events</h2>

### In the global event bus:

| Name                             | Data                   | Description                       |
|----------------------------------|:----------------------:|-----------------------------------|
| **modal::${name}.open**          | -                      | The event is triggered for opening a modal window. The modal window is always subscribed to it, you can also add any other handlers to it |
| **modal::${name}.close**         | -                      | The event is triggered for closing a modal window. The modal window is always subscribed to it, you can also add any other handlers to it |
| **modal::${name}.before-close**  | `{ prevented: false }` | The event is triggered before closing a modal window in order to have the possibility to cancel the window closing |

### Vue events from the component

| Name              | Data                   | Description                                 |
|-------------------|:----------------------:|---------------------------------------------|
| **closed**        | -                      | The event is triggered after closing a modal window |
| **before-close**  | `{ prevented: false }` | The event is triggered before closing a modal window in order to have the possibility to cancel the window closing |

### Example of software cancellation of the window closing

Let’s assume that a window with the `some-modal` ID should not be closed until the `someCondition` condition is fulfilled.

```javascript
function preventClose(event) {

    if ( ! someCondition ) {
        event.prevented = true
        alert('Not ready yet!')
    } else {
        AWES.off('modal::some-modal.before-close', preventClose)
    }
}

AWES.on('modal::some-modal.before-close', preventClose)
```


<h2 name="mw-lang">Language variables</h2>

To change captions for the "Close" and "Back" buttons of the modal window, you should override the language variables as follows:

```javascript
const AWES_CONFIG = {
    key: 'your_api_key',
    lang: {
        MODAL_BACK: "Back",
        MODAL_CLOSE: "Close a modal window"
    }
}
```