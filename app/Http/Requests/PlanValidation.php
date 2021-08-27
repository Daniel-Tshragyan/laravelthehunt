<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanValidation extends FormRequest
{

    private $routeMethod;
    private $plan;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->routeMethod = $this->route()->methods;
        $this->plan = $this->route('plan');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->routeMethod[0] == 'PUT') {
            return [
                'title' => ['required', 'string', 'unique:App\Models\PLan,title,' . $this->plan->id],
                'expired_days' => ['required', 'numeric', 'digits_between:1,6'],
                'jobs_count' => ['required', 'numeric', 'digits_between:1,6'],
                'featured_job' => ['nullable', 'in:on'],
                'job_listing' => ['nullable', 'in:on'],
                'price' => ['required', 'numeric', 'digits_between:1,7'],
                'manage_applications' => ['nullable', 'in:on'],
            ];
        }
        return [
            'title' => ['required', 'string'],
            'jobs_count' => ['required', 'numeric', 'digits_between:1,6'],
            'expired_days' => ['required', 'numeric', 'digits_between:1,6'],
            'price' => ['required', 'numeric', 'digits_between:1,7'],
            'featured_job' => ['nullable', 'in:on'],
            'job_listing' => ['nullable', 'in:on'],
            'manage_applications' => ['nullable', 'in:on'],
        ];
    }
}
