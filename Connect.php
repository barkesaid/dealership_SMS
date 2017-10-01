<?php
/**
* 
*/
class  DB_Connect 
{
	private $con;

	public function connect(){
		 require_once 'DB_Config.php';
        $this->con = new mysqli(DB_Server, DB_User, DB_Password, DB_Database, DB_Port);
        return $this->con;
	}
	

	
} 
?>