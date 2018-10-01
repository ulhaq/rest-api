<?php

namespace App\Traits;

trait Searchable
{
    public function scopeSearch($query, $q, array $columns = [], $push = true)
    {
        if (!empty($q)) {
            if (empty($columns)) {
                $columns = $this->searchable;
            } else {
                if ($push) {
                    $columns = array_merge_recursive($this->searchable, $columns);
                }
            }

            foreach ($columns as $relation => $column) {
                if (is_array($column)) {
                    foreach ($column as $val) {
                        $query->orWhereHas($relation, function ($query) use ($q, $val) {
                            $query->where($val, 'like', "%$q%");
                        });
                    }
                } else {
                    $query->orWhere($column, 'like', "%$q%");
                }
            }
        }

        return $query;
    }
}
