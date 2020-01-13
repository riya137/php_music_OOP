<?php 
  include_once('database.php');
  $db_connect=new DB_connection();
  $connection=$db_connect->connect();
  class Admin{
   

    public function insert_movie($movie_name,$movie_year,$movie_image){
       global $connection;
       $insert_movie_query="insert into movie(movie_name,movie_year,movie_image) values('$movie_name','$movie_year','$movie_image')";
       $insert_movie=mysqli_query($connection,$insert_movie_query); 
       if($insert_movie){
        $last_id = mysqli_insert_id($connection);
      }
       return $last_id;
   }

  

}

?>