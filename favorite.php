 <?php   
        include('controllers/database.php');
        include('controllers/userClass.php');
        include('controllers/movieClass.php');
        include('controllers/songClass.php');
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $user_data=new User();
        $song_data=new Song();

        session_start();
        if(!isset($_SESSION['email']))
        {
                header("location: signin.php");
        }
        else{
            $email=$_SESSION['email'];
            $rows=$user_data->maintain_username($email);
            $first_name=$rows[1];
            $user_id=$rows[0];
        }
      
?>
<html>
<head>
    <title>Favorite -  <?php echo $first_name;?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>
  <?php
    include('navbar.php');
  ?>
 <center> <h1><b><font color=grey><i>Hello <?php echo $first_name ;?>..!!</i></font></b> </h1> </cemter>
 <div class="row">
    <div class="col-md-6">
      <form method="post" action="">
       <table class="table table-bordered">
         <thead>
          <tr>
            <th><input type="checkbox" id="checkAl"> Select All</th>
	         <th> Song Name</th>
          </tr>
         </thead>
<?php
   $view_fav=$song_data->get_favorite($user_id);
?>
</table>
<p align="center"><button type="submit" class="btn btn-success" name="save">DELETE</button></p>
</form>
<script>
$("#checkAl").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
    </div>
    <div class="col-md-6">
       <?php
             //playing the speicifc song
             if(isset($_GET['song_id'])){
                $song_id_play=$_GET['song_id'];
                $play_song=$song_data->play_song($song_id_play);
             }
         ?>
    </div>
 </div>
<?php
  if(isset($_POST['save'])){
	   $checkbox = $_POST['check'];
	   for($i=0;$i<count($checkbox);$i++){
         $del_id = $checkbox[$i]; 
         $del_fav_query="delete from favorite where id=$user_id and song_id=$del_id";
         $del_fav=mysqli_query($connection,$del_fav_query);
         echo "<script>location.href = 'favorite.php';</script>";
}
  }
?>