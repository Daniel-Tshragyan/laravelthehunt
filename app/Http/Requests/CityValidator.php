<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityValidator extends FormRequest
{
    private $routeMethod;
    private $city;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->routeMethod = $this->route()->methods;
        $this->city = $this->route('city');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->routeMethod[0] == 'PUT'){
            return [
                'name' => ['required', 'string','unique:App\Models\City,name,'.$this->city->id]
            ];
        }
        return [
            'name' => ['required', 'string']
        ];
    }
}
