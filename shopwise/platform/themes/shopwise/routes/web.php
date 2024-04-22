<?php

use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Theme\Shopwise\Http\Controllers\ShopwiseController;

Theme::registerRoutes(function () {
    Route::group(['controller' => ShopwiseController::class], function () {
        Route::group(['prefix' => 'ajax', 'as' => 'public.ajax.'], function () {
            Route::get('products', 'ajaxGetProducts')
                ->name('products');

            Route::get('trending-products', 'ajaxGetTrendingProducts')
                ->name('trending-products');

            Route::get('featured-brands', 'ajaxGetFeaturedBrands')
                ->name('featured-brands');

            Route::get('featured-products', 'ajaxGetFeaturedProducts')
                ->name('featured-products');

            Route::get('top-rated-products', 'ajaxGetTopRatedProducts')
                ->name('top-rated-products');

            Route::get('on-sale-products', 'ajaxGetOnSaleProducts')
                ->name('on-sale-products');

            Route::get('cart', 'ajaxCart')
                ->name('cart');

            Route::get('quick-view/{id}', 'getQuickView')
                ->name('quick-view')
                ->wherePrimaryKey();

            Route::get('featured-posts', 'ajaxGetFeaturedPosts')
                ->name('featured-posts');

            Route::get('testimonials', 'ajaxGetTestimonials')
                ->name('testimonials');

            Route::get('get-flash-sales', 'ajaxGetFlashSales')
                ->name('get-flash-sales');

            Route::get('search-products', 'ajaxSearchProducts')
                ->name('search-products');
        });
    });
});

Theme::routes();
