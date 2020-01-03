# Virtual tour module &lt;virtual-tour&gt;

Guides user through the interface

When page is loaded and becomes interactive, component checks cookie record with it's name for current path. If there is no record, component will start the tour. If there are multiple tours, they will be queried in order of appearance in markup.

![virtual-tour](https://storage.googleapis.com/static.awes.io/docs/virtual-tour.gif)

## Minimal markup

```html
<virtual-tour :steps="[{ message: 'Your message.'}]"></virtual-tour>
```

<div id="test-div">Test div</div>
<virtual-tour :steps="[{ el: '#test-div', message: 'This is a test div.'}]"></virtual-tour>


## Component options

| Name         | Type        | Default        | Description                                                 |
|--------------|:-----------:|----------------|-------------------------------------------------------------|
| steps        | **Array**   | `undefined`    | A list of guiding steps                                     |
| name(*)      | **String**  | `undefined`    | **Required**. An ID to check completion and store it's status in cookie |
| expires      | **Number, Boolean**  | `false` | Number of *days* to retry a virtual tour |
| buttons-text | **Object**  | `lang` strings | Locally overwrites text in navigation buttons               |
| fade         | **Boolean** | `true`         | Fade screen for all steps and highlight target              |


## Step item parameters

| Name          | Type        | Default      | Description                                               |
|---------------|:-----------:|--------------|-----------------------------------------------------------|
| el            | **String**  | `undefined`  | CSS-selector for element to highlight and bind tooltip    |
| message       | **String**  | `undefined`  | Message text                                              |
| fade          | **Object**  | `undefined`  | Overwrite components property for current step            |
| position      | **Boolean** | `'auto'`     | Tooltip position, one of `top`, `bottom`, `left`, `right` or `auto` by default. *Note if the tooltip can't be placed in the provided position it will be placed in the best available position* |


## Component events

| Name | Type        | Description                                                                   |
|------|:-----------:|-------------------------------------------------------------------------------|
| done | *Vue-event* | Emits on tour completion and passes `true` on last step and `false` otherwise |

## Language variables

To change labels globally in all tours, define them in config

```javascript
const AWES_CONFIG = {
    key: 'your api key',
    lang: {
        TOUR_NEXT: 'Next tip',
        TOUR_PREV: 'Previous tip',
        TOUR_SKIP: 'Skip all',
        TOUR_FINISH: 'Finish',
        TOUR_STEP: 'Step' // title text before numeration
    }
}
```

For local change, pass an object to the tour component directly. The string, that not provided locally will be get from global config

```html
<virtual-tour
    :steps="[{ message: 'Your message.'}]"
    :buttons-text="{
        next: 'One more',
        prev: 'Go back',
        skip: 'Enough, please !',
        finish: 'Finally !'
    }"
></virtual-tour>
```

## Cookie domain

To set cookie for specific domains, provide a config option:

```javascript
const AWES_CONFIG = {
    key: 'your_api_key',
    virtualTour: {
        cookieDomain: '.website.com'
    }
}
```