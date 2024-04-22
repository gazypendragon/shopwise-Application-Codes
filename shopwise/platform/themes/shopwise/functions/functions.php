<?php

use Botble\Media\Facades\RvMedia;
use Botble\SimpleSlider\Forms\SimpleSliderItemForm;
use Botble\Theme\Facades\Theme;

register_page_template([
    'homepage' => __('Homepage'),
    'blog-sidebar' => __('Blog Sidebar'),
]);

register_sidebar([
    'id' => 'footer_sidebar',
    'name' => __('Footer sidebar'),
    'description' => __('Sidebar in the footer of site'),
]);

RvMedia::setUploadPathAndURLToPublic()
    ->addSize('medium', 540, 600)
    ->addSize('small', 540, 300);

app()->booted(function () {
    Theme::registerToastNotification();
    Theme::registerPreloader();

    if (is_plugin_active('simple-slider')) {
        SimpleSliderItemForm::extend(function (SimpleSliderItemForm $form) {
            $form
                ->addAfter('description', 'sub_title', 'text', [
                    'label' => __('Subtitle'),
                    'metadata' => true,
                    'attr' => [
                        'placeholder' => __('Enter subtitle'),
                    ],
                ])
                ->addAfter('link', 'button_text', 'text', [
                    'label' => __('Button text'),
                    'metadata' => true,
                    'attr' => [
                        'placeholder' => __('Ex: Shop now'),
                    ],
                ]);
        }, 124);
    }
});
