<?php 


// create session class
class Session {

    // Create class property
    private $signed_in = false;
    public $user_id;

    // Create constructor
    function __construct()
    {
        session_start();
        $this->checkTheLogin();
    }

    // check user is signed in
    public function isSignedIn(){
        return $this->signed_in;
    }

    // Create login method
    public function login($user){
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
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