<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
function i(){
	$alt_color = array('red','orange');
	$a=1;
	echo"<table border=1>";
    	for($i=0; $i<10; $i=$i+1) {
      	echo"<tr>";
      	echo"<TR bgcolor=".$alt_color[$i%2].">";
      	for($j=0; $j<5; $j=$j+1) {
      	echo"<td>";
      	echo 'The variable '.$a++.' is ' .$_POST['user_name']++;
      	echo"</td>";
         	}
        echo"</tr>";
        }
echo"</table>";
}
function e(){
	print("ERROR");
}
$temp_array=[];
if(is_numeric($_POST['user_name'])){
	if(($_POST['user_name'])>=100 and ($_POST['user_name'])<=999){
		i();
	}
	else{
		array_push($temp_array,"Condition 2 not match");
	}
}
else{
	array_push($temp_array,"Condition 1 not match");
}
if(count($temp_array)>0){
	foreach ($temp_array as $ta) {
		echo $ta;
	}
}
?>

</body>
</html>