<?php 
// connect to my sql
$con = mysqli_connect("localhost","abook","abook","abook");
if(mysqli_connect_error()){
		die("Connection Erorr ". mysqli_connect_error());
}
echo "Connection Success ";
// Connect to server and select databse.
$t = $con->prepare("select * from contacts where lname=? and fname=?");
$t->bind_param('ss' ,$lname ,$fname);
$lname = $_GET['lname'];
$fname = $_GET['fname'];
$t->execute();
$result = $t->get_result();
$row = mysqli_fetch_assoc($result);
$t->close();
// retrieve all variables

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
  <form name="addform" action="add.php" method=post onSubmit="return validate_form()" >
    <table width="60%" border="0" cellpadding="5" cellspacing="15">
	<tr>
		<td colspan="2"><p><h2><?php echo "$lname, $fname"; ?></h2></td>
	  </tr>
    <tr>
      <td width="130">First Name :</td>
      <td><?php echo $row['fname']; ?></td>
    </tr>
    <tr>
      <td width="130">Last Name :</td>
      <td><?php echo $row['lname']; ?></td>
    </tr>
    <tr>
      <td width="130">E-mail Address :</td>
      <td><?php echo $row['email']; ?></td>
    </tr>
    <tr>
      <td width="130"><p>Home Phone :<br />
      </p>        </td>
      <td><?php echo $row['homePhone']; ?></td>
    </tr>
    <tr>
      <td width="130">Cell Phone :</td>
      <td><?php echo $row['cellPhone']; ?></td>
    </tr>
    <tr>
      <td width="130">Office Phone :</td>
      <td><?php echo $row['officePhone']; ?></td>
    </tr>
    <tr valign="top">
      <td width="130">Address :</td>
      <td><?php echo $row['address']; ?></td>
    </tr>
    <tr valign="top">
      <td width="130">Comment :</td>
      <td><?php echo $row['comment']; ?></td>
    </tr>
  </table>
  </form>
   </p>
</blockquote>
</body>
</html>
