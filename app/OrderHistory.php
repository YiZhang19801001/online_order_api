<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $table = "oc_order_history";
    protected $primaryKey = "order_history_id";
    public $timestamps = false;
    protected $fillable = ["order_id", "date_added"];
    protected $attributes = [
        "order_status_id" => 1,
        "notify" => 0,
        "comment" => "",
    ];
}
