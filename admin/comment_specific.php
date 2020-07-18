<?php require_once("includes/session.php");?>
<?php confirm_logged_in();?>
<?php
include("includes/functions.php");
include("includes/header.php");
if(isset($_GET['comments'])) {
    $c_id = mysqli_real_escape_string($connection, $_GET['comments']);
//    $psql="SELECT * FROM comments WHERE comment_id='$id_c'";

        $psql = "SELECT comments.*,posts.body as post_body,posts.date as post_date,posts.title as post_title,posts.author as post_author FROM comments JOIN posts ON comments.post_id=posts.post_id WHERE comments.comment_id={$c_id}";
}
$result_psql2 = mysqli_query($connection, $psql);
//$rows = mysqli_fetch_assoc($result_psql2);
//$c_id = $rows['comment_id'];
//$usql="UPDATE `comments` SET `status` = 'read' WHERE `comments`.`comment_id` = {$c_id}";
//$result_usql = mysqli_query($connection, $usql);
//displays blog post

//    $id_p=mysqli_real_escape_string($connection,$_GET['posts']);
//    $ssql="SELECT * FROM posts WHERE post_id='$id_p'";
//$result_ssql=mysqli_query($connection,$ssql);

?>
    <br>

    <div class="blog-post">
<!--        --><?php
//        if($result_ssql->num_rows>0) {
//            while ($post_rows = mysqli_fetch_array($result_ssql)) {
//
//                echo "<p  class='blog-post-title'>" . $post_rows['title'] . "</p>";
//
//                echo "<p class='blog-post-meta'>" . $post_rows['date'] . "</p>";
//                echo "<a href='#'>" . $post_rows['author'] . "</a><br>";
//                $body = $post_rows['body'];
//                //$body_len=substr($body,0,100);//length of words to display
//                echo $body . "...";
//                $pid = $post_rows['post_id'];
//                echo "<br>";
//                echo "<br>";
//                echo "<a href='#comment' class='btn btn-primary' style='float: right;'>Drop your comment</a>";
//
//            }
//        }
        //displays blog post


        ?>


        <?php
        if($result_psql2->num_rows>0) {
        while ($post_rows = mysqli_fetch_array($result_psql2)) {
$name=$post_rows['Name'];
        $date=$post_rows['created_at'];
        $body=$post_rows['body'];
        //collecting post properties
$post_title=$post_rows['post_title'];
            $post_date=$post_rows['post_date'];
            $post_author=$post_rows['post_author'];



        ?>
<!--      post output      -->
<p  class='blog-post-title'><?php echo $post_rows['post_title']; ?></p>

<p class='blog-post-meta'><?php echo $post_rows['post_date']; ?></p>
<a href='#'><?php echo  $post_rows['post_author']; ?></a><br>

<?php $post_body=$post_rows['post_body'];
//$body_len=substr($body,0,100);//length of words to display
echo $post_body . "...";
$pid = $post_rows['post_id'];
?>
<br>
<br>
            <!--      post output      -->
            <div class="alert alert-info" style="color: red;"> <?php echo $name; ?> dropped the comment below for the post above</div>

            <!--      notification comment output      -->

            <div class="jumbotron" style="padding: 30px;">
            <div class="comment">
                <div class="comment-head">
                    <a href="#"><?php echo $name; ?></a><span
                            style="float:right;"><?php echo $date; ?></span>
                    <img width="50" height="50" src="img/noimg.jpg"/>
                </div>
                <h3 style="font-family:Helvetica Neue" ;><?php echo $body; ?></h3>


            </div>
            <!--    <a href='reply.php?comments=--><?php //echo htmlspecialchars(urlencode($c_id)); ?><!--&posts=-->
            <?php //echo htmlspecialchars(urlencode($id)); ?><!--'-->
            <!--       class='btn btn-primary btn-sm' style='float: right;'>Reply</a>-->

            <div id="accordion" class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <button href="#panelBodyOne" id="myBtn" class='btn btn-primary btn-sm'
                                    data-toggle="collapse" data-parent="#accordion" style="float: right;"><!--again using the jquery href attribute we call the id(panelbodyone)
                            from panel body div to link panel title and body and also use data-parent="#accordion" to link parent panel id to the rest-->
                                Reply
                            </button>


                        </h4>
                    </div>
                    <br>
                    <br>
                    <div id="panelBodyOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                <?php include('includes/reply_form.html'); ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
            echo "<a href='delete_comments.php?comments=" . $c_id. "'  onclick='return confirm('Are you sure ?)' class='btn btn-danger'>DELETE COMMENT</a>";
$usql="UPDATE `comments` SET `status` = 'read' WHERE `comments`.`comment_id` = {$c_id}";
$result_usql = mysqli_query($connection, $usql);
            }
            }
                    ?>


        <!--      notification comment output      -->

        <!--displaying comments quantity-->

        <!--displaying comments quantity-->
<!--        --><?php
//        //ALERT MESSAGES USING URL STRPOS
//        $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//        if(strpos($fullUrl,"message=error")== TRUE){
//
//            echo "  <div id=\"ealert\" class=\"alert alert-danger \">
//                 <a  id=\"linkClose\" href=\"#\" class=\"close\" >&times;</a>
//                        <strong>Error!</strong> Something went wrong
//                    </div>";
//
//        }
//        elseif(strpos($fullUrl,"message=success")== TRUE){
//
//            echo "<div id='salert' class='alert alert-success' >
//    <a  id='linkClose' href='#' class='close'>&times;</a>Uploaded</div>";
//
//        }

        ?>

        <?php

        inserting_replies();
        ?>






        <br>
        <br>
        <hr>


    </div><!-- /.blog-post -->



    </div><!-- /.blog-main -->

<?php include("includes/sidebar.php");?>
<?php include("includes/footer.php");?>