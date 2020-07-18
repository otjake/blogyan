<?php require_once ("includes/db.php");?>
<?php
//$cquery="SELECT * FROM categories";
//$result=mysqli_query($connection,$cquery);


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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script src="includes/jquery-3.4.1.js"></script>


</head>

<body>

	



<div class="blog-masthead">
    <div class="container">
        <ul>
            <li class="<?php if($category=='posts'){echo 'active';}?>"><a href="index.php">POSTS</a></li>
            <li class="<?php if($category=='visitors'){echo 'active';}?>"><a  href="visitors.php">VISITORS</a></li>
            <li class="<?php if($category=='register_admin'){echo 'active';}?>"><a  href="register_admin.php">ADD&nbspADMIN</a></li>
            <li class=" <?php if($category=='notifications'){echo 'active';}?> dropdown" style="margin-left: 50%;">
                <a  href="#"  role="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    NOTIFICATIONS <span class="badge badge-danger"><?php
                        //getting all posts
                        $comments= get_all_comments();
                        //counting the rows
                        $count=mysqli_num_rows($comments);
                        if($count>0) {
                            echo $count;
                        }else{
                            echo NULL;
                        }
                        ?></span>
                </a>


                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown">
                    <?php
                    $comments=get_all_comments();
                    if($comments->num_rows>0){
                    while($rows=mysqli_fetch_assoc($comments)){

                    ?>
                    <a class="dropdown-item" href="comment_specific.php?comments=<?php echo urlencode($rows['comment_id']); ?>">
                        <small><?php echo $rows['created_at']; ?></small>
                    <p><?php echo $rows['Name']; ?> left a comment</p>
                    </a>
                    <div class="dropdown-divider"></div>

                <?php
                }
                }
                else{
                    echo "No New Comments";
                }
                ?>
                </div>
            </li>
            <ul>
    </div>
</div>

<!--<script type="text/javascript">-->
<!--    $(document).on('click','ul li',function(){-->
<!--        $(this).addClass('active').siblings().removeClass('active')-->
<!--    })-->
<!--</script>-->
<div class="container">



    <div class="row">

        <div class="col-sm-8 blog-main">