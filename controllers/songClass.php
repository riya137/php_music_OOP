<?php
include_once('database.php');
$db_connect=new DB_connection();
$connection=$db_connect->connect(); 
class Song{

    public function  get_song($movie_id,$searchTxt){
        global $connection;
        $get_song_query="select * from songs where movie_id='$movie_id'";
        $get_song=mysqli_query($connection,$get_song_query);
        while($row=mysqli_fetch_array($get_song)){
           $song_id=$row[0];
           $song_name=$row[1];
           echo "
             <a href='home_page.php?search_text=$searchTxt&movie_id=$movie_id&song_id=$song_id' class='list-group-item'><font color=green size=5>$song_name</font> </a>";
         }
         return $row;
    }

    public function play_song($play_song_id){
        global $connection;
        $song_play_query="select * from songs where song_id='$play_song_id'";
        $play_song=mysqli_query($connection,$song_play_query);
        while($row=mysqli_fetch_array($play_song)){
          $song_id=$row[0];
          $song_name=$row[1];
          $song_url=$row[3];
    
          echo "
          <h3>Now Playing</h3>
          <h4>$song_name</h4>
          <audio controls>
             <source src='$song_url' type='audio/mp3'>
          </audio>
        ";
      }
      return $row;
    }
    public function add_favorite($user_id,$song_id){
       global $connection;
        $check_fav_query="select * from favorite where id='$user_id' and song_id='$song_id'";
        $chk_fav=mysqli_query($connection,$check_fav_query);
        $count = mysqli_num_rows($chk_fav);
        if($count==1){
            echo "<br><b><font color=red>Already added in your favorites..!!</font></b>";
        }
        else{
            $query="insert into favorite(id,song_id) values('$user_id','$song_id')";
            $insert_query=mysqli_query($connection,$query); 
            if($insert_query){
                echo "<b><font color=green>Added to your Favorites</font></b>";
            }
        }
    }


    public function show_like_dislike($user_id,$play_song_id){
        global $connection;
        $get_likes_query="select * from songs where song_id='$play_song_id'";
        $result = mysqli_query($connection,$get_likes_query);
        $row = mysqli_fetch_array($result);
        $n = $row[4];

        $get_post_like_query="select * from likes where id='$user_id' and song_id='$play_song_id'";
        $get_post_like_result=mysqli_query($connection,$get_post_like_query);
    
        if(mysqli_num_rows($get_post_like_result) == 1){ 
           return true;//user liked already
       }
       else{
             return false;//not yet liked
        } 
        echo "<h5><b>$n</b><h5>" . "<h5><b><Likes/b></h5>";
      } 
    
      public function click_like($user_id,$movie_id,$play_song_id){
        global $connection;
        $get_likes_query="select * from songs where song_id='$play_song_id'";
        $result = mysqli_query($connection,$get_likes_query);
        $row = mysqli_fetch_array($result);
        $n = $row[4];
        $plus=$n+1;
        $insert_like_query="insert into likes(id,song_id) values ('$user_id','$play_song_id')";
        $insert_likes=mysqli_query($connection,$insert_like_query);
        $update_like_query="update songs set likes='$plus' where song_id='$play_song_id'";
        $update_like=mysqli_query($connection,$update_like_query);
        echo "<script>location.href = 'home_page.php?search_text=null&movie_id=$movie_id&song_id=$play_song_id';</script>";
      }

      public function click_dislike($user_id,$movie_id,$play_song_id){
        global $connection;
        $get_likes_query="select * from songs where song_id='$play_song_id'";
        $result = mysqli_query($connection,$get_likes_query);
        $row = mysqli_fetch_array($result);
        $n = $row[4];
        $minus=$n-1;
        $delete_like_query="delete from likes where song_id='$play_song_id' and id='$user_id'" ;
        $delete_like=mysqli_query($connection,$delete_like_query);
        $update_like_query="update songs set likes='$minus' where song_id='$play_song_id'";
        $update_like=mysqli_query($connection,$update_like_query);
        echo "<script>location.href = 'home_page.php?search_text=null&movie_id=$movie_id&song_id=$play_song_id';</script>";
      }

      public function del_favorite($user_id,$song_id_del){
        global $connection;
        $del_fav_query="delete from favorite where id=$user_id and song_id=$song_id_del";
        $del_fav=mysqli_query($connection,$del_fav_query);
        echo "<script>location.href = 'favorite.php';</script>";
      }

      public function get_favorite($user_id){
        global $connection;
        $i=0;
        $get_fav_query="select * from songs join favorite
        on songs.song_id=favorite.song_id
        where favorite.id='$user_id'";
        $run_select=mysqli_query($connection,$get_fav_query);
        $count = mysqli_num_rows($run_select);
        if($count==0){
           echo "<b><font color=red>Your favorites list is empty..!!</font></b>";
        }
        echo "<br><a href='home_page.php?search_text=null'>Add Songs</a> "; 
        while($row = mysqli_fetch_array($run_select)) {
           $song_id=$row[0];
           $song_name=$row[1];
        echo "
        <tr>
              <td><input type='checkbox' id='checkItem' name='check[]' value='$song_id'></td>
             <td><a href='favorite.php?song_id=$song_id' class='list-group-item'>$song_name</a></td>
         </tr>";
         $i++;
        }
      }
}

?>