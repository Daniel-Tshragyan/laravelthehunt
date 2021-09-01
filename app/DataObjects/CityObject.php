<?php

namespace App\DataObjects;

class CityObject {

    public $cities;
    public $sorts;
    public $searched;

    public function __construct($cities = null, $sorts = null, $searched = null)
    {
        $this->cities = $cities;
        $this->sorts = $sorts;
        $this->searched = $searched;
    }
}
