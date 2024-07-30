<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

class ProductsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'properties' => 'array',
        ];
    }


    public function prepareForValidation(): void
    {
        if ($this->properties) {
            $propNames = array_keys($this->properties);
            $properties = array_flip(Property::whereIn('slug', $propNames)->pluck('slug')->toArray());
            $this->merge([
                'properties' => array_intersect_key($this->properties, $properties),
            ]);
        }
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        return $url->route('catalog.index');
    }

}
