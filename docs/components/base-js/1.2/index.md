# JS-core package

The JS-core package is intended for downloading application components and their synchronization via the event bus.


## <a name="bjs-add"></a> JS-core installation

To use the application, you should specify a project key in the `AWES_CONFIG.key` global variable. Below you can find an example of using such a key in your HTML document:

``` html
<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>

        <!-- config (it should be defined before JS-core) -->
        <script>
        const AWES_CONFIG = {
            key: 'your_project_key_goes_here'
        }
        </script>

        <!-- JS-core script -->
        <script src="https://storage.awes.io/your_project_key_goes_here/awes-core/v0.x.x/js/main.js" async></script>
    </head>
    <body>

    </body>
</html>
```


## <a name="bjs-plugin"></a> Example of using component

``` javascript
// IIFE for the local visibility scope
(function(){

    const plugin = {

        // List of dependencies required for the work of component
        modules: {
            'vue': 'https://unpkg.com/vue@2.5.21/dist/vue.js',
            'lodash': 'https://unpkg.com/lodash@4.17.11/lodash.min.js',
            'vuex': {
                src: 'https://unpkg.com/vuex@2.5.0/dist/vuex.js',
                deps: ['vue']
            },
            'vue-shortkey': {
                src: 'https://unpkg.com/vue-shortkey@3.1.6',
                deps: ['vue'],
                cb: function() {
                    Vue.use(VueShortkey)
                }
            }
        },

        // At first JS-core will load all the modules from the Modules object and then it will run the Install function where it will transmit itself as an argument
        install( AWES ) {
            AWES.on('test', function(e){
                console.log('From plugin 1 ', e.detail);
            })
        }
    }

    // In case JS-core hasn’t loaded asynchronously, the component will be placed in the window.__awes_plugins_stack__ queue
    if ( 'AWES' in window ) {
        AWES.use(plugin)
    } else {
        window.__awes_plugins_stack__ = window.__awes_plugins_stack__ || []
        window.__awes_plugins_stack__.push(plugin)
    }
})()
```

### <a name="bjs-modules"></a> Installation of modules

For loading modules the [loadjs](https://github.com/muicss/loadjs) library is used. It is a tiny async loading library for modern browsers.

The component modules are loaded automatically. If you need to load some additional modules to your software, you can use the `AWES.utils.loadModules` global method which returns the `Promise`(allowed when loading all the modules).

``` javascript
modules: {

    // simple loading, without depending on any other modules and the callback function
    module_name: {
        src: 'http://cdn.url-to-module',
    }
    // can also be written in a simplified form
    module_name: 'http://cdn.url-to-module',


    // To load the module only after loading all other modules on which it depends, you should specify the array of dependencies‘ names
    depend_on: 'http://cdn.url-to-module'
    dependent: {
        src: 'http://cdn.url-to-dependent-module',
        deps: ['depend_on']
    }


    // If you need to perform any actions after loading the module, please specify the callback function
    module_name: {
        src: 'http://cdn.url-to-module',
        cb: function() {
            Module.init()
        }
    }
}
```


## <a name="bjs-event-bus"></a> Event bus

The event bus is used for modules interaction. It is accessible through the `AWES` global variable. The mechanism of the event bus work is based on the  [CustomEvent](https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent) constructor. *If your browser does not support CustomEvent, the polyfill will be installed* **automatically**. Example of use:

``` javascript
// Subscription to an event
AWES.on('someEvent', handler)

// Unsubsctiption to an event
AWES.off('someEvent', handler)

// Onetime subscription
AWES.once('someEvent', handler)

// Event triggering
AWES.emit('someEvent')
```

It is possible to pass arguments to the event handler. See example below:

``` javascript
AWES.on('double', function($event){
    console.log( $event.detail * 2 );
})

AWES.emit('double', 123)
// The value in the console will be 246
```


## <a name="bjs-ajax"></a> AJAX request to the server

The `AWES.ajax` global method sends a request to the server and returns the Promise which may be used not only when a response is successful, but also when an error occurs. You can define the response status by the `success` property. The mechanism is implemented through the [axios](https://github.com/axios/axios) library (Promise based HTTP client for the browser and node.js).

*If your browser does not support the Promise, the polyfill will be installed* **automatically**. Let us consider an example.

``` javascript
AWES.ajax({param1: 'param one', param2: 'param two'}, '/url-for-request', 'patch')
    .then( function(data) {
        console.log(data.success); // returns true if executed successfully or false in case of error
    })
```

The third parameter of sending data is HTTP. It is not required and by default is equal to `post`.

When sending a request, the `core:ajax` event handlers with the value 'true' are called in the global bus. After response from the server the event handlers with the `false` value are called. These events are used in the component to display the loading indicator. When sending a request, an event is called with a delay which you can configure in `AWES_CONFIG`. If server doesn’t respond within a certain time, the request will return `TIMEOUT_ERROR`. Below is an example of how to configure a delay in `AWES_CONFIG`.

```javascript
const AWES_CONFIG = {
    key: 'your_api_key',
    ajax: {
        loadingDelay: 200, // ms, default value
        serverRequestTimeout: 30000 // 30s, default value
    }
}
```

### Automatic notifications

If you receive the `message` field in the response, it will be automatically displayed by the [AWES.notify](#bjs-notify) function with  the `success` or `error` status, depending on the server response.

### Redirection in the response

If you receive the `redirectUrl` field in the response, the browser will be redirected to the specified page and the notifications will not be displayed in this step.


## <a name="bjs-lang"></a> Language variables

To change the language variables, override them in `AWES_CONFIG` as in the example below:

```javascript
const AWES_CONFIG = {
    key: 'your_api_key',
    lang: {
        TIMEOUT_ERROR: "Time is out..."
    }
}
```

You can get all language variables in the `AWES.lang` global variable.

To add new variables, assign a new value to the `AWES.lang` variable. In this case the existing variables will not be overridden, but instead new variables will be added. For the example above:

```javascript
AWES.lang = {
    TIMEOUT_ERROR: "New value!!",
    NEW_VAR: "New variable"
}
console.log(AWES.lang) // { TIMEOUT_ERROR: "Time is out...", NEW_VAR: "New variable" }
```


## <a name="bjs-lang"></a> Notifications

For displaying the notifications the `AWES.notify` function is used. It can be overridden in order to use third-party libraries. But you should note that the core functions pass only two parameters to the notification:

```javascript
/**
 * @param {Object} notification
 * @param {string} notification.status - base-js sends 'success' and 'error'
 * @param {string} notification.message - any message to show
 */

AWES.notify({
    status: 'success',
    message: 'Successful message'
})
```