<?php

namespace App\Services\Helper;

trait LogMailTraffic
{
    /**
     * Log info about sent mail to database.
     *
     * @param $resource
     * @param null $information
     */
    public function log($resource, $information = null)
    {
        $resource->mails()->create([
            'information' => $information,
            'sent_by'     => auth()->user()->id
        ]);
    }

}