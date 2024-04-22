<?php

namespace Database\Seeders;

use Botble\Ads\Models\Ads;
use Botble\Base\Supports\BaseSeeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdsSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('promotion');

        Ads::query()->truncate();

        $items = [
            [
                'name' => 'Homepage middle 1',
                'location' => 'not_set',
                'key' => 'IZ6WU8KUALYD',
                'url' => '/product-categories/headphone',
            ],
            [
                'name' => 'Homepage middle 2',
                'location' => 'not_set',
                'key' => 'ILSFJVYFGCPZ',
                'url' => '/product-categories/camera',
            ],
            [
                'name' => 'Homepage middle 3',
                'location' => 'not_set',
                'key' => 'ZDOZUZZIU7FT',
                'url' => '/product-categories/watches',
            ],
            [
                'name' => 'Slide right 1',
                'location' => 'not_set',
                'key' => 'WF2VEBKBGUFA',
                'url' => '/products',
            ],
            [
                'name' => 'Slide right 2',
                'location' => 'not_set',
                'key' => 'YKE9S2TUEEJB',
                'url' => '/products',
            ],
            [
                'name' => 'Homepage medium 1',
                'location' => 'not_set',
                'key' => 'DHAEBCMWGYJG',
                'url' => '/products',
            ],
            [
                'name' => 'Homepage medium 1',
                'location' => 'not_set',
                'key' => 'MDEUVQI9QPKM',
                'url' => '/products',
            ],
            [
                'name' => 'Homepage medium 3',
                'location' => 'not_set',
                'key' => 'EYMG7NGZTHJL',
                'url' => '/products',
            ],
            [
                'name' => 'Homepage medium 4',
                'location' => 'not_set',
                'key' => 'NKWBGV6NAC3M',
                'url' => '/products',
            ],
            [
                'name' => 'Homepage medium 5',
                'location' => 'not_set',
                'key' => '7W3YFO7XE422',
                'url' => '/products',
            ],
        ];

        foreach ($items as $index => $item) {
            $item['order'] = $index + 1;
            $item['key'] ??= strtoupper(Str::random(12));
            $item['expired_at'] = Carbon::now()->addYears(5)->toDateString();
            $item['image'] = 'promotion/' . ($index + 1) . '.jpg';

            Ads::query()->create($item);
        }
    }
}
