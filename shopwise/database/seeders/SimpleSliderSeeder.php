<?php

namespace Database\Seeders;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Language\Models\LanguageMeta;
use Botble\SimpleSlider\Models\SimpleSlider;
use Botble\SimpleSlider\Models\SimpleSliderItem;
use Illuminate\Support\Arr;

class SimpleSliderSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('sliders');

        SimpleSlider::query()->truncate();
        SimpleSliderItem::query()->truncate();

        $sliders = [
            [
                'name' => 'Home slider',
                'key' => 'home-slider',
            ],
        ];

        $sliderItems = [
            [
                'title' => 'Woman Fashion',
                'description' => 'Get up to 50% off Today Only!',
                'link' => 'products',
                'button_text' => 'Shop now',
                'sub_title' => 'New Tranding',
            ],
            [
                'title' => 'Man Fashion',
                'description' => '50% off in all products',
                'link' => 'products',
                'button_text' => 'Discover now',
            ],
            [
                'title' => 'Summer Sale',
                'description' => 'Taking your Viewing Experience to Next Level',
                'link' => 'products',
                'button_text' => 'Shop now',
            ],
        ];

        foreach ($sliders as $value) {
            $slider = SimpleSlider::query()->create(Arr::only($value, ['name', 'key']));

            LanguageMeta::saveMetaData($slider);

            foreach ($sliderItems as $key => $item) {
                $item['image'] = 'sliders/' . ($key + 1) . '.jpg';
                $item['order'] = $key + 1;
                $item['simple_slider_id'] = $slider->id;

                $sliderItem = SimpleSliderItem::query()->create(Arr::except($item, ['button_text', 'sub_title']));

                MetaBox::saveMetaBoxData($sliderItem, 'button_text', $item['button_text']);

                if (Arr::get($item, 'sub_title')) {
                    MetaBox::saveMetaBoxData($sliderItem, 'sub_title', $item['sub_title']);
                }
            }
        }
    }
}
