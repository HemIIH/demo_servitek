<?php

namespace App\Models\Scopes;

trait Datable
{

    /**
     * Scope a query to filter and order data by date
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $date
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereMonth('date', $date->format('m'))
            ->whereYear('date', $date->format('Y'))
            ->orderBy('date', 'asc');
    }

}