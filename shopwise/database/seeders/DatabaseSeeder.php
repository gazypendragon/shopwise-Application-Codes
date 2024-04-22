<?php

namespace Database\Seeders;

use Botble\ACL\Database\Seeders\UserSeeder;
use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Database\Seeders\CurrencySeeder;
use Botble\Ecommerce\Database\Seeders\ReviewSeeder;
use Botble\Ecommerce\Database\Seeders\ShippingSeeder;
use Botble\Ecommerce\Database\Seeders\TaxSeeder;
use Botble\Language\Database\Seeders\LanguageSeeder;

class DatabaseSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->prepareRun();

        $this->call([
            LanguageSeeder::class,
            BrandSeeder::class,
            CurrencySeeder::class,
            ProductCategorySeeder::class,
            ProductCollectionSeeder::class,
            ProductLabelSeeder::class,
            ProductAttributeSeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
            TaxSeeder::class,
            ProductTagSeeder::class,
            FlashSaleSeeder::class,
            ShippingSeeder::class,
            OrderEcommerceSeeder::class,
            BlogSeeder::class,
            TestimonialSeeder::class,
            SimpleSliderSeeder::class,
            PageSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            StoreLocatorSeeder::class,
            ProductOptionSeeder::class,
            FaqSeeder::class,
            MenuSeeder::class,
            WidgetSeeder::class,
            ThemeOptionSeeder::class,
            AdsSeeder::class,
        ]);

        $this->finished();
    }
}
