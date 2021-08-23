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

    public function paginationArguments($arr)
    {
        $searched = ['name' => '', 'email' => '', 'id' => '', 'role' => '',];
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        if (isset($arr["order_by"])) {
            $order_by = $arr["order_by"];
        }
        if (isset($arr["how"])) {
            $how = $arr["how"];
        }
        foreach ($searched as $key => $value) {
            if (isset($arr[$key]) || isset($arr[$key]) && (!is_null($arr[$key]) && $arr[$key] == 0)) {
                if ($key == 'name' || $key == 'email') {
                    $where[] = [$key, 'like', "%{$arr[$key]}%"];
                    $withPath .= "&{$key}={$arr[$key]}";
                    $searched[$key] = $arr[$key];
                } else {
                    $where[] = [$key, '=', "{$arr[$key]}"];
                    $withPath .= "&{$key}={$arr[$key]}";
                    $searched[$key] = $arr[$key];
                }
            }
        }
        return $this->getPaginationArguments(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
            'where' => $where, 'how' => $how]);
    }

    public function getPaginationArguments($array)
    {
        if (!empty($array['where'])) {
            $users = User::where($array['where'])->whereNotIn('email',['admin'])->orderBy($array['order_by'], $array['how'])->paginate(3);
            $users->withPath("user?order_by={$array['order_by']}&how={$array['how']}" . $array['withPath']);

        } else {
            $users = User::whereNotIn('email',['admin'])->orderBy($array['order_by'], $array['how'])->paginate(3);
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


    public function updateUser($arr, User $user)
    {
        $userInformation = [
            'name' => $arr['name'],
            'email' => $arr['email'],
        ];
        if (isset($arr['password'])) {
            $userInformation['password'] = Hash::make($arr['password']);
        }
        $user->fill($userInformation);
        return $user->update();
    }

    public function updateCandidate($arr, User $user)
    {
        $fillInformation = [
            'city_id' => $arr['city'] ,
            'location' => $arr['location'],
            'age' => $arr['age'],
            'profession' => $arr['profession'],
        ];

        $candidat = $user->candidate->toArray();
        if (isset($arr['image'])) {
            Storage::delete('/public/users_images/' . $candidat['image']);
            $random = Str::random(60);
            $imageName = $random . '.' . $arr['image']->extension();
            $arr['image']->storeAs('public/users_images', $imageName);
            $fillInformation['image'] = $imageName;
        }
        if (isset($arr['password'])) {
            $fillInformation['password'] = $arr['password'];
        }
        $user->candidate->fill($fillInformation);
        return $user->candidate->update();
    }

    public function updateCompany($arr, User $user)
    {
        $data = $arr;
        $fillInformation = [
            'city_id' => $arr['city'] ,
            'location' => $arr['location'],
            'age' => $arr['tagline'],
            'profession' => $arr['comapnyname'],
        ];
        $company = $user->company->toArray();
        if (isset($arr['password'])) {
            $fillInformation['password'] = $arr['password'];
        }
        if (isset($arr['image'])) {
            Storage::delete('/public/users_images/' . $company['image']);
            $random = Str::random(60);
            $imageName = $random . '.' . $arr['image']->extension();
            $arr['image']->storeAs('public/users_images', $imageName);
            $fillInformation['image'] = $imageName;
        }
        $user->company->fill($fillInformation);
        return $user->company->update();
    }

    public function deleteCompany(User $user)
    {
        $company = $user->company->toArray();
        return Storage::delete('/public/users_images/' . $company['image']);
    }

    public function deleteCandidate(User $user)
    {
        $candidat = $user->candidate->toArray();
        return Storage::delete('/public/users_images/' . $candidat['image']);
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }

}
