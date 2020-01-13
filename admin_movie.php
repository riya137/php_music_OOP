<?php
 include('navbar.php');
 include('controllers/adminClass.php');

 $admin_data=new Admin();
?>
<html>
<head>
    <title>Admin Panel </title>
    <link rel="stylesheet" href="css/mystyle/register.css">

<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-6 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Insert data for Musically </h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post" name="insert_movie" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                          <input type="text" name="movie_name" id="movie_name" class="form-control input-sm" placeholder="Movie Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="movie_year" id="movie_year" class="form-control input-sm" placeholder="Movie Year">
			    					</div>
			    				</div>
			    			</div>

							<div class="form-group">
			    				<input type="file" name="movie_image" id="movie_image" class="form-control input-sm" >
			    			</div>
			    			
			    			<input type="submit" value="Next" class="btn btn-info btn-block" name="submit">
			    		
                        </form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</body>
<script>
   
</script>
</html>

<?php
//register user into backend
 if(isset($_POST['submit'])){
    $movie_name=$_POST['movie_name'];
	$movie_year=$_POST['movie_year'];

	$movie_image=$_FILES['movie_image']['name'];
	$image_tmp=$_FILES['movie_image']['tmp_name'];
	move_uploaded_file($image_tmp,"images/".$movie_image);

    $last_movie_id=$admin_data->insert_movie($movie_name,$movie_year,$movie_image);
	if($last_movie_id!=null){
	//	echo $last_movie_id;
	    echo "<script>location.href='admin_song.php;</script>";
	}
  
}
?>