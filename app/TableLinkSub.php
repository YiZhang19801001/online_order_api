<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableLinkSub extends Model
{

    protected $table = 'oc_table_linksub';
    public $timestamps = false;

    protected $fillable = ['link_id', 'order_id', "sub_add_time"];

    protected $attributes = [
        'downloaded' => 0,
        'sub_status' => 0,
        'client_browser' => "",
        'client_ip' => "",
        "order_items_qrcode_string" => "",
    ];

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query)
    {
        $query
            ->where('link_id', '=', $this->getAttribute('link_id'))
            ->where('linksub_id', '=', $this->getAttribute('linksub_id'));
        return $query;
    }
    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }
        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }
        return $this->getAttribute($keyName);
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'order_id', 'order_id');
    }
}
