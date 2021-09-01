<?php

namespace App\DataObjects;

class ActiveDialog {

    public $user;
    public $dialogs;
    public $messages;
    public $limit;

    public function __construct($user = null, $dialogs = null, $messages = null,$limit = null)
    {
        $this->user = $user;
        $this->dialogs = $dialogs;
        $this->messages = $messages;
        $this->limit = $limit;
    }
}
