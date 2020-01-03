# Theme switcher

It switches a theme from dark to light and vice versa, adding or removing the `[data-dark="true"]` attribute in the page’s root element. Watches `@media (prefers-color-scheme: dark)` media-query

![theme-switcher](https://storage.googleapis.com/static.awes.io/docs/theme-switcher.gif)


## Input value

The `theme-switcher` checks the enabled theme in the following order:

1. `AWES_CONFIG.theme.isDark`
2. Cookie `theme_dark` (for the domain specified in the configuration)


## Domain for installation of cookie

To make cookie available in different subdomains of one domain, you should set the following value for the domain:

```javascript
AWES_CONFIG = {
    theme: {
        domain: '.mydomain.com'
    }
}
```

If a point is used at the beginning of a value, the cookie will be available in all subdomains of `mydomain.com`, for example:

1. www.mydomain.com
2. admin.mydomain.com
3. and others...

If a value is not specified, the cookie will be installed for the current domain.


## Software switching between the themes

The current value is stored in the `AWES._themeDark` global variable. To change the theme, you should pass a new value. There are two possible options: 0 or 1.

If a new value is not equal to 0 or 1, or it is equal to the current value, switching will not take place and the switching event will not be triggered.


## Events when switching between the themes

When the switching takes place, the `theme.change` event is triggered in the `AWES` event bus, and a new value `AWES._themeDark`is passed to this event. The subscription to this event can be made, for example, as follows:

```javascript
AWES.on('theme.change', function(event){
    console.log(event.detail) // current value is AWES._themeDark
})
```

When switching between the themes, the Vue event `input` with a new value `AWES._themeDark` is triggered in the switcher component, and to this event you can attach a switcher.

```html
<theme-switcher
    @input="onThemeSwitch"
></theme-switcher>
```

## Properties of the switcher component

### Default slot

By default, you can transfer a text or HTML code to the slot in order to change the standard text in the switcher.

```javascript
<theme-switcher>Dark theme</theme-switcher>
```

If you need to display different values depending on the active theme, you should use scoped-slot as in the example below:

```javascript
<theme-switcher>
    <template slot-scope="theme">
        <span v-if="theme.isDark">Dark theme</span>
        <span v-else>Light theme</span>
    </template>
</theme-switcher>
```
### Default text in the switcher

You can globally configure the text in all switchers using `AWES_CONFIG`. The correct code should look like follows:

```javascript
AWES_CONFIG = {
    lang: {
        THEME_SWITCHER_DEFAULT: 'Switch theme'
    }
}
```

## Meta tags for a theme color

To automatically add meta tags such as

```html
<meta name="theme-color" content="${color}">
<meta name="msapplication-navbutton-color" content="${color}">
```
you should add the following lines of code to the settings:

```javascript
AWES_CONFIG = {
    theme: {
        metaColor: {
            dark: '#2a2a2a',
            light: '#ffffff'
        }
    }
}
```