<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$host = 'localhost';
	$host_username = 'lokesh';
	$host_password = 'lokesh';
	$dbname = 'facebook';
	$username = $_POST['name'];
	$email    = $_POST["email"];
	$password = $_POST["password"];
	$dob = $_POST["DOB"];
	$number = $_POST["number"];
	$_SESSION['name'] = $username;
	$_SESSION['email'] = $email;
	$_SESSION['password'] = $password;
	$_SESSION['dob'] = $dob;
	$_SESSION['number'] = $number;
	$conn = mysqli_connect($host, $host_username, $host_password, $dbname);

	if ($conn)
	{
		echo "Connection successful.";
	}
	else
	{
		echo "Connection Failed.";
		die("Connection Failed:".mysqli_connect_error());
	}	
	$sql = "insert into users values('$username','$email', '$password','$dob','$number')";
	$upload = mysqli_query($conn,$sql);
	if($upload)
	{
		echo "<script> alert('Registration successfully');</script>";
		header('Location:login.php');
	}
	else
	{
		echo "Error:".$sql."".mysqli_error($conn);
	}

}
?>


<html>
	<head>
        <style>
        body{
            background-color:rgb(239, 239, 239);
        }
        table{
            line-height:1;
            border-radius: 3% 3% 3% 3%;
            background-color: white;
            width: 25%;
            height:50%;
            box-shadow: 2px 2px 2px 2px #888888;
        }
        h1{
            color:rgb(0, 132, 255);
			
        }
        button{
            width: 250px;
            height: 30px;
          background-color: rgb(60, 132, 248);
          border-radius: 0.1% 0.1% 0.1% 0.1%;
        }
        input{
            width: 250px;
            height: 30px;
        }
        </style>
</head>
	<body>
		<form align="center" action="#" method="POST">
			<h1 align="center" color="blue" size="50">facebook</h1>
			<table align="center">
				<h2 align="center">Create a new account</h2>
			<tr>
				<th><input type="text" name="name" placeholder="Enter name" size="20" required></th>
			</tr>
			<tr>
				<th><input type="email" name="email" placeholder="email" size="20" required></th>
			</tr>
			<tr>
				<th><input type="password" name="password" placeholder="password" size="20" required></th>
			</tr>
			<tr>
				<th><input type="date" name="DOB" placeholder="Enter DOB" size="20" required>
			</tr>
			<tr>
				<th><input type="number" name="number" placeholder="number" size="20"></th>
			</tr>
			<tr>
				<th><button type="submit" name="submit" value="submit" style="color:white; background-color: rgb(83, 219, 83);">Sign Up</button></th>
			</tr>
		</table>
		</form>
		</body>
</html>
