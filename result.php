<?php 
// connect to my sql
$con = mysqli_connect("localhost","abook","abook","abook");
if(mysqli_connect_error()){
  die("Connection Erorr ".mysqli_connect_error());
}
// Connect to server and select databse.
$t = $con->prepare("select * from contacts");
$t->execute();
$searchin = $_POST['searchin'];
$keyword = $_POST['keyword'];
$result = $t->get_result();
$t->close();

// retrieve all variables



// execute query


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<BODY background="gifs/bkg2.gif" bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#800080" alink="#FF0000">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<blockquote>
  <p>
  <h2>Result</h2>
   <?php
   		$i =0;
		while($row = mysqli_fetch_assoc($result)) {
			$lname = $row['lname'];
  			$fname = $row['fname'];
			
			if ($searchin == "both"){
				// search in last name & first name
				if ((preg_match("/$keyword/i",$fname))||(preg_match('/$keyword/',$lname))){
					echo "<ul><li><h4><a href=\"detail.php?lname=$lname&fname=$fname\">$lname, $fname</a><h4></li></ul>";
					$i++;
				}
			} else if($searchin == "fname"){
				// seach in first name
				if (preg_match("/$keyword/i",$fname)){
						echo "<ul><li><h4><a href=\"detail.php?lname=$lname&fname=$fname\">$lname, $fname</a><h4></li></ul>";
						$i++;
				}
			} else{
				// search in last name
				if (preg_match("/$keyword/i",$lname)){
						echo "<ul><li><h4><a href=\"detail.php?lname=$lname&fname=$fname\">$lname, $fname</a><h4></li></ul>";
						$i++;
				}				
			}
		}
		
		if ($i == 0)
			echo "<ul><h4>No match result.<h4></ul>";
		 
	?>
	
</blockquote>
</body>
</html>
