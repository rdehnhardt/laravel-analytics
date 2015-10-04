<?php

namespace Baconfy\Analytics\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    /**
     * @return string
     */
    public function getTable()
    {
        if (isset($this->table)) {
            return $this->table;
        }

        return config('analytics.visits_table', 'analytics_visits');
    }
}