<?php 


// Create user class
class User {

    // create class property
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name; 


    /**
     * Find all user from the database
     */
    public static function findAllUsers(){
        // global $database;

        // $result_set = $database->query("SELECT * FROM users");
        // return $result_set;

        return self::findThisQuery("SELECT * FROM users");
    }

    
    /**
     * Find specific user by user id
     */
    public static function findUserById($user_id){
        // global $database;

        // $result_set = $database->query("SELECT * FROM users WHERE id=$user_id LIMIT 1");
        // $found_user = mysqli_fetch_array($result_set);
        // return $found_user;

        // use this way / this way to more short and clear cord
        $result_set = self::findThisQuery("SELECT * FROM users WHERE id=$user_id LIMIT 1");
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;
    }

    
    /**
     * Find any query method
     */
    public static function findThisQuery($sql){
        global $database;

        $result_set = $database->query($sql);
        return $result_set;
    }


}