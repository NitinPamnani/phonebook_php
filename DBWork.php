<?php
    /**
     * 
     */
    class Database  
       {
        	
        private $db;
        function __construct() 
        {
            $servername = 'localhost';
			$username = 'root';
			$password = '';
			$dbname = 'phonebook';
			$this->db = mysqli_connect($servername,$username,$password,$dbname);
			
			
        }
		function Check()
		{
			if($this->db)
			{
				return TRUE;
			}
			else 
		    {
		    	return FALSE;
			}
		}
		function Add($name,$number) 
		{
			$stmt = $this->db->prepare("INSERT INTO list(Name, Number) VALUES (?,?)");
		    $stmt->bind_param("ss",$name,$number);
			if($stmt->execute())
			   {
			   	return TRUE;
			   }
			else
		    {
		    	return FALSE;
				
			}   
		    	
		}
		//to populate list
		function Show()
		{
			$stmt = $this->db->prepare("SELECT * FROM list");
			//$stmt->bind_param("i",$uid);
			$stmt->execute();
			$values = array();
			$result = $stmt->get_result();
			while($row = $result->fetch_assoc())
			{
				$values[] = $row;
			}
			return $values;
		}
		function Delete($uid) 
		{
			$stmt = $this->db->prepare("DELETE FROM list WHERE uid = ?");
			$stmt->bind_param('i',$uid);
			if($stmt->execute())
			{
				return TRUE;
			}
			else 
			{
				return FALSE;
			}
		}
		function Search($name) 
		{
			$stmt = $this->db->prepare("SELECT * FROM list WHERE name = ?");
			$stmt->bind_param('s',$name);
			$stmt->execute();
			$values = array();
			$result =$stmt->get_result();
			while($row = $result->fetch_assoc())
			{
				$values[] = $row;
			}
			return $values;
			
		}
    }
    
?>