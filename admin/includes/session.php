<?php 


// create session class
class Session {

    // Create class property
    private $signed_in = false;
    public $user_id;
    public $message;
    public $count;

    // Create constructor
    function __construct()
    {
        session_start();
        $this->checkTheLogin();
        $this->checkMessage();
        $this->visitorCount();
    }

    // Count visitor count
    public function visitorCount(){
        if(isset($_SESSION['count'])){
            return $this->count = $_SESSION['count']++;
        }else {
            return $_SESSION['count'] = 1;
        }
    }

    // create messase method
    public function message($msg = ""){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        }else {
            return $this->message;
        }
    }

    // check message set or not
    private function checkMessage(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else {
            $this->message = "";
        }
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

    // Create logout method
    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
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
$message = $session->message();