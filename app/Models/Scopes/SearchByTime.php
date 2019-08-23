<?php

namespace App\Models\Scopes;

trait SearchByTime
{
    public function scopeSearchByTime($query, $column)
    {
        switch (request('time')) {
            case '-7':
                $query->whereBetween($column, [now()->startOfWeek()->subWeek(), now()->endOfWeek()->subWeek()]);
                break;
            case '-30':
                $query->whereBetween($column, [now()->startOfMonth()->subMonth(), now()->endOfMonth()->subMonth()]);
                break;
            case 'w':
                $query->whereBetween($column, [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'm':
                $query->whereBetween($column, [now()->startOfMonth(), now()->endOfMonth()]);
                break;
            case '7':
            case '14':
                $query->whereBetween($column, [now()->startOfWeek()->addDay((int) request('time')), now()->endOfWeek()->addDay((int) request('time'))]);
                break;
            case '30':
                $query->whereBetween($column, [now()->startOfMonth()->addMonth(), now()->endOfMonth()->addMonth()]);
                break;
            case 'date':
                if (request()->filled('date')) {
                    $query->where($column, '=', toSql(request('date')));
                }
                break;
            case 'range':
                if (request()->filled(['start', 'end'])) {
                    $query->whereBetween($column, [toSql(request('start')), toSql(request('end'))]);
                }
                break;
        }
    }
}