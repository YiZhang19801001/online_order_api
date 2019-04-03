<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = "oc_tables";
    protected $primaryKey = "table_id";
    public $timestamps = false;

    protected $attributes = [
        "table_status",
        "current_order_id",
    ];
}
