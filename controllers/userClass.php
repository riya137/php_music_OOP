<?php 
  include_once('database.php');
  $db_connect=new DB_connection();
  $connection=$db_connect->connect();
  class User{
    public function login_user($email,$password){
       global $connection;
       $login_query="select * from m_users where email='$email' and password='$password'";
       $login_user=mysqli_query($connection,$login_query);
       return $login_user;
   }

    public function register_user($first_name,$last_name,$email,$password,$image){
      global $connection;
       $register_query="insert into m_users(first_name,last_name,email,password,user_image) values('$first_name','$last_name','$email','$password','$image')";
       $register_user=mysqli_query($connection,$register_query); 
       return $register_user;
   }

   public function forget_chk_email($email){
      global $connection;
       $iExixts_query="select * from m_users where email='$email'";
       $chk_isExists=mysqli_query($connection,$iExixts_query);
       return $chk_isExists;
   }

   public function reset_pass($email,$password){
      global $connection;
      $reset_query="update m_users set password ='$password' where email='$email'";
      $reset_result=mysqli_query($connection,$reset_query);
      return $reset_result;
   }

   public function maintain_username($email){
      global $connection;
      $get_name_query="select * from m_users where email='$email'";
      $run_select=mysqli_query($connection,$get_name_query);
      $row=mysqli_fetch_array($run_select);
      return $row;
   }

}

?>