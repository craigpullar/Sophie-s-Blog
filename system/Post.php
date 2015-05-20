<?php
    Class Post{
        //--[[Declare]]--\\
        private $tableName;
        private $ID;
        private $title;
        private $text;
        private $date;
        private $lastEdit;
        private $adminID;
        
        //--[[Contructors]]--\\
        public function __construct(){
            $this->tableName = "Post";
        }
        
        public function create($title,$text,$date,$lastEdit,$adminID){
            $this->title = $title;
            $this->text = $text;
            $this->date = $date;
            $this->lastEdit = $lastEdit;
            $this->adminID = $adminID;
        }
        public function set($ID,$title,$text,$date,$lastEdit,$adminID){
            $this->ID = $ID;
            $this->title = $title;
            $this->text = $text;
            $this->date = $date;
            $this->lastEdit = $lastEdit;
            $this->adminID = $adminID;        
        }
        //--[[Functions]]--\\
        public function add(){
            $sql= "INSERT INTO ".$this->tableName." (Title,Text,Date,AdminID) VALUES ('".$this->title."','".$this->text."','".$this->date."',".$this->adminID.");";
            return $sql;
        }
        
        public function selectAll(){
            $sql = "SELECT * FROM ".$this->tableName." ORDER BY Date DESC";
            return $sql;
        }
        
        public function delete($ID){
            $sql = "DELETE FROM ".$this->tableName." WHERE ID = ".$ID;
            return $sql;
        }
        
        public function selectByID($ID){
            $sql = "SELECT * FROM ".$this->tableName." WHERE ID = ".$ID;
            return $sql;
        }
        
        public function update(){
            $sql = "UPDATE ".$this->tableName." SET Title = '".$this->title."', Text = '".$this->text."', LastEdit = '".$this->lastEdit."' WHERE ID = ".$this->ID;
            return $sql;
        }
        //--[[Getter & Setter]]--\\
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