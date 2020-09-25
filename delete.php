<?php 
// connect to my sql
$con = mysqli_connect("localhost","abook","abook","abook");
if(mysqli_connect_error()){
  die("Connection Erorr ".mysqli_connect_error());
}
echo "Connection Success ";
// Connect to server and select databse.

// delete record
$delete = $_POST['delete'];
if($delete == 'Delete'){
	$dlname = $_POST['dlname'];
	$dfname = $_POST['dfname'];
	$checkbox = $_POST['checkbox'];
	foreach($checkbox as $index){
		$t = $con->prepare("delete from contacts where lname=? and fname=?");
		$t->bind_param('ss' ,$dlname[$index],$dfname[$index]);
		$t->execute();
	}
}
// show all contact information
$t = $con->prepare("select * from contacts");
$t->execute();
$result = $t->get_result();
$t->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<BODY background="gifs/bkg2.gif" bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#800080" alink="#FF0000">
<SCRIPT language=JavaScript type=text/javascript>

	<!-- function to check whether checkbox is selected -->
  function checkboxchecked(){
  	element = document.getElementsByName("checkbox[]")
    
	for (var index=0; index< element.length; index++){
      if (element[index].checked == true)
        return true;
    }
	alert("Please select name to be deleted");
    return false;
  }
  
</SCRIPT>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<blockquote>
  <p>
  <h2>Delete Contact Information</h2>
  
  
   <form name="myform" method="post" action="delete.php" onSubmit="return checkboxchecked()">
     <table width="40%" border="0">
	 	<?php
			$index=0;
			while($row = mysqli_fetch_assoc($result)) {
				$lname = $row['lname'];
  				$fname = $row['fname'];
				echo "<tr><td width=\"25\" valign=\"top\"><input type=\"checkbox\" name=\"checkbox[]\" value=\"$index\" />";
				echo "</td><td valign=\"bottom\"><h4><a href=\"detail.php?lname=$lname&fname=$fname\">$lname, $fname</a><h4></td></tr>";
				echo "<input type=\"hidden\" name=\"dfname[]\" value=\"$fname\" />";
				echo "<input type=\"hidden\" name=\"dlname[]\" value=\"$lname\" />";
				$index++;
			}
			
			echo "<tr><td width=\"25\" valign=\"top\">&nbsp;</td><td valign=\"bottom\"><input type=\"submit\" name=\"delete\"";
			echo "value=\"Delete\" />&nbsp;&nbsp;&nbsp;<input type=\"reset\" name=\"Submit2\" value=\"Clear\" /></td></tr>";
			
		?>
	</table>	
 	</form>
	
	<?php
		if (mysqli_num_rows($result)==0)
				echo "<h4>No data<h4>";
	?>
	</p>
 
</blockquote>
</body>
</html>