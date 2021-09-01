<?php

namespace App\DataObjects;

class CategoryObject {

    public $categories;
    public $sorts;
    public $searched;

    public function __construct($categories = null, $sorts = null, $searched = null)
    {
        $this->categories = $categories;
        $this->sorts = $sorts;
        $this->searched = $searched;
    }
}
