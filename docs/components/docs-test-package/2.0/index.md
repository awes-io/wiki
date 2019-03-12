# V2.0.0
# GoogleCloudImages
The Laravel Package for cropping images based on Google Cloud Services.

## Installation

### Laravel

Via Composer

``` bash
$ composer require awes-io/google-cloud-images
```

The package will automatically register itself.

You can publish the config file with:

```bash
php artisan vendor:publish --provider="AwesIO\GoogleCloudImages\Providers\GoogleCloudImagesServiceProvider" --tag="config"
```

### How to deplot to Google App Engine

```bash
cd ./src/App
composer install
gcloud app deploy --project={project_id}
```

### .env file
Available variables:
```bash
GOOGLE_CLOUD_DYNAMIC_URL=https://img.{domain}
STATIC_SERVER_URL=https://cdn.{domain}
GOOGLE_CLOUD_STORAGE_BUCKET={bucket_name}
GOOGLE_CLOUD_KEY={secret_key} #random string, this key need for protection of your URLs
```


## Available options
The all variables are `optional`.
```php
$options = [
    'width'     => '640',
    'height'    => '480',
    /* 
    * by default is `strong`
    * Availabe:
    * `strong` - crops image to provided dimensions, but if exists `width` and `height`.
    * `center` - same as `strong`, but crops from the center
    * `smart` - square crop, attempts cropping to faces
    * `smart-alternate` — alternate smart square crop, does not cut off faces
    * `circularly` - generates a circularly cropped image
    * `smallest` - square crop to smallest of: width, height
    */
    'cropmode'  => 'strong',
    'lazy'      => false, // defaule: false    
    'alt'       => 'The text for alt attribute', // default: empty
    'title'     => 'The title for title attribute', // default: empty
    'class'     => 'css-class-1 css-class-2', // default: empty
    'id'        => 'unique-id', // default: empty
    'quality'   => '75',   // default: 75
    'isretina'  => true,    // default: true
    'extension' => 'jpg',   // default: jpg - forces the resulting image to be JPG. Available: jpg, png, webp, gif
    'attr'      => [],      // default: empty - all additional attributes to HTML (src, alt, title, class, id will be ignored)
    /* 
        * by default is empty
        * Available only for <picture> tag
        * `width`, `height`, `cropmode`, `isretina`, `original` will be ignered
    */    
    'srcset'    => [        
        [
            'media' => '(max-width: 375px)',
            'class' => 'class-375',
            'width' => 375,
            'height' => 671,
        ],
        [
            'media' => '(max-width: 750px)',
            'class' => 'class-750',
            'width' => 750,
            'height' => 1342,
        ],
        [
            'media' => '(max-width: 1366px)',
            'width' => 1366,
            'height' => 650,
            'main' => true   // this image will be issed for <img /> tag, if the param is missing, will use first from array 
        ],
        [
            'media' => '(max-width: 2732px)',
            'width' => 2732,
            'height' => 1300,
        ]
    ]
];
```

## Methods

##### Return `<img />` tag
```php
    echo GoogleCloudImages::img($path, $options = []);
```
##### Return `<picture />` of the image
```php 
    echo GoogleCloudImages::picture($path, $options = []);
```    

##### Return `URL` of the image
```php
    echo GoogleCloudImages::url($path, $options = []);
```

## Testing

You can run the tests with:

```bash
composer test
```

## Technology
The library based on Google Photo Cropper.
More about it you can read: https://stackoverflow.com/questions/25148567/list-of-all-the-app-engine-images-service-get-serving-url-uri-options
