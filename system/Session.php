<?php
    
    Class Session{
        
        //--[[CONSTRUCTORS]]--\\
        public function __construct(){
            session_save_path("../session");
            session_start();
        }
        
        //--[[FUNCTIONS]]--\\
        public function login(){
            $_SESSION['login'] = True;
        }
        
        public function logout(){
            $_SESSION['login'] = False;
            session_destroy();
        }
        
        public function checkLogin(){
            return $_SESSION['login'];
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