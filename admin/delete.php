<?php
require_once("includes/session.php");
 confirm_logged_in();
include("includes/functions.php");
require_once("includes/db.php");
$id=$_GET['posts'];
//selects all from posts where id is post id
$post_sql="SELECT * FROM posts WHERE post_id={$id}";
$result_post_sql=mysqli_query($connection,$post_sql);
$row=mysqli_fetch_assoc($result_post_sql);
$title=$row['title'];
$written_by=$row['author'];
$deleted_by=$_SESSION['fullname'];

//insert into our waste bin table
$insert_delete="INSERT INTO bin (deleted_by,title,written_by,deleted_at) VALUES ('{$deleted_by}','{$title}','{$written_by}',NOW())";
$result_insert_delete=mysqli_query($connection,$insert_delete);

//deletes from posts table
$delete_sql="DELETE FROM posts WHERE posts.post_id={$id} LIMIT 1";
$result_delete=mysqli_query($connection,$delete_sql);
if($result_delete==1){
    echo "<script>alert('product deleted')</script>";
    page_redirect('index.php?dmessage=correct');
}else{
    echo "<script>alert('unable to delete')</script>";
   page_redirect('index.php?dmessage=error');
}
?>
