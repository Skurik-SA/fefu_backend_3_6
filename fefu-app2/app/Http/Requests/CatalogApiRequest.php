<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CatalogApiRequest extends AppealFormRequest
{

    public function rules()
    {
        return [
            'category_slug' => ['required'],
            'search_query' => ['nullable'],
            'sort_mode' => ['nullable', Rule::in(['price_asc', 'price_desc'])],
            'filters' => ['nullable', 'array'],
            'filters.*' => ['required', 'array'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
