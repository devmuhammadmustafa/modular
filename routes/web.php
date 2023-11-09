<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', function () {
        $categories = \Modules\Category\app\Models\Category::query()->select(
            [
                'id',
                "title_" . app()->getLocale() . ' as title',
            ]
        )->get()->toArray();
        $products = \Modules\Product\app\Models\Product::query()->select(
            [
                'id',
                "title_" . app()->getLocale() . ' as title',
                "description_" . app()->getLocale() . ' as description',
            ]
        )->get()->toArray();

        dd($categories, $products);
        return view('welcome');
    });
});
