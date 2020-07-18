<?php
include("includes/functions.php");
require_once("includes/db.php");
 $posts=get_all_post();
$rows=mysqli_fetch_assoc($posts);
$id_p=$rows['post_id'];
    $id_c= $_GET['comments'];
    $delete_sql = "DELETE FROM comments WHERE comment_id={$id_c} LIMIT 1";
    $result_delete = mysqli_query($connection, $delete_sql);
    if ($result_delete == 1) {
        echo "<script>alert('product deleted')</script>";
        page_redirect('filter_replies.php?posts='.urlencode($id_p).'');
    } else {
        echo "<script>alert('unable to delete')</script>";
        page_redirect('filter_replies.php?posts='.urlencode($id_p).'');    }

?>
