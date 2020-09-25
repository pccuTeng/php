<?php 
// connect to my sql
$con = mysqli_connect("localhost","abook","abook","abook");
if(mysqli_connect_error()){
  die("Connection Erorr ".mysqli_connect_error());
}
echo "Connection Success ";
	
// Connect to server and select databse.

// get all parsed variables
$update = $_POST['update'];
if($update == 'Update'){
	$ulname = $_POST['ulname'];
	$ufname = $_POST['ufname'];
	$checkbox = $_POST['checkbox'];
}

// show all contact information
$t = $con->prepare("select * from contacts");
$t->execute();
$result = $t->get_result();
// close connection
$t->close();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<BODY background="http://tinman.cs.gsu.edu/~raj/gifs/bkg2.gif" bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#800080" alink="#FF0000">
<SCRIPT language=JavaScript type=text/javascript>
	
	function validate_form(){
		var message ="";
		var total = document.getElementsByName("ufname[]").length;
		
		for (i = 0; i<total; i++){
			
			mssg ="";
			fname =  document.getElementsByName("ufname[]")[i].value;
			lname =  document.getElementsByName("ulname[]")[i].value;
			email =  document.getElementsByName("email[]")[i].value;
			homePhone = document.getElementsByName("homePhone[]")[i].value;
			cellPhone = document.getElementsByName("cellPhone[]")[i].value;
			officePhone = document.getElementsByName("officePhone[]")[i].value;
			address = document.getElementsByName("address[]")[i].value;
 
    		mssg += checkEmail(email);
    		mssg += checkPhone("Home phone", homePhone);
			mssg += checkPhone("Cell phone", cellPhone);
			mssg += checkPhone("Office phone", officePhone);
    		mssg += checkAlphabet("Address", address);
    		
			if (mssg != "")
				message += (lname + ", " + fname + ": \n" + mssg + "\n");
			
		}
		
		if (message == ""){
      		return true;
    	} else {
      		alert(message);
      		return false;
   		}
	}


	function checkEmail(itemcontent){
    	var emailregexp = /^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/;
    
    	if (!itemcontent.match(/[a-zA-Z]+/)){
      		return "  - E-mail address is required!\n";
    	} else if (itemcontent.match(emailregexp)){
      		return "";
    	} else {
      		return "  - Invalid E-mail Address!\n";
    	}
  	}
  
  	function checkAlphabet(field, itemcontent){
    	var nameregexp = /[a-zA-Z]+/;
    	if (!itemcontent.match(nameregexp)){
      		return "  - "+field+" is required!\n";
    	}
    	return "";
  	}
	
	function checkPhone(field, itemcontent){
    	var phoneregexp1 = /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;
    	var phoneregexp2 = /^[0-9]{2}-[0-9]{4}-[0-9]{4}$/;
    	var phoneregexp3 = /^[0-9]{4}-[0-9]{3}-[0-9]{3}$/;
		
    	if ((field =="Home phone") && (itemcontent=="")){
      		return "  - "+field+" is required!\n";
		} else if ((itemcontent!="") && 
				   !(itemcontent.match(phoneregexp1) || itemcontent.match(phoneregexp2) || itemcontent.match(phoneregexp3) ) ){
      		return "  - "+field+" is in incorrect format!\n";
    	} else{
    		return "";
  		}
	}

</SCRIPT>

<blockquote>
  <p>
  <h2>Update Contact Information</h2>
  
  
   <form name="updateform" action="update3.php" method=post onSubmit="return validate_form()">

<?php
 
   foreach ($checkbox as $index){
		for ($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_assoc($result);
			$fname = $row["fname"];
			$lname = $row["lname"];
			
			if (($fname == $ufname[$index]) && ($lname == $ulname[$index])){
				$email = $row["email"];
				$homePhone = $row["homePhone"];
				$cellPhone = $row["cellPhone"];
				$officePhone = $row["officePhone"];
				$address = 	$row["address"];
				$comment = $row["comment"];
			
   				echo "<table width=\"40%\" border=\"0\" cellpadding=\"2\" cellspacing=\"5\">";
				echo "<tr>
				  <td width=\"130\"><strong>First Name : &nbsp;<span class=\"style1\">*</span></strong></td>
				  <td><input name=\"fname[]\" disabled type=\"text\" size=\"30\" maxlength=\"30\" value=\"$fname\" />
				  	<input name=\"ufname[]\" type=\"hidden\" value=\"$fname\" />
					</td>
				</tr>";
				
				echo "<tr>
				  <td width=\"130\"><strong>Last Name :</strong> &nbsp;<span class=\"style1\">*</span></td>
				  <td><input name=\"lname[]\" disabled type=\"text\" size=\"30\" maxlength=\"30\" value=\"$lname\" /></td>
				  	<input name=\"ulname[]\" type=\"hidden\" value=\"$lname\" /></td>
				</tr>";
				
				echo "<tr>
				  <td width=\"130\"><strong>E-mail Address :</strong>  &nbsp;<span class=\"style1\">*</span></td>
				  <td><input name=\"email[]\" type=\"text\" size=\"30\" maxlength=\"30\" value=\"$email\" /></td>
				</tr>
				<tr>
				  <td width=\"130\"><p><strong>Home Phone :</strong> &nbsp;<span class=\"style1\">*</span><br />
				  xxx-xxx-xxxx</p>        </td>
				  <td><input name=\"homePhone[]\" type=\"text\" size=\"30\" maxlength=\"20\" value=\"$homePhone\" /></td>
				</tr>";
				
				echo "<tr>
				  <td width=\"130\"><strong>Cell Phone : <br />
				  </strong>xxx-xxx-xxxx</td>
				  <td><input name=\"cellPhone[]\" type=\"text\" size=\"30\" maxlength=\"20\" value=\"$cellPhone\" /></td>
				</tr>";
				
				echo "<tr>
				  <td width=\"130\"><strong>Office Phone : <br />
				  </strong>xxx-xxx-xxxx</td>
				  <td><input name=\"officePhone[]\" type=\"text\" size=\"30\" maxlength=\"20\" value=\"$officePhone\" /></td>
				</tr>";

				echo "<tr valign=\"top\">
				  <td width=\"130\"><strong>Address :</strong> &nbsp;<span class=\"style1\">*</span></td>
				  <td><textarea name=\"address[]\" cols=\"25\" rows=\"3\" >$address</textarea></td>
				</tr>";
				
				echo "<tr valign=\"top\">
				  <td width=\"130\"><strong>Comment :</strong> </td>
				  <td><textarea name=\"comment[]\" cols=\"25\" rows=\"2\" >$comment</textarea></td>
				</tr>";
				
			  echo "</table>
   	 			<hr align=\"left\" width=\"40%\" />
  	 			<br />";
			}
		}
	 }
?>
	 
  	 <blockquote>

       <p><input type="submit" name="Submit" value="Update Contact" />
         </p>
  	 </blockquote>
   </form>
	
	
</p>
</blockquote>
</body>
</html>