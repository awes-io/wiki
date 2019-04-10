# AWES Notify

The component used internally by [awes-notify-container](./awes-notify-container.md)


## Navigation
- [index](./index.md)
- [awes-notify-container](./awes-notify-container.md)
- **awes-notify**


## Properties

All properties are passed in `AWES.notify({/* message or options */})` method or `AWES.emit('notify::container-name:show', {/* options */})`

| Name          | Type            | Default     | Description                                    |
|---------------|:---------------:|:-----------:|------------------------------------------------|
| **title**     | `String`        | `undefined` | Title (text only)                              |
| **message**   | `String`        | `undefined` | Message (text or html, except `<script>` tags) |
| **status**    | `String`        | `'success'` | Default `success`, `warning`, `info`, `danger` or `error` (alias for `danger`) or your own status |
| **container** | `String`        | `'default'` | Container `name`, where to show message |
| **theme**     | `String, Array` | `undefined` | Default `rounded`, `inline`, `progress`, or your own theme. Could be a string of comma-separated values or an array. You may provide your own modifiers, but note, that class will be transformed like `'theme-' + yourOwnModifier` |
| **timeout**   | `String`        | `5000`      | Time in milliseconds, before notify automatically disappears |
| **button**    | `Object, Array` | `undefined` | Special object, to construct buttons with ajax calls, see below |

All the properties override the defaults provided in `AWES_CONFIG.notify` and `<awes-notify-container config="..."/>`.

## Button

To add a special button(s) after notify message, provide a button object (array of objects), like so:

```javascript
AWES.notify({
    message: 'Message',
    // button example
    button: {
        text: 'My button', // required
        url: '/my-action-url', // required
        data: { param: 'some param' }, // if needed
        method: 'patch'// if needed, POST by default
    }
})
```

Click on a button like this sends AJAX-request, using `AWES.ajax()` method and when the request ends up with a `message` field in response, it is shown in the same container with default container's params


## Themes example

The picture describes best

<img class="tf-img" src="https://storage.googleapis.com/static.awes.io/docs/awes-notify_themes_and_statuses.png" alt="AWES-notify themes and statuses">
