<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableLink extends Model
{
    protected $table = "oc_table_link";
    protected $primaryKey = "link_id";
    protected $fillable = ['table_code', 'link_generate_time'];

    public $timestamps = false;

    protected $attributes = [
        'table_link' => "",
        'site_id' => 1,
        'pos_saleId' => 1,
        'status' => 0,
        'add_time' => null,
        'validation' => null,
    ];

    public function linksubs()
    {
        return $this->hasMany('App\TableLinkSub', 'link_id', 'link_id');
    }
}
