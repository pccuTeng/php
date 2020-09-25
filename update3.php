<?php 
// connect to my sql
$con = mysqli_connect("localhost","abook","abook","abook");
if(mysqli_connect_error()){
  die("Connection Erorr ".mysqli_connect_error());
}
echo "Connection Success ";
// Connect to server and select databse.


// retrieve all variables


// number of contacts to update

// update information to database

$fname=$_POST['ufname'];
$lname=$_POST['ulname'];
$email=$_POST['email'];
$homePhone=$_POST['homePhone'];
$cellPhone=$_POST['cellPhone'];
$officePhone=$_POST['officePhone'];
$address=$_POST['address'];
$comment=$_POST['comment'];
$size = count($fname);
for($i=0;$i<$size;$i++){
		$t = $con->prepare("update contacts set email = ?,homePhone = ?,cellPhone = ?,officePhone = ?,address = ?,comment = ? where lname = ? and fname = ?");
		$t->bind_param('ssssssss',$email[$i],$homePhone[$i],$cellPhone[$i],$officePhone[$i],$address[$i],$comment[$i],$lname[$i],$fname[$i]);
		$t->execute();
}
$t->close();





// Close connection

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Untitled Document</title>
<BODY background="http://localhost/hw10/gifs/bkg2.gif" bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#800080" alink="#FF0000">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<blockquote>
  <p>
  <h3>Your information is updated. </h3>
  <body>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
