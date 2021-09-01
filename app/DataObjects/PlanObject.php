<?php

namespace App\DataObjects;

class PlanObject {

    public $plans;
    public $sorts;
    public $searched;

    public function __construct($plans = null, $sorts = null, $searched = null)
    {
        $this->plans = $plans;
        $this->sorts = $sorts;
        $this->searched = $searched;
    }
}
