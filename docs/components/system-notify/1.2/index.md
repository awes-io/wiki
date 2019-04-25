# Awesome notifications plugin

Adds ability to show notifications to improve user experience.

![system-notify](https://storage.googleapis.com/static.awes.io/docs/system-notify.gif)

Replaces default `AWES.notify()` method (shows system alert).


## Components

- **index**
- [system-notify-container](./system-notify-container.md)
- [system-notify](./system-notify.md)


## Installation

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- recommended -->
        <link rel="dns-prefetch" href="https://cdn.pkgkit.com">
        <link rel="preconnect" href="https://cdn.pkgkit.com">

        <!-- notify styles (or you can use your own) -->
        <link rel="stylesheet" href="https://cdn.pkgkit.com/API_KEY/awes-io/system-notify/v1.x.x/css/main.css">

        <!-- config -->
        <script>
            const AWES_CONFIG = {
                key: 'API_KEY', // (required)
                notify: {
                    // pass your defaults here, if you need (not required)
                }
            }
        </script>

        <!-- core (required) -->
        <script async src="https://cdn.pkgkit.com/API_KEY/awes-io/base-js/v1.x.x/js/main.js"></script>

        <!-- notify script (required) -->
        <script async src="https://cdn.pkgkit.com/API_KEY/awes-io/system-notify/v1.x.x/js/main.js"></script>
    </head>
    <body>

    </body>
</html>
```

Now you can show notify like so:

```javascript
// string, to show as `message` text in default container with default config
AWES.notify('This is my message...')

// object to configure notify
AWES.notify({status:'error', title: 'Oh no!', message:'Something went wrong...'})
```

## Styling

Default styles include transitions, container positioning ( see [system-notify-container](./system-notify-container.md) ) and basic theming ( see [system-notify](./system-notify.md) for details ).

It could be customized with CSS custom properties

```css

/* default values are: */

.system-notify {

    /* first looks for --tc_ui_font for compatibility with AWES Indigo Layout component,
       then uses internal (default browser font) */
    --font: var(--tc_ui_font, system-ui, -apple-system, Segoe UI, Roboto, sans-serif);

    --title_size: 16px;
    --text_size: 12px;

    --success_bg: #7fc876
    --success_text: #fff

    --error_bg: #f36161
    --error_text: #fff

    --info_bg: #edc252
    --info_text: #fff

    --warning_bg: #4e93e0
    --warning_text: #fff

    --progress_overlay: rgba(0,0,0,.1)
}

```


## Config

You are able to set default values for all notifications in `AWES_CONFIG.notify`, keys are the same as [system-notify](./system-notify.md) properties

```javascript
const AWES_CONFIG = {

    /* ... */

    // default values
    notify: {
        status: 'success',
        timeout: 5000
    }
}
```

Next, default config is merged with [system-notify-container](./system-notify-container.md) `config` property, in such a way, that container's keys overwrite defaults.

Finally, the config, provided in `AWES.notify()` method, overwrites default and container's one.
