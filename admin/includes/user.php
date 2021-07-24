<?php 


// Create user class
class User extends DBObject {

    // create class property
    protected static $db_table = "users";
    protected static $db_table_field = ["username", "password", "first_name", "last_name", "user_image"];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name; 
    public $user_image; 
    public $upload_directory = "images"; 
    public $image_placeholder = "http://placehold.it/400x400&text=image"; 



    /**
     * User Image path and Placeholder method
     */
    public function imagePathAndPlaceholder(){
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }


   
    /**
     * User verify from the database
     */
    public static function verify_user($username, $password){
        // before we sending data into database first we clean up the string / unnessary token and symbol
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

         // use this way / this way to more short and clear cord
         $the_result_array = self::findByQuery($sql);
         return !empty($the_result_array)? array_shift($the_result_array) : false;

    }


    // This is passing $_FILES['upload_file'] as an argument
    public function setFile($file){

        if(empty($file) || !$file || !is_array($file)){

            $this->errors[] = "There was no file uploaded here";
            return false; 

        }elseif($file['error'] != 0){

            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;

        }else {

            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];

        }
    }

    // Create save method
    public function saveUserAndImage(){

        // check whether the id has or not
        if($this->id){
            $this->update();
        }else {

            // Check $errors is not empty
            if(!empty($this->errors)){
                return false;
            }

            // Check whether the user_image and tmp_name is empty
            if(empty($this->user_image) || empty($this->tmp_path)){
                $this->errors[] = 'The file was not available';
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            // check whether the file already has 
            if(file_exists($target_path)){
                $this->errors[] = 'The file {$this->user_image} already exists';
                return false;
            }

            // upload a file
            if(move_uploaded_file($this->tmp_path, $target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            }else {
                $this->errors[] = 'The file directory probabily does not have permission';
                return false;
            }

        }
    }

    
    //  upload user photo
    public function uploadPhoto(){

            // Check $errors is not empty
            if(!empty($this->errors)){
                return false;
            }

            // Check whether the user_image and tmp_name is empty
            if(empty($this->user_image) || empty($this->tmp_path)){
                $this->errors[] = 'The file was not available';
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            // check whether the file already has 
            if(file_exists($target_path)){
                $this->errors[] = 'The file {$this->user_image} already exists';
                return false;
            }

            // upload a file
            if(move_uploaded_file($this->tmp_path, $target_path)){

                    unset($this->tmp_path);
                    return true;

            }else {
                $this->errors[] = 'The file directory probabily does not have permission';
                return false;
            }

    }



    /**
     * User delete method
     */
    public function deleteUser(){
        if($this->delete()){
            $target_path = SITE_ROOT.DS.'admin'.$this->imagePathAndPlaceholder();
            return ($target_path) ? true : false;
        }else {
            redirect('users.php');
        }
    }


    /**
     * image update by ajax
     */
    public function ajaxSaveUserImage($user_id, $user_image){

        $this->id         = $user_id;
        $this->user_image = $user_image;
        $this->save();

    }



}