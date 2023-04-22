<html>
    <head>
        <style>
        body{
            background-color: white;

        }
        table{
            line-height:1;
            border-radius: 3% 3% 3% 3%;
            background-color:rgb(239, 239, 239);
            width: 25%;
            height:40%;
            box-shadow: 2px 2px 2px 2px #888888;
            margin: 100px 500px;
        }
        h1{
            color:rgb(0, 170, 255);
            size: 500px;
            text-align: center;
        }
        button{
            width: 250px;
            height: 40px;
          background-color: rgb(83, 219, 83);
          border-radius: 0.4% 0.4% 0.4% 0.4%;
        }
        input{
            width: 250px;
            height: 40px;
        }
        </style>
</head>
<body>
<form align="center" action="#" method="POST">
    <img align="center" src="facebook.png" style="margin-top:55px; margin-left:-40px;">
    <table align="center" style="margin-top:20px;">
    <tr>
        <th><input type="text" name="username" placeholder="Enter name" size="20"></th>
    </tr>
    <tr>
        <th><input type="password" name="password" placeholder="password" size="20"></th>
    </tr>
    <form method ="POST" action="inner.html">
    <tr>
        <th><button type="submit" name="login" style="text-align: center;">Login</button></th>
    </tr>
    </form>
    <form action="sign_in.php">
    <tr>
        <th><button type="submit" name="sign" style="text-align: center;">Sign up</button></th>
    </tr>

    </form>
    </table>
</form>
</body>
</html>

<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = $_POST["username"];
		$password = $_POST["password"];

        $conn = mysqli_connect('localhost','lokesh','lokesh','facebook');
        $_SESSION['name'] = $name;
        if ($conn) {
            echo "Connection successful.";
        }
        else{
            echo "Connection Failed.";
            die("Connection Failed:".mysqli_connect_error());
        }
        $sql = "select * from users where name='$name' and password='$password'";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0){
           $_SESSION['name']=$name;
           header('Location:temp.php');
        }
        else{
            ?>
            echo "<script> alert('Invalid Credentials')</script>";
            <?php
            header('Location:login.php');
        }

}
?>