<?php require_once("includes/session.php");?>
<?php confirm_logged_in();?>
<?php include("includes/functions.php"); ?>
<?php $category='visitors';include("includes/header.php"); ?>
<?php

if(isset($_GET['category'])){//checking if a category is selected so it could display
    $category=mysqli_real_escape_string($connection,$_GET['category']);
    $psql="SELECT * FROM posts WHERE category='$category'";
}else{
    $psql="SELECT * FROM posts";
}
$result_psql=mysqli_query($connection,$psql);
?>
<div class="blog-header">

    <h1 class="blog-title">BlogCMS</h1>
</div>

<div class="blog-post">
    <?php
    if($result_psql->num_rows > 0){
        while($post_rows=mysqli_fetch_array($result_psql)){
            echo  "<a href='filter_replies.php?posts=".urlencode($post_rows['post_id'])."' class='blog-post-title'>".$post_rows['title']."</a>";

            echo "<p class='blog-post-meta'>".$post_rows['date']."</p>";echo "<a href='#'>".$post_rows['author']."</a><br>";
            $body=$post_rows['body'];
            $body_len=substr($body,0,200);//length of words to display
            echo $body_len."...";

            echo "<a href='filter_replies.php?posts=".urlencode($post_rows['post_id'])."' class='btn btn-primary'>Filter comments & replies</a>";
            echo "<br>";
            echo "<br>";
            echo "<hr>";
        }
    }
    ?>

</div><!-- /.blog-post -->


</div><!-- /.blog-main -->

<?php include("includes/sidebar.php");?>
<?php include("includes/footer.php");?>
