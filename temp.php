<!DOCTYPE html>
<html lang="en">
<head>
    <style>

body{
    background-color:rgb(239, 239, 239);
}
nav{
    display:flex;
    align-items:center;
    justify-content:space-between;
    background:white;
    background-color:white;

}
.logo{
    width:50px;
    height:50px;
}

img{
    border-radius: 20px 20px 20px 20px;
}

.center-image{
    border:2px solid;
    margin-left:300px;
    width:60%;
    height:100%;
}
.left-sidebar{
    float:left;
    position:sticky;
    top:70px;
    padding:20px;
    border-radius:4px;
    height:100vh;
}

.left-buttons img{
    border-radius:50%;
} 
input[name="image"]{
    visibility:hidden;
}

    </style>
</head>
<body>
    <nav >
        <table>
            <th>


    <!-- Left Division-->
                <div class="nav-left">
                    <img src="f logo.png" align="left" style="margin: 20px;" class="logo">
                </div>
            </th>
            
            <th>
                <div class="nav-right">
                <div class="search-box">
                    <input type="text" name="input" placeholder="search" size="20" 
			style="border-radius:5% 5% 5% 5% ;margin: 25px;
			width:200px; height:30px">
                </div>
                
            </div>
            </th>
            <?php session_start();
            
            ?>
        </table>



    </nav>
    <div class="container">
        
        <div class="left-sidebar">
        <h1>Welcome <?php 
        if($_SESSION['name']==''){
            header("location:login.php");
            exit(0);
        }
        echo $_SESSION['name']; ?></h1>
            <div class="left-buttons">
        <form action="temp.php" method='post'>  

			<button type='submit' name='post' style="border:0px;"><img src="friends logo.png"  height="50" width="50">Recents</button> <br>
            <button type='submit' name='top' style="border:0px;"><img src="like logo.png"  height="50" width="50">Most liked</button> <br>
            <button type='submit' name='uplo' style="border:0px;"><img src="recent logo.png" height="50" width="50">Upload</button><br>
            <button type='submit' name='profile' style="border:0px;"><img src="profile logo.png" height="50" width="50">Profile</button>

        </form>
        <form action="logout.php" method="POST">
            <button type='submit' name='logout' style="border:0px;"><img src="logout logo.png" height="50" width="50">Logout</button>
		</form> 
            </div> 
        </div>
        <div class="main-content" align="center">
            <div class="center-image">
               <?php 
            $conn = mysqli_connect("localhost", "lokesh", "lokesh", "facebook");
// Upload Section

		if(isset($_POST['uplo']))
        {
				?>
                <h1>UPLOADS</h1>
				<form action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="images">
                    <input type="text" name="comment" placeholder="comment">
                    <input type="submit" name="submit" value="Upload File">
                </form>
				<?php
                $user = $_SESSION["name"];
                $sql = "SELECT * FROM pics where user='$user'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $image = $row['picture'];
                    echo "<br>";
                    echo "<img src='uploaded/".$image."' width='200' height='200'>";
                    echo "<p>".$row['comment']."</p>";
                }
                ?>
                <?php



// Showing pics after uploading
                

			}

// Profile Section
        else if(isset($_POST['profile'])){

                    ?>
                    <h1>PROFILE</h1>
                    <br>
                    <?php

                    $user = $_SESSION['name'];
                    $sql = "SELECT * FROM users WHERE name = '$user'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
            
                        echo "
                        <table border=2 cellspacing='0' cellpading='30' height='300px' width='500px' align = 'center'>
                        <tr>
                                <th>Username</th>
                                <td align='center'>{$row['name']}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td align='center'>{$row['email']}</td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td align='center'>{$row['password']}</td>
                            </tr>
                            <tr>
                                <th>DOB</th>
                                <td align='center'>{$row['dob']}</td>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <td align='center'>{$row['number']}</td>
                            </tr>
                        </table>";

                    }
                    echo "<br>";
            }

// Top most images
        else if(isset($_POST['top'])){
            ?>
            <h1>MOST LIKED POSTS</h1>
            <?php

            $a = 0;
            $sql = "SELECT * FROM pics ORDER BY likes DESC";
            $result = mysqli_query($conn,$sql);
            while(($row = mysqli_fetch_assoc($result)) && $a<5)
            {
                $pic = $row['picture'];
                echo "<br>";
                echo "<img src='uploaded/".$row['picture']."' width='150' height='150'> <br>";
                echo "{$row['comment']}<br>";
                echo "<form method='POST' action='like.php'>
                <input type='submit' name='like' value='like' style='margin-left:160px;'>
                <input type='text' name='image' value='$pic'></form>";
                $likes = $row['likes'];
                echo "Likes : {$likes} <br>";
                $a = $a+1;
            }
        }
              
        
// Post Section (Default)
		else{
				?>
                <h1>RECENTS</h1>
				<?php

                $user = $_SESSION["name"];

                $sql = "SELECT * FROM pics";
                $result = mysqli_query($conn, $sql);
                
                while($row = mysqli_fetch_assoc($result)){
                    $pic = $row['picture'];
                   echo "<img src='uploaded/".$row['picture']."' width='150' height='150'><br>";
                   echo $row['comment'];
                   echo "<form method='POST' action='like.php'>
                   <input type='submit' name='like' value='like' style='margin-left:160px;'>
                   <input type='text' name='image' value='$pic'></form>";
                   $sql1 = "select * from pics where picture='$pic'";
                   $result1 = mysqli_query($conn,$sql1);
                   $likes = $row['likes'];
                   echo "{$likes} <br>";
			   }
            }
			   ?>
            </div>
        </div>
        
        </div>
    
         
    </body>
    </html>