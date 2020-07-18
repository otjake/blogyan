function getting_comments()
{

global $connection;
if (isset($_GET['posts'])) {

$id = $_GET['posts'];
// $psql = "SELECT * FROM comments WHERE post_id={$id}";

$psql = "SELECT comments.comment_id ,comments.Name, comments.body, comments.created_at,comments.post_id FROM comments JOIN posts ON comments.post_id=posts.post_id WHERE comments.post_id={$id}";
$result_psql2 = mysqli_query($connection, $psql);
$subject_count = mysqli_num_rows($result_psql2);
if ($result_psql2->num_rows > 0) {
while ($rows = mysqli_fetch_assoc($result_psql2)) {

                $name = $rows['Name'];
                $body = $rows['body'];
                $date = $rows['created_at'];
$c_id = $rows['comment_id'];

?>
<div class="jumbotron" style="padding: 30px;">
    <div class="comment">
        <div class="comment-head">
            <a href="#"><?php echo $name; ?></a><span
                    style="float:right;"><?php echo $date; ?></span>
            <img width="50" height="50" src="img/noimg.jpg"/>
        </div>
        <h3 style="font-family:Helvetica Neue" ;><?php echo $body; ?></h3>

        <hr>


    </div>
    <a href='reply.php?comments=<?php echo htmlspecialchars(urlencode($c_id)); ?>&posts=<?php echo htmlspecialchars(urlencode($id)); ?>'
       class='btn btn-primary btn-sm' style='float: right;'>Reply</a>

    <?php

    // get_replies();

      $page_query = "SELECT comments.body AS comment_body,comments.Name AS comment_name,comments.created_at AS comment_date,replies.name,replies.body,replies.created_at FROM replies JOIN comments ON replies.comment_id=comments.comment_id WHERE replies.comment_id=$c_id ";

    $result_psql = mysqli_query($connection, $page_query);
    $result_count = mysqli_num_rows($result_psql);
    if ($result_psql->num_rows > 0) {
        while ($rows = mysqli_fetch_assoc($result_psql)) {

            $cbody = $rows['comment_body'];
            $cname = $rows['comment_name'];
            $cdate = $rows['comment_date'];
            $rname = $rows['name'];
            $rbody = $rows['body'];
            $rdate = $rows['created_at'];
            ?>
            <div>
                <div class="comment">
                    <div class="comment-head">
                        <a href="#"><?php echo $cname; ?></a><span
                                style="float:right;"><?php echo $cdate; ?></span>
                        <img width="50" height="50" src="img/noimg.jpg"/>
                    </div>
                    <h3 style="font-family:Helvetica Neue" ;><?php echo $cbody; ?></h3>

                    <hr>


                </div>
                <div class="comment-head">
                    <a href="#"><?php echo $rname; ?></a><span
                            style="float:right;"><?php echo $rdate; ?></span>
                    <img width="50" height="50" src="img/noimg.jpg"/>
                </div>
                <h3 style="font-family:Helvetica Neue" ;><?php echo $rbody; ?></h3>

            </div>
            <?php

        }
    }
    ?>

</div>
<?php

    }

    }
    }
    }
?>
<div id="accordion" class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="#panelBodyOne reply.php?comments=<?php echo htmlspecialchars(urlencode($c_id)); ?>&posts=<?php echo htmlspecialchars(urlencode($id)); ?>"
                       data-toggle="collapse" data-parent="#accordion"   class='btn btn-primary btn-sm'  style='float: right;'><!--again using the jquery href attribute we call the id(panelbodyone)
                            from panel body div to link panel title and body and also use data-parent="#accordion" to link parent panel id to the rest-->
                        <span  class="glyphicon glyphicon-menu-down"></span>
                        Reply
                    </a>
                </h4>
            </div>
            <div id="panelBodyOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <li>
                            <form method="post" action="single.php?posts=<?php echo htmlspecialchars(urlencode($id)); ?>">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" />
                                </div>

                                <div class="form-group">
                                    <label for="comment_id">comment_id</label>
                                    <input type="integer" class="form-control" name="comment_id" value="<?php echo $c_id; ?>"/>
                                </div>

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
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
