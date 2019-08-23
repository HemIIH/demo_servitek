<?php

namespace App\Models\Scopes\Employee;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LocationScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (!auth()->check()) return;

        if (auth()->user()->hasRole('dispomanager') || auth()->user()->hasRole('local_manager')) {

            $constraint = collect(auth()->user()->locations)->map(function ($item) {
                return "locations LIKE '%" . $item . "%'";
            });

            $builder->whereRaw('(' . implode(' OR ', $constraint->toArray()) .')');
        }
    }
}