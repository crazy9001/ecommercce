<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists, this
    | is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities this is cool
    | feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => array(

        'before' => function ($theme) {
        },

        'asset' => function ($asset) {

            $asset->add([
                ['style', [
                    '/components/bootstrap/dist/css/bootstrap.min.css',
                    '/components/font-awesome/css/font-awesome.min.css',
                    '/components/bootstrap-sweetalert/dist/sweetalert.css'
                ]],
                ['script', [
                    '/components/bootstrap/dist/js/bootstrap.min.js',
                    '/components/bootstrap-sweetalert/dist/sweetalert.min.js',
                    'https://cdn.jsdelivr.net/npm/vue',
                    '/js/ajaxSubmit.js',
                    '/js/address.js',
                    '/js/cart.js'
                ]]
            ]);
            $asset->container('head')->add([
                ['script', [
                    '/components/jquery-v3/dist/jquery.min.js',
                ]]
            ]);


            $asset->themePath()->add([
                ['style', [
                    'css/lightslider.css',
                    'css/global.css',
                    'css/content.css',
                    'css/reponsive.css',
                    'css/custom.css'
                ]],
                ['script', [
                    'js/lightslider.js',
                    'js/jquery-ui.js',
                    'js/custom.js'
                ]]
            ]);

            $asset->container('head')->themePath()->add([
                ['script', [
                    'js/lightslider.js',
                ]]
            ]);

            // You may use elixir to concat styles and scripts.
            /*
            $asset->themePath()->add([
                                        ['styles', 'dist/css/styles.css'],
                                        ['scripts', 'dist/js/scripts.js']
                                     ]);
            */

            // Or you may use this event to set up your assets.
            /*
            $asset->themePath()->add('core', 'core.js');
            $asset->add([
                            ['jquery', 'vendor/jquery/jquery.min.js'],
                            ['jquery-ui', 'vendor/jqueryui/jquery-ui.min.js', ['jquery']]
                        ]);
            */
        },


        'beforeRenderTheme' => function ($theme) {
            // To render partial composer
            /*
            $theme->partialComposer('header', function($view){
                $view->with('auth', Auth::user());
            });
            */

        },

        'beforeRenderLayout' => array(

            'mobile' => function ($theme) {
                // $theme->asset()->themePath()->add('ipad', 'css/layouts/ipad.css');
            }

        )

    )

);