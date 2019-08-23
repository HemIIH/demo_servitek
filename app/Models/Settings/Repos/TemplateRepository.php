<?php

namespace App\Models\Settings\Repos;

use App\Models\Settings\Template;

class TemplateRepository
{
    /**
     * Get template for a given name.
     *
     * @param $name
     * @return mixed
     */
    public function byName($name)
    {
        return Template::where('name', $name)->first();
    }

}