<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Models\ProductCategory;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Support\Arr;

class ProductCategorySeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('product-categories');

        $categories = [
            [
                'name' => 'Television',
                'icon' => 'flaticon-tv',
                'image' => 'product-categories/p-1.png',
                'is_featured' => true,
                'children' => [
                    [
                        'name' => 'Home Audio & Theaters',
                    ],
                    [
                        'name' => 'TV & Videos',
                    ],
                    [
                        'name' => 'Camera, Photos & Videos',
                    ],
                    [
                        'name' => 'Cellphones & Accessories',
                    ],
                    [
                        'name' => 'Headphones',
                    ],
                    [
                        'name' => 'Videos games',
                    ],
                    [
                        'name' => 'Wireless Speakers',
                    ],
                    [
                        'name' => 'Office Electronic',
                    ],
                ],
            ],
            [
                'name' => 'Mobile',
                'icon' => 'flaticon-responsive',
                'image' => 'product-categories/p-2.png',
                'is_featured' => true,
                'children' => [
                    [
                        'name' => 'Digital Cables',
                    ],
                    [
                        'name' => 'Audio & Video Cables',
                    ],
                    [
                        'name' => 'Batteries',
                    ],
                ],
            ],
            [
                'name' => 'Headphone',
                'icon' => 'flaticon-headphones',
                'image' => 'product-categories/p-3.png',
                'is_featured' => true,
                'children' => [
                    [
                        'name' => 'Computer & Tablets',
                    ],
                    [
                        'name' => 'Laptop',
                    ],
                    [
                        'name' => 'Monitors',
                    ],
                    [
                        'name' => 'Computer Components',
                    ],
                ],
            ],
            [
                'name' => 'Watches',
                'icon' => 'flaticon-watch',
                'image' => 'product-categories/p-4.png',
                'is_featured' => true,
                'children' => [
                    [
                        'name' => 'Drive & Storages',
                    ],
                    [
                        'name' => 'Gaming Laptop',
                    ],
                    [
                        'name' => 'Security & Protection',
                    ],
                    [
                        'name' => 'Accessories',
                    ],
                ],
            ],
            [
                'name' => 'Game',
                'icon' => 'flaticon-console',
                'image' => 'product-categories/p-5.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Camera',
                'icon' => 'flaticon-camera',
                'image' => 'product-categories/p-6.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Audio',
                'icon' => 'flaticon-music-system',
                'image' => 'product-categories/p-7.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Mobile & Tablet',
                'icon' => 'flaticon-responsive',
            ],
            [
                'name' => 'Accessories',
                'icon' => 'flaticon-plugins',
            ],
            [
                'name' => 'Home Audio & Theater',
                'icon' => 'flaticon-music-system',
            ],
            [
                'name' => 'Tv & Smart Box',
                'icon' => 'flaticon-monitor',
            ],
            [
                'name' => 'Printer',
                'icon' => 'flaticon-printer',
            ],
            [
                'name' => 'Computer',
                'icon' => 'flaticon-tv',
            ],
            [
                'name' => 'Fax Machine',
                'icon' => 'flaticon-fax',
            ],
            [
                'name' => 'Mouse',
                'icon' => 'flaticon-mouse',
            ],
        ];

        ProductCategory::query()->truncate();

        foreach ($categories as $index => $item) {
            $this->createCategoryItem($index, $item);
        }
    }

    protected function createCategoryItem(int $index, array $category, int $parentId = 0): void
    {
        $category['parent_id'] = $parentId;
        $category['order'] = $index;

        if (Arr::has($category, 'children')) {
            $children = $category['children'];
            unset($category['children']);
        } else {
            $children = [];
        }

        $createdCategory = ProductCategory::query()->create($category);

        SlugHelper::createSlug($createdCategory);

        if ($children) {
            foreach ($children as $childIndex => $child) {
                $this->createCategoryItem($childIndex, $child, $createdCategory->id);
            }
        }
    }
}
