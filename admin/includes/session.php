<?php 


// create session class
class Session {

    // Create class property
    private $signed_in;
    public $user_id;

    // Create constructor
    function __construct()
    {
        session_start();
    }

}

// Instansiate of class
$session = new Session();