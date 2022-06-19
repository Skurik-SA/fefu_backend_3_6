<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CatalogFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search_query' => 'nullable|string',
            'sort' => ['nullable', Rule::in(['price_asc', 'price_desc'])],
            'filters' => 'nullable|array',
            'filters.*' => 'required|array'
        ];
    }
}
