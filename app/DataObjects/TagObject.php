<?php

namespace App\DataObjects;

class TagObject {

    public $tags;
    public $sorts;
    public $searched;

    public function __construct($tags = null, $sorts = null, $searched = null)
    {
        $this->tags = $tags;
        $this->sorts = $sorts;
        $this->searched = $searched;
    }
}
