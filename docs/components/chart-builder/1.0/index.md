# The &lt;chart-builder&gt; Component

The <chart-builder> component is intended for drawing diagrams. It uses the open source [Chart.js](https://www.chartjs.org/) which allows to visualize your data in different ways.

![chart-js](https://static.awes.io/docs/chart-builder.gif)


## Example of use

Below you can see a clear example of using the <chart-builder> component:

```html
<chart-builder
    :data="{
        datasets: [{
            data: [70, 80, 73, 75, 74, 100, 90, 100, 110, 60],
            backgroundColor: '#e9f8f3',
            borderColor: '#e9f8f3'
        }],
        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    }"
    :options="{
        elements: {
            line: {
                tension: 0
            },
            point: {
                radius: 0
            }
        },
        legend: {
            display: false
        },
        scales: {
            xAxes: [
                {
                    display: false
                }
            ],
            yAxes: [
                {
                    display: false,
                    ticks: {
                        beginAtZero: true
                    }
                }
            ]
        },
        maintainAspectRatio: false,
    }"></chart-builder>
```

<div class="vue-example">
<chart-builder
    :data="{ datasets: [{ data: [70, 80, 73, 75, 74, 100, 90, 100, 110, 60], backgroundColor: '#e9f8f3', borderColor: '#e9f8f3'}], labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}"
    :options="{ elements: { line: { tension: 0 }, point: { radius: 0 } }, legend: { display: false }, scales: { xAxes: [ { display: false } ], yAxes: [ { display: false, ticks: { beginAtZero: true } } ] }, maintainAspectRatio: false, }"></chart-builder>
</div>


## Component settings

| Name           | Type      | Default      | Description    |
|----------------|-----------|--------------|------------|
| **data(*)**    | `Object`  | `undefined`  | Data for drawing diagrams using [Chart.js](https://www.chartjs.org/docs/latest/getting-started/usage.html) |
| **show**       | `Boolean` | `true`       | Show/hide diagram (is used to restart animation) |
| **options(*)** | `Object`  | `undefined`  | [Diagram settings](https://www.chartjs.org/docs/latest/general/options.html) |
| **type**       | `String`  | `'line'`     | [Diagram types](https://www.chartjs.org/docs/latest/charts/) |
