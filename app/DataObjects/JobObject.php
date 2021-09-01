<?php

namespace App\DataObjects;

class JObObject {

    public $jobs;
    public $job;
    public $admin_jobs;
    public $sorts;
    public $searched;
    public $tags;
    public $applyed;
    public $cities;
    public $categories;
    public $companies;

    public function __construct($jobs = null, $admin_jobs = null, $sorts = null, $searched = null,
                                $tags = null, $applyed = null, $cities = null, $job = null)
    {
        $this->jobs = $jobs;
        $this->admin_jobs = $admin_jobs;
        $this->sorts = $sorts;
        $this->searched = $searched;
        $this->tags = $tags;
        $this->applyed = $applyed;
        $this->cities = $cities;
        $this->job = $job;
    }
}
