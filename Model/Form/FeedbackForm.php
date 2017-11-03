<?php

namespace Model\Form;

class FeedbackForm
{
    public $email;
    
    public $message;


    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    // todo: add some decent logic
    public function isValid()
    {
        return !empty($this->email) && !empty($this->message);
    }
}