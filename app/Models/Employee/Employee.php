<?php

namespace App\Models\Employee;

use App\Employee\TimeoffRequest;
use App\Models\Document;
use App\Models\Order\Order;
use App\Models\Order\Timetracking;
use App\Models\Scopes\Employee\LocationScope;
use App\Models\Scopes\TableViewer;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use TableViewer;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new LocationScope());
    }

    /*
    |--------------------------------------------------------------------------
    |       Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders($direction = 'desc')
    {
        return $this->belongsToMany(Order::class, 'employee_order', 'employee_id', 'order_id')
            ->withoutGlobalScopes()
            ->orderBy('start_date', $direction)
            ->withPivot(
                'sent',
                'sent_by',
                'role',
                'working_area',
                'approved_by_employee',
                'rejected_by_employee',
                'employee_available',
                'employee_not_available',
                'meeting_point',
                'meeting_time',
                'edited_by'
            );
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_role', 'employee_id', 'role_id');
    }

    public function notes()
    {
        return $this->morphMany(\App\Models\Note::class, 'loggable')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function timetrackings()
    {
        return $this->hasMany(Timetracking::class)
            ->orderBy('date', 'asc');
    }

    public function wages()
    {
        return $this->hasMany(Wage::class)
            ->orderBy('valid_from', 'desc');
    }

    public function workingHours()
    {
        return $this->hasMany(WorkingHours::class)
            ->orderBy('valid_from', 'desc');
    }

    public function extraBusiness()
    {
        return $this->hasMany(ExtraBusiness::class)
            ->orderBy('date', 'desc');
    }

    public function payrollModifications()
    {
        return $this->hasMany(Payroll::class)->with('user')
            ->orderBy('date', 'desc');
    }

    public function timeoff()
    {
        return $this->hasMany(Timeoff::class)
            ->orderBy('date', 'asc');
    }

    public function timeoffRequest()
    {
        return $this->hasMany(TimeoffRequest::class)
            ->orderBy('date', 'asc');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'with_documents')
            ->orderBy('created_at', 'desc');
    }

    public function workingTimeAccounts()
    {
        return $this->hasMany(WorkingTimeAccounts::class);
    }

    public function currentWorkingTimeAccount()
    {
        return $this->hasOne(WorkingTimeAccounts::class)->whereDate('date', now()->firstOfMonth());
    }

    /*
    |--------------------------------------------------------------------------
    |       Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeSearch($query)
    {
        $rules = [
            'id'              => 'integer',
            'sex'             => 'in:m,f',
            'occupation_type' => 'in:part_time,temporary,full_time',
            'state'           => 'in:active,inactive,terminated,applied'
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
                    $term = strtolower(request('search_input'));

                    $query->where(function ($query) use ($term) {
                        $query->whereRaw('lower(last_name)  like "%' . $term . '%"')
                            ->orWhereRaw('lower(first_name) like "%' . $term . '%"')
                            ->orWhereRaw('lower(city) like "%' . $term . '%"')
                            ->orWhereRaw('lower(locations) like "%' . $term . '%"');
                    });
                }
            }

            if (request()->filled('location')) {
                $query->where('locations', 'like', '%' . request('location') . '%');
            }

            if (request()->filled('sex')) {
                $query->where('sex', request('sex'));
            }

            if (request()->filled('occupation_type')) {
                $query->where('occupation_type', request('occupation_type'));
            }

            if (request()->filled('state')) {
                switch (request('state')) {
                    case 'active':
                        $query->where('active', 1)
                              ->where('applicant', 0);
                        return;
                    case 'inactive':
                        $query->where('active', 0)
                              ->whereNull('exit_date')
                              ->where('applicant', 0);
                        return;
                    case 'terminated':
                        $query->whereNotNull('exit_date')
                              ->where('exit_date', '<=', now())
                              ->where('applicant', 0);
                        return;
                    case 'applied':
                        $query->where('applicant', 1);
                        return;
                }
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved_by_employee', 1);
    }

    /*
    |--------------------------------------------------------------------------
    |       Accessors and Mutators
    |--------------------------------------------------------------------------
    */

    public function getDateOfBirthAttribute($value)
    {
        return \Date::format($value);
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = toSql($value);
    }

    public function getEntryDateAttribute($value)
    {
        return \Date::format($value);
    }

    public function setEntryDateAttribute($value)
    {
        $this->attributes['entry_date'] = toSql($value);
    }

    public function getExitDateAttribute($value)
    {
        return \Date::format($value);
    }

    public function setExitDateAttribute($value)
    {
        $this->attributes['exit_date'] = toSql($value);
    }

    public function getWorkedHoursAttribute()
    {
        try {
            return $this->workingTimeAccounts()->whereDate('date', now()->firstOfMonth())->firstOrFail()->actual;
        } catch(\Exception $e) {
            return 0;
        }
    }

    public function getTargetAttribute()
    {
        try {
            return $this->workingTimeAccounts()->whereDate('date', now()->firstOfMonth())->firstOrFail()->target;
        } catch(\Exception $e) {
            return 0;
        }
    }
}
