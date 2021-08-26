<?php

namespace App\Service;


use App\Models\Aplication;
use App\Models\Category;
use App\Models\City;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\JobValidation;
use App\Http\Requests\AdminJobValidator;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class JobService
{

    public function paginationArguments($data, $from = null)
    {
        $withPath = '';
        $order_by = 'id';
        $how = 'asc';
        $where = [];
        $job_tags = [];
        $searched = ['title' => '', 'location' => '', 'id' => '', 'description' => '',
            'closing_date' => '', 'price' => '', 'url' => '', 'company_id' => '', 'category_id' => '',];

        if (isset($data["order_by"])) {
            $order_by = $data["order_by"];
        }
        if (isset($data['job_tags'])) {
            $job_tags = $data['job_tags'];
        }
        $searched['job_tags'] = $job_tags;

        if (isset($data["how"])) {
            $how = $data['how'];
        }
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) || isset($data[$key]) && (!is_null($data[$key]) && $data[$key] == 0)) {
                if ($key == 'title' || $key == 'location' || $key == 'description' || $key == 'url') {
                    $where[] = [$key, 'like', "%{$data[$key]}%"];
                    $withPath .= "&{$key}={$data[$key]}";
                    $searched[$key] = $data[$key];
                } elseif ($key != 'job_tags') {
                    $where[] = [$key, '=', "{$data[$key]}"];
                    $withPath .= "&{$key}={$data[$key]}";
                    $searched[$key] = $data[$key];
                }
            }
        }
        if ($from == 'front') {
            return $this->frontJobGetPagination($job_tags, ['withPath' => $withPath, 'order_by' => $order_by,
                'searched' => $searched,
                'where' => $where, 'how' => $how]);
        } else {
            return $this->getPagination($job_tags, ['withPath' => $withPath, 'order_by' => $order_by,
                'searched' => $searched,
                'where' => $where, 'how' => $how]);
        }

    }

    public function getPagination($job_tags, $data)
    {

        $jobs = $this->getJobs($job_tags, $data);

        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'title' => $data['how'], 'location' => $data['how'],
            'job_tags' => $data['how'], 'description' => $data['how'],
            'closing_date' => $data['how'], 'price' => $data['how'], 'url' => $data['how'],
            'company_id' => $data['how'], 'category_id' => $data['how'],
        ];
        $newarray = ['tags' => Tag::all(), 'jobs' => $jobs, 'sorts' => $data['sorts'], 'searched' => $data['searched']];
        return $newarray;
    }

    public function frontJobGetPagination($job_tags, $data)
    {
        $jobs = $this->getJobs($job_tags, $data);

        if ($data['how'] == 'asc') {
            $data['how'] = 'desc';
        } else {
            $data['how'] = 'asc';
        }
        $data['sorts'] = ['id' => $data['how'], 'title' => $data['how'],
            'location' => $data['how'], 'job_tags' => $data['how'], 'description' => $data['how'],
            'closing_date' => $data['how'], 'price' => $data['how'], 'url' => $data['how'],
            'company_id' => $data['how'], 'category_id' => $data['how'],
        ];
        $newarray = ['tags' => Tag::all(), 'jobs' => $jobs, 'sorts' => $data['sorts'], 'searched' => $data['searched']];

        return $newarray;
    }

    public function getJobs($job_tags, $data)
    {
        if (empty($job_tags)) {
            if (!empty($data['where'])) {
                $jobs = Job::where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
                $jobs->withPath("job?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);
            } else {
                $jobs = Job::orderBy($data['order_by'], $data['how'])->paginate(3);
                $jobs->withPath("job?order_by={$data['order_by']}&how={$data['how']}");
            }
        } else {
            if (!empty($data['where'])) {
                $jobs = Job::whereHas('tags', function ($tag) use ($job_tags) {
                    $tag->whereIn('tags.id', $job_tags);
                })->where($data['where'])->orderBy($data['order_by'], $data['how'])->paginate(3);
                $jobs->withPath("job?order_by={$data['order_by']}&how={$data['how']}" . $data['withPath']);
            } else {
                $jobs = Job::whereHas('tags', function ($tag) use ($job_tags) {
                    $tag->whereIn('tags.id', $job_tags);
                })->orderBy($data['order_by'], $data['how'])->paginate(3);
                $jobs->withPath("job?order_by={$data['order_by']}&how={$data['how']}");
            }
        }
        return $jobs;
    }

    public function deleteJob(Job $job)
    {
        return $job->delete();
    }

    public function jobFill($data)
    {
        $tags = $data['job_tags'];
        unset($data['job_tags']);
        $job = new Job();
        $job->fill($data);
        $job->save();
        return $job->tags()->attach($tags);
    }

    public function frontJobUpdate($data, Job $job)
    {

        $tags = $data['job_tags'];
        unset($data['job_tags']);
        $job->fill($data);
        $job->update();
        return $job->tags()->sync($tags);
    }

    public function JobUpdate($data, Job $job)
    {
        $tags = $data['job_tags'];
        unset($data['job_tags']);
        $job->fill($data);
        $job->update();
        return $job->tags()->sync($tags);
    }

    public function jobFrontFill($data)
    {
        $data['company_id'] = auth()->user()->id;
        $tags = $data['job_tags'];
        unset($data['job_tags']);
        $job = new Job();
        $job->fill($data);
        $job->save();
        return $job->tags()->attach($tags);
    }

    public function changeCategoryJobCount($id)
    {
        $category = Category::find($id);
        if (!is_null($category)) {
            $category->fill([
                'jobs_count' => $category->job->count()
            ]);
            return $category->update();
        }
        return true;
    }

    public function candidateJobs($data)
    {
        $searched = ['city' => '', 'location' => '', 'title' => ''];
        $where = [];
        $withPath = '';
        $tag = '';
        if(isset($data['city'])){
            $searched['city'] = $data['city'];
        }
        foreach ($searched as $key => $value) {
            if (isset($data[$key]) && !is_null($data[$key]) && $key != 'city' && $key != 'job_tag') {
                $where[] = [$key, 'like', "%{$data[$key]}%"];
                $withPath .= "&{$key}={$data[$key]}";
                $searched[$key] = $data[$key];
            }
        }
        if (isset($data['job_tag'])){
//            die('ka');
            $tag = $data['job_tag'];
            $searched['job_tag'] = $data['job_tag'];
            $jobs = $this->getCandidateJobsWithTags($data,$tag, $where, $withPath);
        }else {
//            die('chka');
            $searched['job_tag'] = $tag;
            $jobs = $this->getCandidateJobsWithOutTags($data, $where, $withPath);
        }
        $cities = City::all();
        $applyed = false;
        $tags = Tag::all();

        return compact('jobs','searched','tags','applyed','cities');
    }

    public function getCandidateJobsWithTags($data, $job_tag, $where, $withPath)
    {
            if (isset($data['city'])) {
                $jobs = Job::whereHas('user', function ($u) use ($data) {
                    $u->whereHas('company', function ($c) use ($data) {
                        $c->where('city_id', '=', $data['city']);
                    });
                })->whereHas('tags',function($tag) use ($job_tag){
                    $tag->whereIn('tags.id', [$job_tag]);
                })->where($where)->paginate('3');
                $withPath .= "&city={$data['city']}";
                $withPath .= "&job_tag={$job_tag}";
                $jobs->withPath('browse-jobs?' . $withPath);
                $searched['city'] = $data['city'];
            } else {
                $jobs = Job::whereHas('tags',function($tag) use ($job_tag){
                    $tag->whereIn('tags.id', [$job_tag]);
                })->where($where)->paginate(3);
                $withPath .= "&job_tag={$job_tag}";
                $jobs->withPath('browse-jobs?' . $withPath);
            }

        return $jobs;
    }
    public function getCandidateJobsWithOutTags($data, $where, $withPath)
    {
        if (isset($data['city'])) {
            $jobs = Job::whereHas('user', function ($u) use ($data) {
                $u->whereHas('company', function ($c) use ($data) {
                    $c->where('city_id', '=', $data['city']);
                });
            })->where($where)->paginate('3');
            $withPath .= "&city={$data['city']}";
            $jobs->withPath('browse-jobs?' . $withPath);
            $searched['city'] = $data['city'];
        } else {
            $jobs = Job::where($where)->paginate(3);
            $jobs->withPath('browse-jobs?' . $withPath);
        }

        return $jobs;

    }

    public function apply(int $id)
    {
        $job = Job::find($id);
        $job->candidates()->attach(auth()->user()->candidate->id);
        $application = new Aplication();
        $application->fill([
            'company_id' => $job->user->company->id,
            'text' => "User " . auth()->user()->name . " appliyed to {$job->title} Job",
        ]);
        $application->save();
        return $job;
    }

    public function showCandidateJob($id)
    {
        $job = Job::find($id);
        $applyed = false;
        foreach($job->candidates as $candidate){
            if($candidate->id == auth()->user()->candidate->id){
                $applyed = true;
            }
        }
        $tags = Tag::all();
        return compact('tags', 'job','applyed');
    }
}
