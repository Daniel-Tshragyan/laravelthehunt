<?php

namespace App\DataObjects;

class ApplicationObject {

    public $applications;
    public $sorts;
    public $searched;

    public function __construct($applications = null, $sorts = null, $searched = null)
    {
        $this->applications = $applications;
        $this->sorts = $sorts;
        $this->searched = $searched;
    }
}
