<?php

// Create new Class
class DBObject {

    /**
     * File upload errors
     */
    public $upload_errors_array = [

        UPLOAD_ERR_OK		    => "There is no error", // 0
        UPLOAD_ERR_INI_SIZE	    => "The uploaded file exceds the upload_max_filesize", // 1
        UPLOAD_ERR_FORM_SIZE	=> "The uploaded file exceeds the MAX_FILE_SIZE directive", // 2
        UPLOAD_ERR_PARTIAL	    => "The uploaded file was only partially uploaded.", // 3
        UPLOAD_ERR_NO_FILE	    => "No file was uploaded.", // 4
        UPLOAD_ERR_NO_TMP_DIR	=> "Missing a temporary folder", // 6
        UPLOAD_ERR_CANT_WRITE	=> "Failed to write file to disk", // 7
        UPLOAD_ERR_EXTENSION	=> "A PHP extension stopped the file upload." // 8


    ];

    /**
     * Find all user from the database
     */
    public static function findAll(){
        // global $database;

        // $result_set = $database->query("SELECT * FROM users");
        // return $result_set;

        return static::findByQuery("SELECT * FROM " . static::$db_table . " ");
    }

    



    /**
     * Find specific user by user id
     */
    public static function findById($id){
        global $database;

        // $result_set = $database->query("SELECT * FROM users WHERE id=$id LIMIT 1");
        // $found_user = mysqli_fetch_array($result_set);
        // return $found_user;

        // use this way / this way to more short and clear cord
        $the_result_array = static::findByQuery("SELECT * FROM " .static::$db_table. " WHERE id= $id LIMIT 1");
        
        return !empty($the_result_array)? array_shift($the_result_array) : false;
    }


  

    
    /**
     * Find any query method
     */
    public static function findByQuery($sql){
        global $database;

        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }

    



    /**
     * Auto instantiation method
     */
    public static function instantiation($found_user){
        // $the_object = new static;

        $calling_class = get_called_class();
        $the_object = new $calling_class;

        // // more better this code below the code 
        // $the_object->id         = $found_user['id'];
        // $the_object->username   = $found_user['username'];
        // $the_object->password   = $found_user['password'];
        // $the_object->first_name = $found_user['first_name'];
        // $the_object->last_name  = $found_user['last_name'];

        // this way more easy to understand and esay to assign
        foreach($found_user as $the_attribute => $value){

            if($the_object->hasTheAttribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }

        }

        return $the_object;
    }





    /**
     * Create method has or not attribute 
     */
    private function hasTheAttribute($the_attribute){
        // get this class properties
        $object_properties = get_object_vars($this);
        // check array key exist or not
        return array_key_exists($the_attribute, $object_properties);
    }



     /**
     * Create abstracting method
     */
    protected function properties(){
        // return get_object_vars($this);

        $properties = [];

        foreach(static::$db_table_field as $db_field){
            // chcek class property exists this array property 
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }




    /**
     * Create clean properties abstraction method
     */
    protected function clean_properties(){
        global $database;

        $clean_properties = [];

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
    }






    /**
     * Create save method to improve our create and update method
     */
    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }





    /**
     * User Store method
     */
    public function create(){
        global $database;

        // call to abstract method this method hold all the propertis
        $properties = $this->clean_properties();
        // create query
        $sql = "INSERT INTO ".static::$db_table."(". implode(",", array_keys($properties)) .") ";
        $sql .= "VALUES('".implode("','", array_values($properties))."')";


        // check whether the query successfully store or not
        if($database->query($sql)){
            $this->id = $database->theInsertId(); // return the inserted last id
            return true;
        }else {
            return false;
        }
    }






    /**
     * User Update Method
     */
    public function update(){
        global $database;

        // call to abstract method this method hold all the propertis
        $properties = $this->clean_properties();
        
        $properties_pairs = [];

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}= '{$value}'";
        }


        // update query
        $sql = "UPDATE ".static::$db_table." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= '".$database->escape_string($this->id)."' ";

        // execute the query
        $database->query($sql);
        // check whether the update query successfully affected or not
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }





    /**
     * User Delete Method
     */
    public function delete(){
        global $database;
        // delete query
        $sql = "DELETE FROM ".static::$db_table." ";
        $sql .= "WHERE id= " .$database->escape_string($this->id);
        $sql .= " LIMIT 1";

        // execute the query
        $database->query($sql);

        // check whether the delete successfully affected or not
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }




}




?>