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

    // Create CheckLogin Method
    private function checkTheLogin(){
        // Check session user_id set or not
        if(isset($_SESSION['user_id'])){
            $this->user_id   = $_SESSION['user_id'];
            $this->signed_in = true;
        }else {
            // if the session user_id is not set then class property user_id unset
            unset($this->user_id);
            $this->signed_in = false; 
        }
    }

}

// Instansiate of class
$session = new Session();