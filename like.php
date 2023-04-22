<?php
session_start();



if(isset($_POST['like'])){
    $name=$_SESSION['name'];
    $image= $_POST['image'];
    $conn = mysqli_connect("localhost", "lokesh", "lokesh", "facebook");


    $sqln = "select * from likes where user='$name' and picture='$image'";
    $resultn = mysqli_query($conn,$sqln);


//From user
    if(mysqli_num_rows($resultn)>0)
    {
        while($row=mysqli_fetch_assoc($resultn)){
            if($row['like']==1){
                header("Location:temp.php");
                exit(0);
            }
        }
        $liked=1;
        $sqln = "update likes set like=$liked where user='$name' and picture='$image'";
        $resultn = mysqli_query($conn,$sqln);

    }
    else
    {
        $liked = 1;
        $sql = "insert into likes values('$name','$image',$liked)";
        $result = mysqli_query($conn,$sql);
    }


// From other user
    $sqln = "select * from pics where picture='$image'";
    $resultn = mysqli_query($conn,$sqln);
    while($row=mysqli_fetch_assoc($resultn)){
        $likes = $row['likes'];
    }
    $likes = $likes+1;
    $sql = "UPDATE pics SET likes=$likes WHERE picture = '$image'";
    $result = mysqli_query($conn,$sql);
    header("Location:temp.php");
}

?>