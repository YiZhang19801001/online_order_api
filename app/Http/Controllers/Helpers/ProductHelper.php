<?php

namespace App\Http\Controllers\Helpers;

use App\Category;

class ProductHelper
{

    public function makeProductsList($language_id)
    {

        $result = array();

        $categories = Category::all();

        foreach ($categories as $category) {
            $sql = $category->descriptions();

            $description = $sql->where('language_id', $language_id)->first();

            if ($description === null) {
                $description = $sql->first();
            }
            $category['name'] = $description->name;

            $products = $category->products()->where('status', 1)->get();
            foreach ($products as $product) {
                $sql = $product->descriptions();
                $description = $sql->where('language_id', $language_id)->first();
                if ($description === null) {
                    $description = $sql->first();
                }
                # make product image
                $image_path = config("app.imagePath") . $product["image"];
                if ($product["image"] === null || $product["image"] === "" || !file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
                    $product["image"] = url('/') . '/images/products/default_product.jpg';
                } else {
                    $product["image"] = url('/') . '/images/products/' . $product["image"];
                }

                $product['name'] = $description->name;
            }

            array_push($result, array(
                'category' => $category->name,
                'category_id' => $category->category_id,
                'products' => $products,
            ));
        }

        return $result;
    }
}
