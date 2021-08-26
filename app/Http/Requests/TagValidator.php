<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagValidator extends FormRequest
{

    private $routeMethod;
    private $tag;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->routeMethod = $this->route()->methods;
        $this->tag = $this->route('tag');
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
                'title' => ['required', 'string','unique:App\Models\Tag,title,'.$this->tag->id]
            ];
        }
        return [
            'title' => ['required', 'string', 'unique:App\Models\Tag']
        ];
    }
}
