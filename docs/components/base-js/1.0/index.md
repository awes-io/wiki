# Пакет JS-core

Предназначен для загрузки компонентов приложения и их синхронизации посредством шины событий

1. [Подключение JS-core](#bjs-add)
2. [Пример подключаемого плагина](#bjs-plugin)
3. [Подключение модулей](#bjs-modules)
4. [Шина событий](#bjs-event-bus)
5. [AJAX-запрос на сервер](#bjs-ajax)
6. [Языковые переменные](#bjs-lang)
7. [Уведомления](#bjs-notify)


## <a name="bjs-add"></a> Подключение JS-core

Для работы приложения необходимо указать ключ проекта в глобальной переменной `AWES_CONFIG.key`

``` html
<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>

        <!-- config ( должен быть определён раньше js-core ) -->
        <script>
        const AWES_CONFIG = {
            key: 'your_project_key_goes_here'
        }
        </script>

        <!-- js-core script -->
        <script src="https://storage.awes.io/your_project_key_goes_here/awes-core/v0.x.x/js/main.js" async></script>
    </head>
    <body>

    </body>
</html>
```


## <a name="bjs-plugin"></a> Пример подключаемого плагина

``` javascript
// IIFE для локальной области видимости
(function(){

    const plugin = {

        // Список зависимостей, необходимых для работы плагина
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

        // js-core сначала загрузит все модули их объекта modules, а затем запусит функцию install, в которую в качестве аргумента передает себя
        install( AWES ) {
            AWES.on('test', function(e){
                console.log('From plugin 1 ', e.detail);
            })
        }
    }

    // На случай, если js-core не успел загрузиться асинхронно, плагин помещается в очередь window.__awes_plugins_stack__
    if ( 'AWES' in window ) {
        AWES.use(plugin)
    } else {
        window.__awes_plugins_stack__ = window.__awes_plugins_stack__ || []
        window.__awes_plugins_stack__.push(plugin)
    }
})()
```

### <a name="bjs-modules"></a> Подключение модулей

Для загрузки модулей используется библиотека [loadjs](https://github.com/muicss/loadjs)

Модули плагина загружаются автоматически, если необходимо программно загрузить дополнительные модули, использется глобальный метод `AWES.utils.loadModules`, который возвращает `Promise`(разрешается при загрузке всех модулей)

``` javascript
modules: {

    // простая загрузка, без зависимости от других модулей и функции обратного вызова
    module_name: {
        src: 'http://cdn.url-to-module',
    }
    // также может быть записана в упрощенном виде
    module_name: 'http://cdn.url-to-module',


    // Если нужно загрузить модуль, только после загрузки других модулей, от которых он зависит, необходимо указать массив имен зависимостей
    depend_on: 'http://cdn.url-to-module'
    dependent: {
        src: 'http://cdn.url-to-dependent-module',
        deps: ['depend_on']
    }


    // Если нужно выполнить какие-то действия после загрузки модуля, то нужно указать функцию обратного вызова
    module_name: {
        src: 'http://cdn.url-to-module',
        cb: function() {
            Module.init()
        }
    }
}
```


## <a name="bjs-event-bus"></a> Шина событий

Для взаимодействия модулей друг с другом используется шина событий, которая доступна через глобальную переменную `AWES`. Механизм работы основан на [CustomEvent](https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent) *Если браузер не поддерживает CustomEvent, полифилл установится* **автоматически**

``` javascript
// Подписка на событие
AWES.on('someEvent', handler)

// Отмена подписки на событие
AWES.off('someEvent', handler)

// Единоразовая подписка
AWES.once('someEvent', handler)

// Запуск события
AWES.emit('someEvent')
```

В обработчик события можно передавать аргументы

``` javascript
AWES.on('double', function($event){
    console.log( $event.detail * 2 );
})

AWES.emit('double', 123)
// В консоли будет 246
```


## <a name="bjs-ajax"></a> AJAX-запрос на сервер

Глобальный метод `AWES.ajax` оправляет запрос на сервер и возвращает Promise, который разрешается как при успешном ответе так и при ошибке. Определить статус ответа можно по свойству `success`. Механизм реализован через библиотеку [axios](https://github.com/axios/axios).

*Если браузер не поддерживает Promise, полифилл установится* **автоматически**

``` javascript
AWES.ajax({param1: 'param one', param2: 'param two'}, '/url-for-request', 'patch')
    .then( function(data) {
        console.log(data.success); // true при успешном ответе, false при ошибке
    })
```

Третий параметр - это HTTP-метод отправки данных, он не обязательный и по-умолчанию равен `post`

При отправке запроса, в глобальной шине вызываются обработкчики события `core:ajax` со значением 'true'. После ответа с сервера - со значением `false`. Эти события используются в компоненте для отображения индикатора загрузки. Событие при отправке вызывается с задержкой, которую можно настраивать в `AWES_CONFIG`. Если сервер не ответит втечение определенного времени, запрос вернет ошибку `TIMEOUT_ERROR`. Пример настройки

```javascript
const AWES_CONFIG = {
    key: 'your_api_key',
    ajax: {
        loadingDelay: 200, // ms, default value
        serverRequestTimeout: 30000 // 30s, default value
    }
}
```

### Автоматические уведомления

Если в ответе приходит поле `message`, оно автоматически отображается функцией [AWES.notify](#bjs-notify) со статусом `success` или `error`, в зависимости от ответа с сервера

### Переадресация в ответе

Если в ответе приходит поле `redirectUrl`, браузер перенаправляется на указанную страницу, при этом уведомления не выводятся


## <a name="bjs-lang"></a> Языковые переменные

Чтобы изменить языковые переменные их необходимо переодределить в `AWES_CONFIG`:

```javascript
const AWES_CONFIG = {
    key: 'your_api_key',
    lang: {
        TIMEOUT_ERROR: "Time is out..."
    }
}
```

Получить все языковые переменные можно в глобальной переменной `AWES.lang`

Добавить новые переменные можно просто присвоив `AWES.lang` новое значение, при этом существующие переменные не переопределятся, а новые добавятся. Для примера выше:

```javascript
AWES.lang = {
    TIMEOUT_ERROR: "New value!!",
    NEW_VAR: "New variable"
}
console.log(AWES.lang) // { TIMEOUT_ERROR: "Time is out...", NEW_VAR: "New variable" }
```


## <a name="bjs-lang"></a> Уведомления

Для отображения уведомлений используется функция `AWES.notify`. Её можно переопределить, чтобы использовать сторонние библиотеки, однако стоит помнить что функции ядра передают только два параметра в уведомление:

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