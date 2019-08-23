<?php

namespace App\Models\Client;

use App\Models\Document;
use App\Models\Employee\Employee;
use App\Models\Note;
use App\Models\Order\Order;
use App\Models\Scopes\Client\LocationScope;
use App\Models\Scopes\TableViewer;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use TableViewer;

    protected $guarded = [];

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

    public function orders()
    {
        return $this->hasMany(Order::class)
            ->orderBy('start_date', 'desc');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class)
            ->orderBy('last_name');
    }

    public function rates()
    {
        return $this->hasMany(ChargeRate::class)
            ->orderBy('valid_from', 'desc');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class)
            ->orderBy('invoice_date');
    }

    public function invoiceData()
    {
        return $this->hasOne(InvoiceData::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'loggable')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function blockedEmployees()
    {
        return $this->belongsToMany(Employee::class, 'blacklist', 'client_id')
            ->select('id', 'first_name', 'last_name')
            ->orderBy('last_name', 'asc');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'with_documents')
            ->orderBy('created_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    |       Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeSearch($query)
    {
        $rules = [
            'id'            => 'integer|min:1',
            'state'         => 'bool'
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
                        $query->whereRaw('lower(name) like "%' . $term . '%"')
                            ->orWhereRaw('lower(location) like "%' .$term . '%"')
                            ->orWhereRaw('lower(city) like "%' . $term . '%"');
                    });
                }

            }

            if (request()->filled('location')) {
                $query->where('location', request('location'));
            }

            if (request()->filled('id')) {
                $query->where('id', request('id'));
            }

            if (request()->filled('state')) {
                $query->where('active', request('state'));
            }
        });
    }

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }


}
