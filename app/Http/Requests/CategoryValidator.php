<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValidator extends FormRequest
{
    private $routeMethod;
    private $category;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->routeMethod = $this->route()->methods;
        $this->category = $this->route('category');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validationArray = [
            'title' => ['required', 'string','unique:App\Models\Category,title'],
            'sort' =>  ['required', 'numeric']
        ];

        if($this->routeMethod[0] == 'PUT'){
           $validationArray['title'] = ['required', 'string','unique:App\Models\Category,title,'.$this->category->id];
           if($this->file('image')){
               $validationArray['image'] = ['image'];
           }
            return $validationArray;
        }
        $validationArray['image'] = ['required','image'];
        return $validationArray;
    }
}
