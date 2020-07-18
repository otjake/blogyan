<?php include("includes/header.php");
include("includes/functions.php");
global $connection;
subscribe_reg();
//if (isset($_GET['posts'])) {
//
//    $id_p = $_GET['posts'];
//    $psql = "SELECT * FROM posts WHERE id={$id_p}";
//    $result_psql = mysqli_query($connection, $psql);
//    if ($result_psql->num_rows > 0) {
//        while ($prows = mysqli_fetch_assoc($result_psql)) {
//            $id_for_update = $prows['id'];
//            $title = $prows['title'];
//            $author = $prows['author'];
//            $body = $prows['body'];
//            $keyword = $prows['keyword'];
//            $date = $prows['date'];
//            $category = $prows['category'];
//        }
//    }
//}

if (isset($_GET['comments'])) {

    $id_c = $_GET['comments'];
    $csql = "SELECT * FROM comments WHERE comment_id={$id_c}";
    $result_csql = mysqli_query($connection, $csql);
    if ($result_csql->num_rows > 0) {
        while ($crows = mysqli_fetch_assoc($result_csql)) {
          $post_id = $crows['post_id'];

//            $title = $crows['title'];
//            $author = $crows['author'];
//            $body = $crows['body'];

        }
    }
}

if (isset($_POST['post_reply'])) {
    global $id;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $body = $_POST['body'];
   // $post_id = $_POST['post_id'];
    $comment_id=$_POST['comment_id'];
   // $commentf_id=$_POST['commentf_id'];
//  $comment_sql = "INSERT INTO replies (commentf_id,comment_id,name,email,body,created_at) VALUES ('{$commentf_id}','{$comment_id}','{$name}','{$email}','{$body}',NOW())";
//  $comment_sql = "INSERT INTO replies (post_id,comment_id,name,email,body,created_at) VALUES ('{$post_id}','{$comment_id}','{$name}','{$email}','{$body}',NOW())";
 $comment_sql = "INSERT INTO replies (comment_id,name,email,body,created_at) VALUES ('{$comment_id}','{$name}','{$email}','{$body}',NOW())";//original

    $result_comment_sql = mysqli_query($connection, $comment_sql);
    if ($result_comment_sql) {
        echo "<script>alert('commented')</script>";
        echo "<script>windows.open('index.php','_self')</script>";
    } else {
        echo "<script>alert('commented error')</script>";
    }
}
?>

<div class="comment-area">
    <?php?>
    <form method="POST" action="single.php?comments=<?php echo htmlspecialchars(urlencode($id_c)); ?> ">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" />
        </div>

        <div class="form-group">
            <label for="comment_id">comment_id</label>
            <input type="integer" class="form-control" name="comment_id" value="<?php echo $id_c; ?>"/>
        </div>

<!--        <div class="form-group">-->
<!--          <label for="post_id">post_id</label>-->
<!--            <input type="integer" class="form-control" name="commentf_id" value="--><?php //echo $post_id; ?><!--"/>-->
<!--       </div>-->
<!--        <div class="form-group">-->
<!--          <label for="post_id">post_id</label>-->
<!--            <input type="integer" class="form-control" name="post_id" value="--><?php //echo $post_id; ?><!--"/>-->
<!--        </div>-->


        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email address" />
        </div>

        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="body" cols="66" rows="10" placeholder="Comments"></textarea>
        </div>

        <button type="submit" name="post_reply" class="btn btn-primary">Post reply</button>

    </form>
</div>

<br>
<br>
<hr>
<?php
//if (isset($_GET['posts'])) {
//
//    $id = $_GET['posts'];
//    $psql = "SELECT * FROM comments WHERE post_id={$id}";
//    $result_psql = mysqli_query($connection, $psql);
//    if ($result_psql->num_rows > 0) {
//        while ($rows = mysqli_fetch_assoc($result_psql)) {
//
//            $name = $rows['Name'];
//            $body = $rows['body'];
//            $date=$rows['created_at'];
?>

<?php
//get_replies();
//global $connection;
//if (isset($_GET['comments'])) {
//
//    $c_id = $_GET['comments'];
//    $page_query="SELECT * FROM replies ";
//    $page_query .="WHERE comment_id= {$c_id} ";
//    if(isset($_GET['posts'])){
//        $p_id=$_GET['posts'];
//        $page_query .="AND post_id=$p_id ";
//    }
//    $page_query .="ORDER BY id ASC ";
//    //var_dump($page_query);
//    $result_psql = mysqli_query($connection, $page_query);
//    if ($result_psql->num_rows > 0) {
//        while ($rows = mysqli_fetch_assoc($result_psql)) {
//
//            $rname = $rows['name'];
//            $rbody = $rows['body'];
//            $rdate = $rows['created_at'];
//            ?>
<!--            <div>-->
<!--                <div class="comment-head">-->
<!--                    <a href="#">--><?php //echo $rname; ?><!--</a><span-->
<!--                            style="float:right;">--><?php //echo $rdate; ?><!--</span>-->
<!--                    <img width="50" height="50" src="img/noimg.jpg"/>-->
<!--                </div>-->
<!--                <h3 style="font-family:Helvetica Neue" ;>--><?php //echo $rbody; ?><!--</h3>-->
<!---->
<!--            </div>-->
<!--            --><?php
//
//
//
//        }
//    }
//}?>

<!---->
<!--<div class="comment">-->
<!--    <div class="comment-head">-->
<!--        <a href="#">Gblend</a>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info btn-xs">Admin</button>-->
<!--        <img width="50" height="50" src="img/noimg.jpg"/>-->
<!--    </div>-->
<!--    Admin responded.-->
<!---->
<!--    <div class="comment-head">-->
<!--        <a href="#">Gblend</a>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info btn-xs">Admin</button>-->
<!--        <img width="50" height="50" src="img/noimg.jpg"/>-->
<!--    </div>-->
<!--    Admin responded.-->
<!--</div>-->




</div><!-- /.blog-main -->

<?php include("includes/sidebar.php");?>
<?php include("includes/footer.php");?>
