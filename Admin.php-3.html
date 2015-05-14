<?php
    Class Admin{
        
        //--[[DECLARE]]--\\
        private $ID;
        private $username;
        private $password;
        private $name;
        private $DOB;
        private $image;
        private $aes;
        private $tableName;
        
        //--[[CONSTRUCTORS]]--\\
        public function __construct(){
            $this->tableName = "Admin";
            $this->aes = "67E4DCF9A8AE1";
        }
        public function create($username,$password,$name,$DOB,$image){
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->DOB = $DOB;
            $this->image = $image;            
        }
        public function set($ID,$username,$password,$name,$DOB,$image){
            $this->ID = $ID;
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->DOB = $DOB;
            $this->image = $image;
        }
        
        //--[[FUNCTIONS]]--\\
        public function login($username,$password){
            $sql = "SELECT * FROM ".$this->tableName." WHERE Username = '".$username."' AND Password = AES_ENCRYPT('".$password."','".$this->aes."');";
            return $sql;
        }
        public function add(){
            $sql = "INSERT INTO ".$this->tableName." (Username,Password,Name,DOB,Image) VALUES ('".$this->username."',AES_ENCRYPT('".$this->password."','".$this->aes."'),"
                    ."'".$this->name."','".$this->DOB."','".$this->image."');";
            return $sql;
        }
        
        //--[[GETTER & SETTER]]--\\
        public function __get($property) {
			if (property_exists($this, $property)) {
			  return $this->$property;
			}
		}

		public function __set($property, $value) {
			if (property_exists($this, $property)) {
			  $this->$property = $value;
			}

			return $this;
		}
    }
?>