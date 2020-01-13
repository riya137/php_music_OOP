<!DOCTYPE html>
<html lang="en">
<head>
  <title>Music</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    .avatar {
       vertical-align: middle;
       width: 50px;
       height: 50px;
       border-radius: 50%;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">MUsically</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact Us</a></li>
      <!-- <li><a href="signin.php">Sign In</a></li> -->
      <?php if (isset($_SESSION['email'])){ 
          $email=$_SESSION['email'];
          $rows=$user_data->maintain_username($email);
          $user_image=$rows[5];
          $image_src = "images/".$user_image;
        ?>
          <li><a href="signin.php">Logout</a></li>
          <li> <img src='<?php echo $image_src;  ?>' width=40 height=40 class="avatar"></li>

          <?php } 
          else{  ?>
          <li><a href="signin.php">Sign In</a></li>
            
        <?php  }  ?>
          
		
    </ul>
  </div>
</nav>


</body>
</html>
