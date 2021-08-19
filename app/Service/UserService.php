<?php

namespace App\Service;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\UserValidator;

class UserService
{

    const filters = [
        '0' => 'admin',
        '1' => 'candidate',
        '2' => 'company'
    ];

    public function paginationArguments(Request $request)
    {
        $searched = ['name' => '', 'email' => '', 'id' => '', 'role' => '',];
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
        return $this->getPaginationArguments( [ 'withPath' => $withPath,'order_by' => $order_by,'searched' =>$searched,
            'where' => $where,'how' => $how ]);
    }

    public function getPaginationArguments($array)
    {
        if (!empty($array['where'])) {
            $users = User::where($array['where'])->orderBy($array['order_by'], $array['how'])->paginate(3);
            $users->withPath("user?order_by={$array['order_by']}&how={$array['how']}" . $array['withPath']);

        } else {
            $users = User::orderBy($array['order_by'], $array['how'])->paginate(3);
            $users->withPath("user?order_by={$array['order_by']}&how={$array['how']}");
        }
        if ($array['how'] == 'asc') {
            $array['how'] = 'desc';
        } else {
            $array['how'] = 'asc';
        }
        $array['sorts'] = ['id' => $array['how'], 'name' => $array['how'], 'role' => $array['how'], 'email' => $array['how']];

        $newarray = ['filters' => self::filters, 'users' => $users, 'sorts' => $array['sorts'], 'searched' => $array['searched']];

        return $newarray;
    }



    public function updateUser(UserValidator $request, User $user)
    {
        $userInformation = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];
        if ($request->input('password')) {
            $userInformation['password'] = Hash::make($request->input('password'));
        }
        $user->fill($userInformation);
        return $user->save();
    }

    public function updateCandidate(UserValidator $request, User $user)
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
        return $user->candidate->save();
    }

    public function updateCompany(UserValidator $request, User $user)
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
        return $user->company->save();
    }

    public function deleteCompany(User $user)
    {
        $company = $user->company->toArray();
        Storage::delete('/public/users_images/' . $company['image']);
        return $user->delete();
    }
    public function deleteCandidate(User $user)
    {
        $candidat = $user->candidate->toArray();
        Storage::delete('/public/users_images/' . $candidat['image']);
        return $user->delete();
    }

}
