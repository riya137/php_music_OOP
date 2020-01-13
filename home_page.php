<?php   
         include('controllers/database.php');
         include('controllers/userClass.php');
         include('controllers/movieClass.php');
         include('controllers/songClass.php');


         $db_connect=new DB_connection();
         $user_data=new User();
         $movie_data=new Movie();
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
    <title>Welcome <?php echo $first_name;?></title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

</head>
<body>
  <?php
    include('navbar.php');
  ?>
 <center> <h1><b><font color=grey><i>Hello <?php echo $first_name ;?>..!!</i></font></b> </h1> </cemter>
       <div class="row">
           <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8 ">
           <center>
           <form>
             <div class="col-md-10 col-lg-8 col-sm-8 col-xs-8">
                <input type="text"  placeholder="Search Here" name="search_text" class="form-control">
             </div>
             <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">
                 <input type="submit" value="search" name="search" class="btn btn-info">
             </div>
          </form>
          </center>
           <br><br>
              <h4>Choose your favorite movie</h4>
               <?php
                    // getting movie list from datbase
                    if(isset($_GET['search_text'])){
                        $searchTxt=$_GET['search_text'];
                        $get_movie=$movie_data->get_movie($searchTxt);
                        $movie_id=$get_movie[0];
                        $movie_name=$get_movie[1];
                    }
               ?>
           </div>
           <br>
           <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
           <br><br>
             <h4 class=text-center>Play your favorite song</h4>
               <?php 
                  //getting song list of a particular movie from database
                   if(isset($_GET['movie_id'])){
                   $movie_id=$_GET['movie_id'];
                   $get_song=$song_data->get_song($movie_id,$searchTxt);
                   $song_id=$get_song[0];
                 //  $song_name=$get_song[1];
                }
               ?>
                  <div class="col-md-12">
                    <?php 
                     //playing the speicifc song
                     if(isset($_GET['song_id'])){
                     $play_song_id=$_GET['song_id'];
                     $play_song=$song_data->play_song($play_song_id);
                     $song_id=$play_song[0];
                     // $song_name=$play_song[1];
                     //$song_url=$play_song[2];
           
                     echo " <br><br> 
                     <form method='post'>
                     <button class='btn btn-info' name='add_fav'>Add to Favorites</button>
                     </form>
                     <a href='favorite.php'>View Favorite</a><br>";
                     
                     //adding song to favorites.
                     if(isset($_POST['add_fav'])){
                       $add_song_favorites=$song_data->add_favorite($user_id,$play_song_id);
                     }
                     //chk song liked aur not
                     $chk_like_dislike=$song_data->show_like_dislike($user_id,$play_song_id);
                     if($chk_like_dislike){
                         echo " <form method='post'><button name='unlike'><font size='20'><span class='unlike fa fa-thumbs-up' ></font></span></button></form>";
                     }
                    else{
                       echo " <form method='post'> 
                       <button name='liked'><font size='20'><span class='like fa fa-thumbs-o-up' ></font></span> </button></form>";
                    }
                    
            } 
          ?>  
              <!-- //ends here the playing song code --> 
              </div>
           </div>
       </div>
</body>
<?php
   if(isset($_POST['liked'])){
      $like=$song_data->click_like($user_id,$movie_id,$play_song_id);
   }

   if(isset($_POST['unlike'])){
    $dislike=$song_data->click_dislike($user_id,$movie_id,$play_song_id);
   }
?>

</html>
</body>
</html>





