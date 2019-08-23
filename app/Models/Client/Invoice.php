<?php

namespace App\Models\Client;

use App\Models\MailLog;
use App\Models\Scopes\SearchByTime;
use App\Models\Scopes\TableViewer;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use TableViewer, SearchByTime;

    protected $guarded = [];

    public $timestamps = false;

    public $appends = ['due'];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo(Client::class)
            ->withoutGlobalScopes();
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_invoice', 'invoice_id', 'contact_id');
    }

    public function mails()
    {
        return $this->morphMany(MailLog::class, 'sent')
            ->with('user')
            ->orderBy('created_at', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    |       Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeSearch($query)
    {
        $rules = [
            'client_id' => 'integer',
            'date'      => 'date|date_format:"d.m.Y"',
            'state'     => 'in:paid,open,archived,due'
        ];

        $v = validator(request()->all(), $rules);

        if ($v->fails()) {
            throw new \Illuminate\Validation\ValidationException($v);
        }

        return $query->searchByTime('invoice_date')->where(function ($query) {

                if (request()->filled(['search_input'])) {

                    if (intval(request('search_input'))) {
                        $query->where('id', request('search_input'));
                    } else {
                        $query->whereHas('client', function ($query) {
                            $term = strtolower(request('search_input'));

                            $query->whereRaw('lower(name) like "%' . $term . '%"');
                        });
                    }

                }

                if (request()->filled('date')) {
                    $query->where('invoice_date', toSql(request('date')));
                }

                if (request()->filled('client_id')) {
                    $query->where('client_id', request('client_id'));
                }

                if (request('state') == 'paid') {
                    $query->whereNotNull('pay_date');
                }

                if (request('state') == 'open') {
                    $query->whereNull('pay_date');
                }

                if (request('state') == 'due') {
                    $query->whereNull('pay_date')
                        ->whereRaw('invoice_date < DATE_SUB(NOW(), INTERVAL payment_period DAY)');
                }

                $query->where('archived', request('state') == 'archived');
        });
    }

    /*
    |--------------------------------------------------------------------------
    |       Accessors and Mutators
    |--------------------------------------------------------------------------
    */

    public function getDueAttribute()
    {
        return carbon($this->invoice_date)->addDays($this->payment_period)->format('Y-m-d');
    }

}
