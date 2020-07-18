<?php include("includes/header.php");
include("includes/functions.php");
//displays blog post
if(isset($_GET['posts']))
{
	$id=mysqli_real_escape_string($connection,$_GET['posts']);
	$ssql="SELECT * FROM posts WHERE post_id='$id'";
}
$result_ssql=mysqli_query($connection,$ssql);

?>
<br>

<div class="blog-post">
	<?php
if($result_ssql->num_rows>0) {
    while ($post_rows = mysqli_fetch_array($result_ssql)) {

        echo "<p  class='blog-post-title'>" . $post_rows['title'] . "</p>";

        echo "<p class='blog-post-meta'>" . $post_rows['date'] . "</p>";
        echo "<a href='#'>" . $post_rows['author'] . "</a><br>";
        $body = $post_rows['body'];
        //$body_len=substr($body,0,100);//length of words to display
        echo $body . "...";
        $pid = $post_rows['post_id'];
        echo "<br>";
        echo "<br>";
        echo "<a href='#comment' class='btn btn-primary' style='float: right;'>Drop your comment</a>";

    }
}
    //displays blog post


		  ?>


<!--displaying comments quantity-->
    <blockquote>
        <?php
        //getting all posts
        $comments= get_all_comments_by_post_id();
        //counting the rows
        $count=mysqli_num_rows($comments);

            if($count<=1){
                echo $count." comment";
            }elseif ($count>1){
                echo $count ." comments";
            }

        ?>
    </blockquote>
    <!--displaying comments quantity-->

    <?php
    getting_comments_and_replies();//fuction to display comments
    inserting_replies();
    ?>


<!--    //uploloading comments-->
    <div id="comment">
    <?php
    global $connection;

    if (isset($_GET['posts'])) {

        $id = $_GET['posts'];
        $psql = "SELECT * FROM posts WHERE post_id={$id}";
        $result_psql = mysqli_query($connection, $psql);
        if ($result_psql->num_rows > 0) {
            while ($rows = mysqli_fetch_assoc($result_psql)) {
                $id_for_update = $rows['post_id'];
                $title = $rows['title'];
                $author = $rows['author'];
                $body = $rows['body'];
                $keyword = $rows['keyword'];
                $date = $rows['date'];
                $category = $rows['category'];
            }
        }
    }

    if (isset($_POST['post_comment'])) {
        global $id;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $body = $_POST['body'];
        $post_id = $_POST['post_id'];
        $comment_sql = "INSERT INTO comments (name,post_id,email,body,created_at,status) VALUES ('{$name}','{$post_id}','{$email}','{$body}',NOW(),'unread')";

        $result_comment_sql = mysqli_query($connection, $comment_sql);
        if ($result_comment_sql) {
            echo "<script>alert('commented')</script>";
            echo "<script>windows.open('#comment','_self')</script>";
        } else {
            echo "<script>alert('commented error')</script>";
        }
    }
    ?>
    </div>
    <div class="comment-area">
        <?php?>
        <form method="POST" action="single.php?posts=<?php echo htmlspecialchars(urlencode($id)); ?>">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" />
            </div>

            <div class="form-group">
                <!--            <label for="post_id">post_id</label>-->
                <input type="hidden" class="form-control" name="post_id" value="<?php echo $id; ?>"/>
            </div>


            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email address" />
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="body" cols="66" rows="10" placeholder="Comments"></textarea>
            </div>
<?php
           echo "<button type='submit'  name='post_comment' class='btn btn-primary'>Post Comment</button>";
//echo "<button type='submit' name='post_reply'  class='btn btn-primary'>Post Reply</button>";
?>
        </form>
    </div>

    <br>
    <br>
    <hr>

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


<!--    <hr>-->
<!--    <div class="comment">-->
<!--        <div class="comment-head">-->
<!--            <a href="#">Jake Obodo</a>-->
<!--            <img width="50" height="50" src="img/noimg.jpg"/>-->
<!--        </div>-->
<!--        I think this is something else.-->
<!--    </div>-->
<!---->
<!---->
<!--    <div class="comment">-->
<!--        <div class="comment-head">-->
<!--            <a href="#">Gblend</a>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info btn-xs">Admin</button>-->
<!--            <img width="50" height="50" src="img/noimg.jpg"/>-->
<!--        </div>-->
<!--        Admin responded.-->
<!---->
<!--        <div class="comment-head">-->
<!--            <a href="#">Gblend</a>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info btn-xs">Admin</button>-->
<!--            <img width="50" height="50" src="img/noimg.jpg"/>-->
<!--        </div>-->
<!--        Admin responded.-->
<!--    </div>-->
<!---->

</div><!-- /.blog-post -->



    </div><!-- /.blog-main -->

<?php include("includes/sidebar.php");
subscribe_reg();?>
<?php include("includes/footer.php");?>