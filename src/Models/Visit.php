<?php

namespace Rdehnhardt\Analytics\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['uuid', 'location', 'ip', 'referrer',];

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