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

    public function paginationArguments($data)
    {
        $searched = ['name' => '', 'email' => '', 'id' => '', 'role' => '',];
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        if (isset($data["order_by"])) {
            $order_by = $data["order_by"];
        }
        if (isset($data["how"])) {
            $how = $data["how"];
        }
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) || isset($data[$key]) && (!is_null($data[$key]) && $data[$key] == 0)) {
                if ($key == 'name' || $key == 'email') {
                    $where[] = [$key, 'like', "%{$data[$key]}%"];
                    $withPath .= "&{$key}={$data[$key]}";
                    $searched[$key] = $data[$key];
                } else {
                    $where[] = [$key, '=', "{$data[$key]}"];
                    $withPath .= "&{$key}={$data[$key]}";
                    $searched[$key] = $data[$key];
                }
            }
        }
        return $this->getPaginationArguments(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
            'where' => $where, 'how' => $how]);
    }

    public function getPaginationArguments($data)
    {
        if (!empty($data['where'])) {
            $users = User::where($data['where'])->whereNotIn('email', ['admin'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $users->withPath("user?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);

        } else {
            $users = User::whereNotIn('email', ['admin'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $users->withPath("user?order_by={$data['order_by']}&how={$data['how']}");
        }
        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'name' => $data['how'], 'role' => $data['how'], 'email' => $data['how']];
        $data['roles'] = ['Admin','Candidate','Company'];
        $newarray = ['filters' => self::filters, 'roles' =>$data['roles'], 'users' => $users, 'sorts' => $data['sorts'], 'searched' => $data['searched']];

        return $newarray;
    }


    public function updateUser($data, User $user)
    {
        $userInformation = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];
        if (isset($data['password'])) {
            $userInformation['password'] = Hash::make($data['password']);
        }
        $user->fill($userInformation);
        return $user->update();
    }

    public function updateCandidate($data, User $user)
    {
        $fillInformation = [
            'city_id' => $data['city'],
            'location' => $data['location'],
            'age' => $data['age'],
            'profession' => $data['profession'],
        ];

        $candidat = $user->candidate->toArray();
        if (isset($data['image'])) {
            Storage::delete('/public/users_images/' . $candidat['image']);
            $random = Str::random(60);
            $imageName = $random . '.' . $data['image']->extension();
            $data['image']->storeAs('public/users_images', $imageName);
            $fillInformation['image'] = $imageName;
        }
        if (isset($data['password'])) {
            $fillInformation['password'] = $data['password'];
        }
        $user->candidate->fill($fillInformation);
        return $user->candidate->update();
    }

    public function updateCompany($data, User $user)
    {
        $data = $data;
        $fillInformation = [
            'city_id' => $data['city'],
            'location' => $data['location'],
            'age' => $data['tagline'],
            'profession' => $data['comapnyname'],
            'plan_id' => $data['plan'],
        ];
        $company = $user->company->toArray();
        if (isset($data['password'])) {
            $fillInformation['password'] = $data['password'];
        }
        if (isset($data['image'])) {
            Storage::delete('/public/users_images/' . $company['image']);
            $random = Str::random(60);
            $imageName = $random . '.' . $data['image']->extension();
            $data['image']->storeAs('public/users_images', $imageName);
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
