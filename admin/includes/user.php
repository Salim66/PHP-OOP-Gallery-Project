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
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    }

    
    /**
     * Auto instantiation method
     */
    public static function instantiation($found_user){
        $the_object = new self;

        // // more better this code below the code 
        // $the_object->id         = $found_user['id'];
        // $the_object->username   = $found_user['username'];
        // $the_object->password   = $found_user['password'];
        // $the_object->first_name = $found_user['first_name'];
        // $the_object->last_name  = $found_user['last_name'];

        // this way more easy to understand and esay to assign
        foreach($found_user as $the_attribute => $value){

            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }

        }

        return $the_object;
    }

    /**
     * Create method has or not attribute 
     */
    private function has_the_attribute($the_attribute){
        // get this class properties
        $object_properties = get_object_vars($this);
        // check array key exist or not
        return array_key_exists($the_attribute, $object_properties);
    }


}