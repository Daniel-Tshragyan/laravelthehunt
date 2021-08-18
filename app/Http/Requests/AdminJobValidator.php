<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminJobValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'location' => ['required', 'string'],
            'job_tags' => ['required', 'string'],
            'description' => ['required', 'string'],
            'closing_date' => ['required', 'date'],
            'price' => ['required', 'numeric','digits_between:1,7'],
            'url' => ['required', 'string'],
            'company_id' => ['required', 'exists:App\Models\Company,user_id'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
