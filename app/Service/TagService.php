<?php

namespace App\Service;


use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\JobValidation;
use App\Http\Requests\AdminJobValidator;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class TagService
{
    public function paginationArguments($data)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $searched = ['id' => '', 'title' => ''];

        if (isset($data["order_by"])) {
            $order_by = $data["order_by"];
        }

        if (isset($data["how"])) {
            $how = $data['how'];
        }
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) || isset($data[$key]) && (!is_null($data[$key]) && $data[$key] == 0)) {
                if ($key == 'title') {
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
        return $this->getPagination(['withPath' => $withPath, 'order_by' => $order_by, 'searched' => $searched,
            'where' => $where, 'how' => $how]);
    }

    public function getPagination($data)
    {
        if (!empty($data['where'])) {
            $tags = Tag::where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
            $tags->withPath("tag?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);
        } else {
            $tags = Tag::orderBy($data['order_by'], $data['how'])->paginate(3);
            $tags->withPath("tag?order_by={$data['order_by']}&how={$data['how']}");
        }
        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'title' => $data['how']];
        return ['tags' => $tags, 'sorts' => $data['sorts'], 'searched' => $data['searched']];
    }

    public function createTag($data)
    {
        $tag = new Tag();
        $tag->fill([
            'title' => $data['title']
        ]);
        return $tag->save();
    }

    public function updateTag(Tag $tag,$data)
    {
        $tag->fill([
            'title' => $data['title']
        ]);
        return $tag->update();
    }

    public function deleteTag(Tag $tag)
    {
        return $tag->delete();
    }
}
