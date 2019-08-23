<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;


abstract class Request extends FormRequest
{
    protected $conditionalRules = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validator(Factory $factory)
    {
        $validator = $factory->make($this->input(), $this->rules());

        foreach($this->conditionalRules() as $dataset) {
            $validator->sometimes($dataset['fields'], $dataset['rules'], $dataset['callback'] ?? evaluate(true));
        };

        return $validator;
    }

    public function conditionalRules()
    {
        return $this->conditionalRules;
    }

    public function sanitizeData($data)
    {
        return array_filter($data, function($var) {
            return !is_null($var);
        });
    }

}