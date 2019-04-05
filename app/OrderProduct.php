<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = "oc_order_product";
    protected $primaryKey = "order_product_id";
    public $timestamps = false;

    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
        "name",
        "price",
        "total",

    ];

    protected $attributes = [
        "model" => 1,
        "tax" => 0,
        "reward" => 0,
        "completed" => 1,
    ];

    public function getCompletedAttribute($value)
    {
        return $value == 0;
    }
}
