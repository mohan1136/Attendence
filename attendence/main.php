<?php
	$error='';
	if(isset($_POST['form']))
	{
		$id=$_POST['Id'];
		$password=md5($_POST['Password']);
		$connection=mysql_connect('localhost','root','','kmr1');
		$query="SELECT name,password FROM kmr WHERE name='$id' AND password='$password'";
		$result=mysql_query($connection,$query);
		if(mysql_fetch_array($result))
		{
			header("Location:login.php");
		}
	}
	if(isset($_POST['form1']))
	{
		$connection=mysql_connect('localhost','root','','kmr1');
		$first=$_POST['first'];
		$user=$_POST['user'];
		$email=$_POST['email'];
		$password=$_POST['password2'];
		$category=$_POST['category'];
		$date=$_POST['date'];
		$gender=$_POST['gender'];
		$query="INSERT INTO kmr VALUES ('$first','$user','$email','$password','$category','$date','$gender')";
		if(mysql_query($connection,$query))
		{
			$error="Successfully created your account";
		}
	}
?>