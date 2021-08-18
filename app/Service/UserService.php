<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService
{

    public function paginationArguments(Request $request,$searched)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        if ($request->input("order_by")) {
            $order_by = $request->input('order_by');
        }
        if ($request->input('how')) {
            $how = $request->input('how');
        }
        foreach ($searched as $key => $value) {
            if ($request->input($key) || (!is_null($request->input($key)) && $request->input($key) == 0)) {
                if ($key == 'name' || $key == 'email') {
                    $where[] = [$key, 'like', "%{$request->input($key)}%"];
                    $withPath .= "&{$key}={$request->input($key)}";
                    $searched[$key] = $request->input($key);
                } else {
                    $where[] = [$key, '=', "{$request->input($key)}"];
                    $withPath .= "&{$key}={$request->input($key)}";
                    $searched[$key] = $request->input($key);
                }
            }
        }
        return $returnObject = [ 'withPath' => $withPath,'order_by' => $order_by,'searched' =>$searched,
            'where' => $where,'how' => $how ];
    }

    public function candidateValidate(Request $request, User $user)
    {
        $validationArray = [
            'name' => ['required', 'string'],
            'city' => ['required', 'numeric', 'exists:App\Models\City,id'],
            'location' => ['required', 'string'],
        ];

        $userInformation = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        if ($request->input('email') != $user->email) {
            $validationArray['email'] = ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'];
        }
        if ($request->input('password')) {
            $validationArray['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $userInformation['password'] = Hash::make($request->input('password'));
        }
        if ($request->file('image')) {
            $validationArray['image'] = ['required', 'image'];
        }
        if ($user->role == 'candidate') {
            $validationArray['age'] = ['required', 'numeric'];
            $validationArray['profession'] = ['required', 'string', 'max:255'];
        }
        $request->validate($validationArray);
        $user->fill($userInformation);
        return $user->save();
    }

    public function companyValidate(Request $request, User $user)
    {
        $validationArray = [
            'name' => ['required', 'string'],
            'city' => ['required', 'numeric', 'exists:App\Models\City,id'],
            'location' => ['required', 'string'],
        ];
        $userInformation = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        if ($request->input('email') != $user->email) {
            $validationArray['email'] = ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'];
        }
        if ($request->input('password')) {
            $validationArray['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $userInformation['password'] = Hash::make($request->input('password'));
        }
        if ($request->file('image')) {
            $validationArray['image'] = ['required', 'image'];
        }
        if ($user->role == 'company') {
            $validationArray['comapnyname'] = ['required', 'string', 'max:255'];
            $validationArray['tagline'] = ['required', 'string'];
        }
        $request->validate($validationArray);
        $user->fill($userInformation);
        return $user->save();
    }

    public function updateCandidate(Request $request, User $user)
    {
        $fillInformation = [
            'city_id' => $request->input('city'),
            'location' => $request->input('location'),
            'age' => $request->input('age'),
            'profession' => $request->input('profession'),
        ];

        $candidat = $user->candidate->toArray();
        if ($request->file('image')) {
            Storage::delete('/public/users_images/' . $candidat['image']);
            $random = Str::random(60);
            $imageName = $random . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/users_images', $imageName);
            $fillInformation['image'] = $imageName;
        }
        $user->candidate->fill($fillInformation);
        $user->candidate->save();
    }

    public function updateCompany(Request $request, User $user)
    {
        $fillInformation = [
            'city_id' => $request->input('city'),
            'location' => $request->input('location'),
            'tagline' => $request->input('tagline'),
            'comapnyname' => $request->input('comapnyname'),
        ];
        $company = $user->company->toArray();
        if ($request->file('image')) {
            Storage::delete('/public/users_images/' . $company['image']);
            $random = Str::random(60);
            $imageName = $random . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/users_images', $imageName);
            $fillInformation['image'] = $imageName;
        }
        $user->company->fill($fillInformation);
        $user->company->save();
    }

}
