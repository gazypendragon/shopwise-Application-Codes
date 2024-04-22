<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Testimonial\Models\Testimonial;

class TestimonialSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('testimonials');

        $testimonials = [
            [
                'name' => 'Adam Williams',
                'company' => 'CEO Of Microsoft',
            ],
            [
                'name' => 'Retha Deowalim',
                'company' => 'CEO Of Apple',
            ],
            [
                'name' => 'Sam J. Wasim',
                'company' => 'Pio Founder',
            ],
            [
                'name' => 'Usan Gulwarm',
                'company' => 'CEO Of Facewarm',
            ],
        ];

        Testimonial::query()->truncate();

        foreach ($testimonials as $index => $item) {
            $item['image'] = 'testimonials/' . ($index + 1) . '.jpg';
            $item['content'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua';

            Testimonial::query()->create($item);
        }
    }
}
