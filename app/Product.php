<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'oc_product';
    protected $primaryKey = 'product_id';
    protected $fillable = ['price', 'quantity', 'sort_order', "stock_status_id", 'date_available'];
    protected $attributes = [
        'model' => '',
        "sku" => "",
        'upc' => '',
        'ean' => '',
        'jan' => '',
        'isbn' => '',
        'mpn' => '',
        'image' => '',
        'manufacturer_id' => 0,
        'shipping' => 1,
        'points' => 0,
        'tax_class_id' => 1,
        'weight' => 12.8,
        'weight_class_id' => 1,
        'length' => 0,
        'width' => 0,
        'height' => 0,
        'length_class_id' => 0,
        'subtract' => 0,
        'minimum' => 1,
        'status' => 0,
        'viewed' => 1,
        'date_added' => '1900-10-11',
        'date_modified' => '1900-10-11',
    ];
    protected $hidden = [
        'model',
        'upc',
        'ean',
        'jan',
        'isbn',
        'mpn',
        'manufacturer_id',
        'shipping',
        'tax_class_id',
        'weight',
        'weight_class_id',
        'length',
        'width',
        'height',
        'length_class_id',
        'subtract',
        'minimum',
        'viewed',
        'date_added',
        'date_modified',
        'location',
        'stock_status_id',
        'points',
        'date_available',
        'sort_order',
        'product_tags',
        'is_discount',
        'category_id',
        'quantity',
        'status',
    ];
    public $timestamps = false;

    public function descriptions()
    {
        return $this->hasMany("App\ProductDescription", "product_id", "product_id");
    }
}
