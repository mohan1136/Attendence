<!DOCTYPE html>
<html>
<head>
	<title>Attendence</title>
<style type="text/css">
	.form
	{
		position:absolute;
		top:35%;
		left:45%;
		border-left:2px solid black;
		padding:20px;
		padding-left: 30px;
	}
	#ids
	{
		background:transparent;
		border:none;
		border-bottom:2px solid black;
	}
	.form1
	{
		position:absolute;
		top:30%;
		left:20%;
		/*border:2px solid black;*/
		padding:20px;
	}
	#ams
	{
		background:transparent;
		border:none;
		border-bottom:2px solid black;
	}
	#ids1
	{
		background:transparent;
		border:none;
		border-bottom:2px solid black;
	}
	#b1
	{
		position: absolute;
		top:70%;
		left:40%;
	}
</style>
</head>
<?php
	session_start();
	// error_reporting(0);
	if(isset($_POST['submit1']))
	{
		$ams=$_POST['ams'];
		$ids1=($_POST['ids1']);
		if(!empty($ams) && !empty($ids1))
		{
			$connection=new mysqli('localhost','root','','G-17_attendence');
			$query="select id from December where id='$ids1' or ams='$ams'";
			$output=mysqli_query($connection,$query);

			if(!mysqli_fetch_array($output))
			{
				$query="insert into December values('$ams','$ids1')";
				mysqli_query($connection,$query);
			}
		}
	}

	if(isset($_POST['submit']))
	{
		if($_POST['entry']=='present')
		{
			$connection=new mysqli('localhost','root','','G-17_attendence');
			$day="D".strval(date('d'));
			$query="select ".$day." from December";
			if(mysqli_query($connection,$query))
			{
				$query="alter table December drop column ".$day;
			}
			$query="alter table December add ".$day." varchar(2)";
			mysqli_query($connection,$query);


			$query="update December set ".$day."='P' where ";
			

			$string=$_POST['attendence'];
			$array=explode(",",$string);
			foreach($array as $value)
			{
    			$add="ams='".$value."'"." or ";
    			$query=$query.$add;
			}
			$query=substr($query, 0, -4);
			mysqli_query($connection,$query);
			mysqli_query($connection,"update December set ".$day."='A' where ".$day." is null");
		}
		else
		{
			$connection=new mysqli('localhost','root','','G-17_attendence');
			$day="D".strval(date('d'));
			$query="alter table December add ".$day." varchar(2)";
			mysqli_query($connection,$query);


			$query="update December set ".$day."='A' where ";
			

			$string=$_POST['attendence'];
			$array=explode(",",$string);
			foreach($array as $value)
			{
    			$add="ams='".$value."'"." or ";
    			$query=$query.$add;
			}
			$query=substr($query, 0, -4);
			mysqli_query($connection,$query);
			mysqli_query($connection,"update December set ".$day."='P' where ".$day." is null");
		}
	}


?>
<body>
	<form name="form" class="form" method="post" action="index1.php">
			<input type="text" id="ids" name="attendence" placeholder="Enter IDs...!">&nbsp;&nbsp;
			<select name="entry">
		  		<option value="present">Present</option>
	  			<option value="absent">Absent</option>
			</select>
			<br>
			<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="submit" value="submit">
	</form>
	<form name="form1" class="form1" method="post">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<label>Register</label>
		<br><br>
		<input type="text" name="ams" id="ams" placeholder="AMS">
		<br><br>
		<input type="text" name="ids1" id="ids1" placeholder="ID">
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="submit" name="submit1">
	</form>
	<button id="b1" onclick="window.open('display.php','_blank'); return false;">Display Database Data(DDD)</button>
</body>
</html>