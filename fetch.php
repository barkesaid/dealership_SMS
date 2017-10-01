<html>

<?php
require_once('db.php');


$query ="SELECT phone_number FROM contacts";
$result= $conn->query($query);
  
	   	  if(!($result))
		  {
			echo "no results" ; 
		  }
		else
		  {	
			for($i =0 ; $row = $result->fetch_row() ; $i++ )
			{
				
				foreach($row as $key => $value)
				{
					print "$value ";
				}
				
			}
		
		
		  }
		    
?>

</html>