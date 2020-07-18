<?php require_once ("includes/db.php");?>
<?php
$cquery="SELECT * FROM categories";
$result=mysqli_query($connection,$cquery);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BlogCMS</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">
    <link href="css/fontawesome.min.css" type="text/css" rel="stylesheet">

    <script src="includes/jquery-3.4.1.js"></script>

</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <?php
			if(isset($_GET['category'])){//active page indication
			echo "<a class='blog-nav-item' href='index.php'>Home</a>";
			}else{
				echo "<a class='blog-nav-item active ' href='index.php'>Home</a>";
				 }
			//getting nav ctegories dynamically.
			if($result->num_rows >0){
				while($rows=mysqli_fetch_array($result)){
					if(isset($_GET['category']) && $rows['id']== $_GET['category']){//active page indication
					echo "<a class='blog-nav-item active' href='index.php?category=".urlencode($rows['id'])."' >".$rows['cat_title']."</a>";
					}else{
						echo "<a class='blog-nav-item' href='index.php?category=".urlencode($rows['id'])."' >".$rows['cat_title']."</a>";
						
					}
				}
                echo "<a class='blog-nav-item' href='subscribe.php' style='float: right;'>Subscribe</a>";
}
			?>
            
            
        </nav>
    </div>
</div>

<div class="container">



    <div class="row">

        <div class="col-sm-8 blog-main">