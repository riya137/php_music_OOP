<?php
include_once('database.php');
$db_connect=new DB_connection();
$connection=$db_connect->connect();
class Movie{

    public function get_movie($searchTxt){
        global $connection;
        $null="null";
        $chck=strcmp($searchTxt, $null);
        if($chck==0){
            $sct_user="select * from movie";
            $run_select=mysqli_query($connection,$sct_user);
            while($row=mysqli_fetch_array($run_select)){
                $movie_id=$row[0];
                $movie_name=$row[1];
                echo "
                   <a href='home_page.php?search_text=$searchTxt&movie_id=$movie_id' class='list-group-item'><font color=green size=5>$movie_name</font> </a>";
            }
            return $row;
        }
        else{
            $sct_user="select * from movie where movie_name like'$searchTxt%'";
            $run_select=mysqli_query($connection,$sct_user);
            $count = mysqli_num_rows($run_select);
            if($count==0){
                echo "<b><font color=red>No Record Found..!!</font></b>";
            }
            while($row=mysqli_fetch_array($run_select)){
                $movie_id=$row[0];
                $movie_name=$row[1];
                echo "
                   <a href='home_page.php?search_text=$searchTxt&movie_id=$movie_id' class='list-group-item'><font color=green size=5>$movie_name</font> </a>";
            }
            return $row;
        }
    }
}

?>