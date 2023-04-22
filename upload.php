<?php
session_start();
$target_dir = "uploaded/";

if(isset($_FILES["images"])){
	$image = $_FILES["images"]["name"];
	$comment = $_POST['comment'];

	$user = $_SESSION['name'];
	$target_file = $target_dir . basename($_FILES["images"]["name"]);
  	move_uploaded_file($_FILES["images"]["tmp_name"], $target_file);
	$likes=0;
	$con = mysqli_connect("localhost","lokesh","lokesh","facebook");
	$sql = "INSERT INTO pics VALUES ('$user','$image', '$comment',$likes)";
	$result = mysqli_query($con, $sql);
	echo "<script>
	window.location.href = 'temp.php';
  </script>";
}

?>