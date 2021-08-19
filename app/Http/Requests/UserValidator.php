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
        $this->user = User::find($this->route('user'));
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->user[1]->role == self::userRole['candidate']) {
            $validationArray = [
                'name' => ['required', 'string'],
                'city' => ['required', 'numeric', 'exists:App\Models\City,id'],
                'location' => ['required', 'string'],
                'age' => ['required', 'numeric'],
                'profession' => ['required', 'string', 'max:255'],
            ];


            if ($this->input('email') != $this->user[1]->email) {
                $validationArray['email'] = ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'];
            }
            if ($this->input('password')) {
                $validationArray['password'] = ['required', 'string', 'min:8', 'confirmed'];
            }
            if ($this->file('image')) {
                $validationArray['image'] = ['required', 'image'];
            }
            return $validationArray;
        }
        else {
            $validationArray = [
                'name' => ['required', 'string'],
                'city' => ['required', 'numeric', 'exists:App\Models\City,id'],
                'location' => ['required', 'string'],
                'comapnyname' => ['required', 'string', 'max:255'],
                'tagline' => ['required', 'string'],
            ];
            if ($this->input('email') != $this->user[1]->email) {
                $validationArray['email'] = ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'];
            }
            if ($this->input('password')) {
                $validationArray['password'] = ['required', 'string', 'min:8', 'confirmed'];
            }
            if ($this->file('image')) {
                $validationArray['image'] = ['required', 'image'];
            }
            return $validationArray;
        }
    }
}
