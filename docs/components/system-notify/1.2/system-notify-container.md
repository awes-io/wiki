# System Notify container

A container where notifications will appear. One container, called `default` is registered automatically. Other containers may be added if you need.

To create a custom default container, insert an element with your config

```html
<system-notify-container name="default" :config="{...}"></system-notify-container>
```

## Navigation
- [index](./index.md)
- **system-notify-container**
- [system-notify](./system-notify.md)


## Example

```html
<system-notify-container name="my-container"></system-notify-container>
```


## Properties

| Name        | Type              | Default     | Description |
|-------------|:-----------------:|:-----------:|-------------|
| **name(*)** | `String`          | `undefined` | Container identifier. Used to route natification appearance. Be aware of name collisions, it's not managed automatically. Or you can use it show notification in more than one place. |
| **stack**   | `String, Boolean` | `'bottom'`  | One of `'top'`, `'bottom'`, `'false' or false`. Position of new notify in stack or no stack, but one notify layout |
| **config**   | `Object`         | `undefined` | Overrides for defaults, provided in `AWES_CONFIG.notify` |
| **notify**   | `Object, Array`  | `undefined` | Sets initial notify (or an array of notifies) after component is mounted into the DOM, see [system-notify](./system-notify.md) for object schema |


## Positioning

**Default styles** include CSS-classes for fixed positioning of container in viewport. The describe themself:

- `.position-top-left`
- `.position-top-right`
- `.position-top-center`
- `.position-bottom-left`
- `.position-bottom-right`
- `.position-bottom-center`


## Slot

Container provides default slot for your own markup, and can be used like so

```html
<system-notify-container name="my-container">=
    <div class="my-notify" slot-scope="notify">
        <strong>{{ notify.title }}</strong> {{ notify.message }}
        <button class="my-notify__close" @click="notify.remove">close</button>
    </div>
</system-notify-container>
```

All data you pass to show notify, will be transfered to default scoped slot. Additionally, a `remove` method provided to remove notify from stack, and a property '_timeout' - `setTimeout` id, (can be cleared with `clearTimeout(notify._timeout)` to prevent auto-removing).
