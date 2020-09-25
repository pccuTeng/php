<?php 
// connect to my sql
$con = mysqli_connect("localhost","abook","abook","abook");
if(mysqli_connect_error()){
		die("Connection Erorr ". mysqli_connect_error());
}
echo "Connection Success ";
	
// Connect to server and select databse.
$t = $con->prepare("select * from contacts");
$t->execute();
$result = $t->get_result();
$t->close();
// show all contact information

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
  <h2>All  Contact Information</h2>
   <?php
   		if (mysqli_num_rows($result)==0){
			echo "<h4>No data<h4>"; 
		} else {
   			while($row = mysqli_fetch_assoc($result)) {
				$lname = $row['lname'];
  				$fname = $row['fname'];
				echo "<ul><li><h4><a href=\"detail.php?lname=$lname&fname=$fname\">$lname, $fname</a><h4></li></ul>";
			}
		}
		 
	?>
	
</blockquote>
</body>
</html>
