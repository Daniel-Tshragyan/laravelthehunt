<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
class UserValidator extends FormRequest
{
    private $user;
    const userRole =[
        'comapny' => 2,
        'candidate' => 1,
    ];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->user = $this->route('user');
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
            'name' => ['required', 'string'],
            'city' => ['required', 'numeric', 'exists:App\Models\City,id'],
            'location' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email,' . $this->user->id]
        ];

        if ($this->input('password')) {
            $validationArray['password'] = ['string', 'min:8', 'confirmed'];
        }
        if ($this->file('image')) {
            $validationArray['image'] = ['image'];
        }

        if ($this->user->role == self::userRole['candidate']) {
            $validationArray['age'] = ['required', 'numeric'];
            $validationArray['profession'] = ['required', 'string', 'max:255'];
        } else {
            $validationArray['comapnyname'] = ['required', 'string', 'max:255'];
            $validationArray['tagline'] = ['required', 'string'];
        }

        return $validationArray;
    }
}
