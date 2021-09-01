<?php

namespace App\DataObjects;

class UserObject {

    public $filters;
    public $roles;
    public $users;
    public $sorts;
    public $searched;

    public function __construct($filters = null, $roles = null, $users = null, $sorts = null, $searched = null)
    {
        $this->filters = $filters;
        $this->roles = $roles;
        $this->users = $users;
        $this->sorts = $sorts;
        $this->searched = $searched;
    }
}
