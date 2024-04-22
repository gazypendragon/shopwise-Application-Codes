<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Tag;
use Botble\Ecommerce\Models\Brand;
use Botble\Ecommerce\Models\ProductCategory;
use Botble\Ecommerce\Models\ProductTag;
use Botble\Language\Models\LanguageMeta;
use Botble\Menu\Facades\Menu;
use Botble\Menu\Models\Menu as MenuModel;
use Botble\Menu\Models\MenuLocation;
use Botble\Menu\Models\MenuNode;
use Botble\Page\Models\Page;
use Illuminate\Support\Arr;

class MenuSeeder extends BaseSeeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Main menu',
                'slug' => 'main-menu',
                'location' => 'main-menu',
                'items' => [
                    [
                        'title' => 'Home',
                        'url' => '/',
                        'children' => [
                            [
                                'title' => 'Homepage',
                                'url' => '/',
                            ],
                            [
                                'title' => 'Homepage 2',
                                'reference_id' => 10,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Homepage 3',
                                'reference_id' => 11,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Homepage 4',
                                'reference_id' => 12,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Homepage 5',
                                'reference_id' => 13,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Homepage 6',
                                'reference_id' => 14,
                                'reference_type' => Page::class,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Products',
                        'url' => '/products',
                    ],
                    [
                        'title' => 'Shop',
                        'url' => '#',
                        'children' => [
                            [
                                'title' => 'Product Category',
                                'reference_id' => 1,
                                'reference_type' => ProductCategory::class,
                            ],
                            [
                                'title' => 'Brand',
                                'reference_id' => 1,
                                'reference_type' => Brand::class,
                            ],
                            [
                                'title' => 'Product Tag',
                                'reference_id' => 1,
                                'reference_type' => ProductTag::class,
                            ],
                            [
                                'title' => 'Product Single',
                                'url' => 'products/beat-headphone',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Blog',
                        'reference_id' => 3,
                        'reference_type' => Page::class,
                        'children' => [
                            [
                                'title' => 'Blog Left Sidebar',
                                'reference_id' => 3,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Blog Category',
                                'reference_id' => 1,
                                'reference_type' => Category::class,
                            ],
                            [
                                'title' => 'Blog Tag',
                                'reference_id' => 1,
                                'reference_type' => Tag::class,
                            ],
                            [
                                'title' => 'Blog Single',
                                'url' => 'news/4-expert-tips-on-how-to-choose-the-right-mens-wallet',
                            ],
                        ],
                    ],
                    [
                        'title' => 'FAQ',
                        'reference_id' => 5,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Contact',
                        'reference_id' => 2,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
            [
                'name' => 'Useful Links',
                'slug' => 'useful-links',
                'items' => [
                    [
                        'title' => 'About Us',
                        'reference_id' => 4,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'FAQ',
                        'reference_id' => 5,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Location',
                        'reference_id' => 6,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Affiliates',
                        'reference_id' => 7,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Contact',
                        'reference_id' => 2,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
            [
                'name' => 'Categories',
                'slug' => 'categories',
                'items' => [
                    [
                        'title' => 'Television',
                        'reference_id' => 1,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Mobile',
                        'reference_id' => 2,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Headphone',
                        'reference_id' => 3,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Watches',
                        'reference_id' => 4,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Game',
                        'reference_id' => 5,
                        'reference_type' => ProductCategory::class,
                    ],
                ],
            ],
            [
                'name' => 'My Account',
                'slug' => 'my-account',
                'items' => [
                    [
                        'title' => 'My profile',
                        'url' => '/customer/overview',
                    ],
                    [
                        'title' => 'Wishlist',
                        'url' => '/wishlist',
                    ],
                    [
                        'title' => 'Orders',
                        'url' => 'customer/orders',
                    ],
                    [
                        'title' => 'Order tracking',
                        'url' => '/orders/tracking',
                    ],
                ],
            ],
        ];

        MenuModel::query()->truncate();
        MenuLocation::query()->truncate();
        MenuNode::query()->truncate();

        foreach ($data as $index => $item) {
            $menu = MenuModel::query()->create(Arr::except($item, ['items', 'location']));

            if (isset($item['location'])) {
                $menuLocation = MenuLocation::query()->create([
                    'menu_id' => $menu->id,
                    'location' => $item['location'],
                ]);

                LanguageMeta::saveMetaData($menuLocation);
            }

            foreach ($item['items'] as $menuNode) {
                $this->createMenuNode($index, $menuNode, $menu->id);
            }

            LanguageMeta::saveMetaData($menu);
        }

        Menu::clearCacheMenuItems();
    }

    protected function createMenuNode(int $index, array $menuNode, int $menuId, int $parentId = 0): void
    {
        $menuNode['menu_id'] = $menuId;
        $menuNode['parent_id'] = $parentId;

        if (isset($menuNode['url'])) {
            $menuNode['url'] = str_replace(url(''), '', $menuNode['url']);
        }

        if (Arr::has($menuNode, 'children')) {
            $children = $menuNode['children'];
            $menuNode['has_child'] = true;

            unset($menuNode['children']);
        } else {
            $children = [];
            $menuNode['has_child'] = false;
        }

        $createdNode = MenuNode::query()->create($menuNode);

        if ($children) {
            foreach ($children as $child) {
                $this->createMenuNode($index, $child, $menuId, $createdNode->id);
            }
        }
    }
}
