<!DOCTYPE html>
<html>
<head>
	<title>Display</title>
<style type="text/css">
	#form3
	{
		position: absolute;
		top:5%;
		left:33%;
	}
	#table
	{
		position: absolute;
		top:20%;
		left:40%;
	}
</style>
</head>
<body>
<table id="table">
<?php

	$connection=new mysqli('localhost','root','','G-17_attendence');
	$query="select * from December";
	$output=mysqli_query($connection,$query);
	foreach($output as $result)
	{
		echo "<tr>";
		foreach($result as $field)
		{
			echo "<td>".$field."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
?>
<form id="form3">
	<input type="text" name="text3">&nbsp;&nbsp;
	<input type="submit" name="submit3" value="submit">
</form>

</body>
</html>
