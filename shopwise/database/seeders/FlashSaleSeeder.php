<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Models\FlashSale;
use Botble\Ecommerce\Models\Product;
use Illuminate\Support\Arr;

class FlashSaleSeeder extends BaseSeeder
{
    public function run(): void
    {
        FlashSale::query()->truncate();

        $productIds = Product::query()->where('is_variation', 0)->pluck('id')->all();

        $data = [
            [
                'name' => 'Deal of the Day.',
            ],
            [
                'name' => 'Gadgets & Accessories',
            ],
        ];

        foreach ($data as $item) {
            $flashSale = FlashSale::query()->create([
                'name' => $item['name'],
                'end_date' => now()
                    ->addDays(rand(15, 50))
                    ->addHours(rand(1, 23))
                    ->addMinutes(rand(1, 59))
                    ->toDateString(),
            ]);

            $product = Product::query()->find(Arr::random($productIds));

            $price = $product->price;

            if ($product->front_sale_price !== $product->price) {
                $price = $product->front_sale_price;
            }

            $flashSale->products()->attach(
                [
                    $product->id => [
                        'price' => $price - ($price * rand(10, 70) / 100),
                        'quantity' => rand(6, 20),
                        'sold' => rand(1, 5),
                    ],
                ]
            );
        }
    }
}
