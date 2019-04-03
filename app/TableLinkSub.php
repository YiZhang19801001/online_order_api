<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableLinkSub extends Model
{
    protected $table = 'oc_table_linksub';
    public $timestamps = false;

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
}
