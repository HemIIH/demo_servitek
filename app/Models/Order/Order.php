<?php

namespace App\Models\Order;

use App\Models\Client\Client;
use App\Models\Client\Contact;
use App\Models\Employee\Employee;
use App\Models\MailLog;
use App\Models\Scopes\Order\LocationScope;
use App\Models\Scopes\SearchByTime;
use App\Models\Scopes\TableViewer;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use TableViewer, Notifiable, SearchByTime;

    protected $guarded = [];

    protected $appends = ['start', 'end'];

    protected $casts = [
        'important_change' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LocationScope());
    }

    /*
    |--------------------------------------------------------------------------
    |       Relationships
    |--------------------------------------------------------------------------
    */

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_order', 'order_id', 'employee_id')
                    ->withoutGlobalScopes()
                    ->withPivot(
                        'role',
                        'working_area',
                        'approved_by_employee',
                        'rejected_by_employee',
                        'employee_available',
                        'employee_not_available',
                        'meeting_point',
                        'meeting_time',
                        'sent',
                        'sent_by',
                        'edited_by'
                    );
    }

    public function client()
    {
        return $this->belongsTo(Client::class)
            ->withoutGlobalScopes();
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_order', 'order_id', 'contact_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function timetrackings()
    {
        return $this->hasMany(Timetracking::class)
            ->orderBy('date', 'asc');
    }

    public function notes()
    {
        return $this->morphMany(\App\Models\Note::class, 'loggable')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function children()
    {
        return $this->hasMany(Order::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Order::class, 'parent_id');
    }

    public function mails()
    {
        return $this->morphMany(MailLog::class, 'sent')
            ->with('user')
            ->orderBy('created_at', 'desc');
    }

    public function calculation()
    {
        return $this->hasOne(Calculation::class);
    }

    /*
    |--------------------------------------------------------------------------
    |       Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeSearch($query)
    {
        $rules = [
            'client_id'     => 'nullable|integer|min:1',
            'start'         => 'nullable|date|date_format:"d.m.Y"',
            'end'           => 'nullable|date|date_format:"d.m.Y"'
        ];

        $v = validator(request()->all(), $rules);

        if ($v->fails()) {
            throw new \Illuminate\Validation\ValidationException($v);
        }

        return $query->searchByTime('start_date')->where(function ($query) {

            if (request()->filled('search_input')) {

                if (intval(request('search_input'))) {
                    $query->where('id', request('search_input'));
                } else {
                    $term = strtolower(request('search_input'));

                    $query->where(function ($query) use ($term) {
                        $query->whereRaw('lower(client_location) like "%' . $term . '%"')
                            ->orWhereRaw('lower(title) like "%' . $term . '%"')
                            ->orWhereRaw('lower(work_location) like "%' . $term . '%"')
                            ->orWhereHas('client', function($query) use ($term) {
                                $query->whereRaw('lower(name) like "%' . $term . '%"');
                            });
                    });
                }

            }

            if (request()->filled('client_location')) {
                $query->where('client_location', request('client_location'));
            }

            if (request()->filled('client_id')) {
                $query->where('client_id', request('client_id'));
            }

            if (in_array(request('status'), ['canceled', 'requested'])) {
                $query->where('status', request('status'));
            }

            if (in_array(request('status'), ['time_recorded', 'not_recorded'])) {
                $query->where('status', '!=', 'canceled')
                    ->where('time_recorded', (request('status') == 'time_recorded'));
            }
        });
    }

    public function scopeRequested($query)
    {
        return $query->whereNull('approved_by_employee')
                    ->whereNull('rejected_by_employee');
    }

    public function scopeApproved($query)
    {
        return $query->where('approved_by_employee', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /*
    |--------------------------------------------------------------------------
    |       Accessors and Mutators
    |--------------------------------------------------------------------------
    */

    public function getMeetingTimeAttribute($value)
    {
        return \Date::format($value, 'time');
    }

    public function setMeetingTimeAttribute($value)
    {
        return $this->attributes['meeting_time'] =  \Time::sanitze($value);
    }

    public function getStartTimeAttribute($value)
    {
        return \Date::format($value, 'time');
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = \Time::sanitze($value);
    }

    public function getEndTimeAttribute($value)
    {
        return \Date::format($value, 'time');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = \Time::sanitze($value);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = toSql($value);
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = toSql($value);
    }

    /*
    |--------------------------------------------------------------------------
    |       Appends
    |--------------------------------------------------------------------------
    */

    public function getStartAttribute()
    {
        return \Date::format($this->attributes['start_date']);
    }

    public function getEndAttribute()
    {
        return \Date::format($this->attributes['end_date']);
    }

}
