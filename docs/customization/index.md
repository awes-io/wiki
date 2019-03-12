# Design Customization

## General
[Awes.IO](https://www.awes.io) provides a default theme [Indigo Layout](https://www.awes.io/documentation/components/indigo-layout) and allows to customize some basic aspects in order to meet the needs of UI diversity from business and brand.

**Awes.IO** uses [Stylus](http://stylus-lang.com/) as developing a language of styles. We  have defined a set of 
variables which can be customized.

<p align="center">
  <img src="https://static.awes.io/docs/awes-io.png" alt="Awes.IO" />
</p>

## How to change the style

By default, we use purple for navigation and white and gray for content.
But, you can very easy to change colors from Indigo Layout config.

1. Please install a module `composer require awes-io/indigo-layout`
2. Go to `config/indigo-layout.php`
3. In section `root_variables` you can change default colors. The full list of variables you can find in the documentation: 
[Indigo 
Layout](https://www.awes.io/documentation/components/indigo-layout) 
4. Example:

```php
'root_variables' => [
    '--tc_aside_gradient' => 'linear-gradient(0deg,#ff4700 0%,#ff7b1b)',
    '--tc_aside_gradient_header' => 'linear-gradient(90deg,#ff4700 0%,#ff7b1b)',
    '--tc_aside_bg_dark' => '#ffffff',
    '--tc_aside_text' => '#141006'
],
'custom_styles' => '
    body {
        background: white
    }
'
```

## Сustomization examples

#### Stripe design

<p align="center">
  <img src="https://static.awes.io/docs/stripe2.jpg" alt="Stripe - Awes.IO" />
</p>

```php

'custom_styles' => '
    :root:not([data-dark="true"]) {
        --tc_page_bg: #e3e8ee;
        --tc_aside_gradient: linear-gradient(to left, #e3e8ee 0%, #e3e8ee 100%);
        --tc_aside_gradient_header: linear-gradient(to left, #fff 0%, #fff 100%);
        --tc_aside_link: #414770;
        --tc_aside_text: #414770;
        --tc_aside_bg_nav: #dee2e7;
        --tc_header_bg: none;
        --tc_ui_btn_smcolor: #16a085;
        --tc_ui_btn_smcolor_active: #1abc9c;
        --tc_header_link: #aab7c4;
        --tc_header_link_active: #414770;

    }

    :root[data-dark="true"] {
        --tc_header_bg: none;
        --tc_ui_btn_smcolor: #16a085;
        --tc_ui_btn_smcolor_active: #1abc9c;
    }

    .frame .frame__aside {
        box-shadow: none;
    }

    .frame .frame__aside-link .icon-angle-bottom:after {
        top: 0.5rem;
        bottom: 0.5rem;
    }

    .frame .frame__aside-link .icon-angle-bottom {
        width: 35px;
    }

    .frame .frame__aside-link {
        padding-top: 5px;
        padding-bottom: 5px;
        min-height: 35px;
        opacity: 1;
    }

    .frame .frame__aside-link:hover {
        color: #556cd6;
    }

    .frame .frame__aside-inlist {
        min-height: 30px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .frame .frame__aside-title {
        min-height: 77px;

    }


    .frame .frame__aside-title {
        text-align: left;
        justify-content: flex-start;
        padding-left: 35px;
        padding-right: 20px;
    }

    .frame .frame__aside-title {
        background: none;
    }

    .frame .frame__search {
        background-color: var(--tc_ui_bg);
        padding: 5px 15px;
        border-radius: 2px;
        box-shadow: var(--tc_shadow_smr);
    }

    .frame .frame__search .frame__search-hidden {
        width: 300px;
    }

    .frame .frame__search-input {
        border: 0px;
    }

    .frame .frame__search-input:focus {
        border: 0px;
    }

    .frame__search-link {
        pointer-events: none;
    }

    .frame .frame__search-close {
        display: none;
    }

    .frame .frame__header-top {
        padding-top: 20px;
        padding-right: 40px;
    }

    .frame .frame__userinfo-ava {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin-left: 15px;
    }

    .frame .frame__userinfo {
        height: 36px;
    }

    .frame .frame__header-line {
        padding-top: 30px;
        padding-bottom: 0;
    }

    .frame .frame__userinfo-link {
        width: 36px;
        height: 36px;
        margin-left: 10px;
    }

    .frame .frame__header-add {
        top: -35px;
    }

    @media (max-width: 1000px) {
        .frame .frame__header-top {
            padding-right: 15px;
        }
    }

    @media (max-width: 900px) {
        .frame .frame__aside-title {
            min-height: 60px;
        }

        .frame .frame__userinfo-ava {
            width: 42px;
            height: 42px;
        }

        .frame .frame__aside-title {
            padding-left: 10px;
            padding-right: 10px;
        }
    }

    @media (max-width: 700px) {
        .frame .frame__header-line {
            padding-top: 10px;
        }

        .frame .frame__header-add {
            top: auto;
        }

        .frame .frame__userinfo {
            background: #fff;
            height: 60px;
        }
        
    }
'
```

#### Google Material Design

<p align="center">
  <img src="https://static.awes.io/docs/google2.jpg" alt="Google - Awes.IO" />
</p>

```php

'custom_styles' => '
    :root:not([data-dark="true"]) {
        --tc_page_bg: #fff;
        --tc_aside_gradient: linear-gradient(to left, #fafafa 0%, #fafafa 100%);
        --tc_aside_gradient_header: linear-gradient(to left, #1a73e8 0%, #1a73e8 100%);
        --tc_aside_link: #737373;            
        --tc_aside_text: #737373;
        --tc_aside_bg_nav: #ecf1fa;
        --tc_header_bg: #fff;
        --tc_ui_btn_smcolor: #1a73e8;
        --tc_ui_btn_smcolor_active: #1a73e8;
        --tc_header_link: #fff;
        --tc_header_link_active: #fafafa;
        --tc_aside_bg_dark: #1a73e8;
        --tc_ui_btn_smcolor_text: #fff;

    }

    :root[data-dark="true"] {
        --tc_header_bg: none;
        --tc_ui_btn_smcolor: #1a73e8;
        --tc_ui_btn_smcolor_active: #1a73e8;
        --tc_aside_bg_dark: #1a73e8;
        --tc_ui_btn_smcolor_text: #fff;
    }


    .frame .frame__aside {
        box-shadow: none;
    }

    .frame .frame__header {
        padding-top: 56px;
    }

    .frame .frame__aside-link .icon {
        transition: none;
    }

    .frame .frame__aside-link .icon-angle-bottom:after {
        top: 0.5rem;
        bottom: 0.5rem;
    }

    .frame .frame__aside-link .icon-angle-bottom {
        width: 35px;
    }

    .frame .frame__aside-links {
        padding-top: 10px;
    }

    .frame .frame__aside-link {
        padding-top: 10px;
        padding-bottom: 10px;
        min-height: 40px;
        opacity: 1;
    }

    .frame .frame__aside-link:hover {
        color: #3a78e6;
    }

    .frame .frame__aside-inlist {
        min-height: 30px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .frame .frame__search-link {
        color: #1a73e8;
    }

    .frame .frame__aside-title {
        min-height: 58px;
        height: 58px;
        color: #fff;
        padding-top: 10px;
        padding-bottom: 10px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .frame .frame__aside-title a {
        color: #fff;
    }


    .frame .frame__aside-title {
        text-align: left;
        justify-content: flex-start;
        padding-left: 35px;
        padding-right: 20px;
    }


    .frame .frame__search {
        background-color: var(--tc_ui_bg);
        padding: 5px 15px;
        border-radius: 2px;
        box-shadow: var(--tc_shadow_smr);
    }

    .frame .frame__search .frame__search-hidden {
        width: 300px;
    }

    .frame .frame__search-input {
        border: 0px;
    }

    .frame .frame__search-input:focus {
        border: 0px;
    }

    .frame__search-link {
        pointer-events: none;
    }

    .frame .frame__search-close {
        display: none;
    }


    .frame .frame__header-top {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 40px;
        width: 100%;
        position: fixed;
        right: 0;
        top: 0;
        background:  #1a73e8;
        z-index: 1000;
        height: 58px;
    }


    .frame .frame__aside + .frame__right .frame__header-top {
        width: calc(100% - 260px);
    }

    .frame .frame__userinfo-ava {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin-left: 15px;
    }

    .frame .frame__userinfo {
        height: 36px;
    }

    .frame .frame__header-line {
        padding-top: 30px;
        padding-bottom: 0;
    }

    html:not([data-dark="true"]) {
        background: #fff;
    }

    .frame .frame__userinfo-link {
        width: 36px;
        height: 36px;
        margin-left: 10px;
    }

    .frame .frame__header-add {
        top: -35px;
    }

    @media (max-width: 1000px) {
        .frame .frame__aside + .frame__right .frame__header-top {
            width: calc(100% - 210px);
        }

        .frame .frame__header-top {
            padding-right: 15px;
        }
    }

    @media (max-width: 900px) {

        .frame .frame__aside-title {
            min-height: 60px;
            white-space: normal;
        }

        .frame .frame__header-top {
            height: auto;
        }


        html:not([data-dark="true"]) .frame .frame__header-top {
            background: #fff;
        }

        html[data-dark="true"] .frame .frame__header-top {
            background: none;
            padding-top: 15px;
        }

        .frame .frame__aside-link:hover {
            color: #fff;
        }

        :root:not([data-dark="true"]) {
            --tc_header_link: #1160c9;
            --tc_header_link_active: #1160c9;
            --tc_aside_text: #fff;
            --tc_aside_link: #fff;  
            --tc_aside_gradient: linear-gradient(to left, #1160c9 0%, #1160c9 100%);
            --tc_aside_gradient_header: linear-gradient(to left, #1160c9 0%, #1160c9 100%);
        }

        .frame .frame__aside-title {
            min-height: 1px;
            height: auto;
        }

        .frame .frame__header-top {
            position: static;
            width: auto;
        }

        .frame .frame__header {
            padding-top: 0;
        }

        .frame .frame__aside + .frame__right .frame__header-top {
            width: auto;
        }


        .frame .frame__userinfo-ava {
            width: 42px;
            height: 42px;
        }

        .frame .frame__aside-title {
            padding-left: 10px;
            padding-right: 10px;
        }
    }

    @media (max-width: 700px) {
        .frame .frame__header-line {
            padding-top: 10px;
        }

        .frame .frame__header-add {
            top: auto;
        }

        .frame .frame__userinfo {
            height: 60px;
            background: var(--tc_ui_bg)
        }

        html:not([data-dark="true"]) .frame .frame__userinfo {
            background: #fff;
        }
        
    }
'

```