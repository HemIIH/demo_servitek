<?php

namespace App\Models\User;

use App\Models\Client\Client;
use App\Models\Employee\Employee;
use App\Models\Scopes\TableViewer;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use TableViewer, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    /*
    |--------------------------------------------------------------------------
    |       Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeSearch($query)
    {
        $rules = [
            'id'              => 'nullable|integer',
            'search_column'   => 'nullable|in:id,name,city',
        ];

        $v = validator(request()->all(), $rules);

        if ($v->fails()) {
            throw new \Illuminate\Validation\ValidationException($v);
        }

        return $query->where(function ($query) {
            if (request()->filled('search_input')) {

                if (intval(request('search_input'))) {
                    $query->where('id', request('search_input'));
                } else {
                    $query->where(function ($query) {
                        $query->where('name', 'like', '%' . request('search_input'). '%')
                            ->orWhere('city', 'like', '%' . request('search_input'). '%');
                    });
                }
            }

            if (request()->filled('role')) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', request('role'));
                });
            }

            if (request()->filled('state')) {
                $query->where('active', request('state'));
            }

            if (request()->filled('usertype')) {
                $query->where('type', request('usertype'));
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    |       Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if user has role.
     *
     * @param $role_name
     * @return bool
     */
    public function hasRole($role_name)
    {
        return in_array($role_name, $this->roles->pluck('name')->toArray());
    }

    /*
    |--------------------------------------------------------------------------
    |       Accessors and Mutators
    |--------------------------------------------------------------------------
    */

    public function getRoleNameAttribute()
    {
        return $this->roles->pluck('display_name')->first();
    }

    public function getUsertypeAttribute()
    {
        return config('settings.usertypes')[$this->type];
    }

    public function getLocationsAttribute($value)
    {
        if ($value == null || $value == 'null') {
            return [];
        }

        return json_decode($value);
    }
}
