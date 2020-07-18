<?php


function inputtype($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function page_redirect($location=NULL){
    if($location!=NULL){
        header("Location:{$location}");
        exit;
    }
}
function get_all_post(){
    global $connection;
    $psql="SELECT * FROM posts";
    $result_psql=mysqli_query($connection,$psql);
    return $result_psql;
}
function get_all_post_by_id()
{
    if (isset($_GET['posts'])) {
global $connection;

        $id = $_GET['posts'];
        $psql = "SELECT * FROM posts WHERE post_id={$id}";
        $result_psql = mysqli_query($connection, $psql);
        if ($result_psql->num_rows > 0) {
            while ($rows = mysqli_fetch_assoc($result_psql)) {
                $id_for_update = $rows['id'];
                $title = $rows['title'];
                $author = $rows['author'];
                $body = $rows['body'];
                $keyword = $rows['keyword'];
                $date = $rows['date'];
                $category = $rows['category'];
            }
        }
    }
}

function add_comment()
{
    global $connection;
    if (isset($_POST['post_comment'])) {
        global $id;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $body = $_POST['body'];
        $post_id = $_POST['post_id'];
        $postf_id = $_POST['postf_id'];
        $status='unread';

        $comment_sql = "INSERT INTO comments (name,email,body,created_at,status,post_id) VALUES ('{$name}','{$email}','{$body}',NOW(),'{$status}','{$postf_id}')";

        $result_comment_sql = mysqli_query($connection, $comment_sql);
        if ($result_comment_sql) {
            echo "<script>alert('commented')</script>";
            echo "<script>windows.open(reply.php,'_self')</script>";
        } else {
            echo "<script>alert('commented error')</script>";
        }
    }
}


function get_all_comments_by_post_id(){
    //so as to use to display comments amount for each post
    if (isset($_GET['posts'])) {

        $id = $_GET['posts'];
        global $connection;
        $comment_query = "SELECT * FROM comments WHERE post_id={$id}";
        $comment_result = mysqli_query($connection, $comment_query);
        return $comment_result;
    }
}
function getting_comments_and_replies()
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




    </div>
<!--    <a href='reply.php?comments=--><?php //echo htmlspecialchars(urlencode($c_id)); ?><!--&posts=--><?php //echo htmlspecialchars(urlencode($id)); ?><!--'-->
<!--       class='btn btn-primary btn-sm' style='float: right;'>Reply</a>-->

    <div id="accordion" class="panel-group" >
        <div class="panel panel-primary" >
            <div class="panel-heading" >
                <h4 class="panel-title"  >
                    <button href="#panelBodyOne" id="myBtn" class='btn btn-primary btn-sm' data-toggle="collapse" data-parent="#accordion" style="float: right;"><!--again using the jquery href attribute we call the id(panelbodyone)
                            from panel body div to link panel title and body and also use data-parent="#accordion" to link parent panel id to the rest-->
                        Reply
                    </button>

                    <script>
                        var x = document.getElementById("myBtn");
                        x.addEventListener("click", myFunction);


                        function myFunction() {
                            document.getElementById("myBtn").innerHTML="Cancel Reply"
                            var y=document.getElementById("myBtn");
                            y.addEventListener("click", myFunction2);
                            function myFunction2() {
                                document.getElementById("myBtn").innerHTML="Reply"

                            }
                        }






                    </script>
                </h4>
            </div>
            <br>
            <br>
            <div id="panelBodyOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
<?php include ('includes/reply_form.html'); ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <br>
    <hr>
    <?php

    // get_replies();

      $page_query = "SELECT replies.* FROM replies JOIN comments ON replies.comment_id=comments.comment_id WHERE replies.comment_id=$c_id ";

    $result_psql = mysqli_query($connection, $page_query);
    $result_count = mysqli_num_rows($result_psql);
    if ($result_psql->num_rows > 0) {
        while ($rows = mysqli_fetch_assoc($result_psql)) {
            $r_id=$rows['replies_id'];
            $rname = $rows['name'];
            $rbody = $rows['body'];
            $rdate = $rows['created_at'];
            ?>
            <div>

                <div class="comment-head">
                    <a href="#"><?php echo $rname; ?></a><span
                            style="float:right;"><?php echo $rdate; ?></span>
                    <img width="50" height="50" src="img/noimg.jpg"/>
                </div>
                <h3 style="font-family:Helvetica Neue" ;><?php echo $rbody; ?></h3>

            </div>
<!--            Reply drop down form-->
            <div class="dropdown">
                <button class="dropdown-toggle btn btn-sm btn-primary" type="button"  id="dropdownMenuButton"   style="float: right;" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Reply
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li class="dropdown-item">
                        <?php include ('includes/reply_form.html'); ?>
                    </li>
                </div>
                <!--            Reply drop down form-->
                <script>

                </script>

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

<?php
function inserting_replies(){
global $connection;
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
    $comment_sql = "INSERT INTO replies (comment_id,name,email,body,created_at,status) VALUES ('{$comment_id}','{$name}','{$email}','{$body}',NOW(),'unread')";

    $result_comment_sql = mysqli_query($connection, $comment_sql);
    if ($result_comment_sql) {
        echo "<script>alert('Comment updated')</script>";
        echo "<script>window.open('single.php?posts='.urlencode($id).'','_self')</script>";
    } else {
        echo "<script>alert('commented error')</script>";
    }
}

}
?>
<?php
function search_result()
{
    if (isset($_GET['search'])) { //if we are not looking  to get categories run the code below

        $user_search=$_GET['user_search'];

        global $connection;

        $get_post= "SELECT * FROM posts WHERE keyword like '%$user_search%'";//displaying search posts like keywords

        $run_post = mysqli_query($connection, $get_post);
        if ($run_post->num_rows > 0) {

            while ($row = mysqli_fetch_array($run_post)) {

                echo  "<a href='single.php?posts=".urlencode($row['post_id'])."' class='blog-post-title'>".$row['title']."</a>";

                echo "<p class='blog-post-meta'>".$row['keyword']."</p>";
                echo "<p class='blog-post-meta'>".$row['date']."</p>";echo "<a href='#'>".$row['author']."</a><br>";
                $body=$row['body'];
                $body_len=substr($body,0,100);//length of words to display
                echo $body_len."...";

                echo "<a href='single.php?posts=".urlencode($row['post_id'])."' class='btn btn-primary'>Read more....</a>";
                echo "<br>";
                echo "<br>";
                echo "<hr>";
            }
        } else {
            echo "<h2 >Ooops your search dosent match any description try another format</h2>";
        }
    }
}
?>

<?php
function subscribe_reg()
{

        if (isset($_POST['subscribe'])) {
            global $connection;
            global $nameErr,$emailErr;
            $nameErr=$emailErr="";
            $sname=$email=$cname=$cemail="";
            if (empty($_POST['name'])) {
                $nameErr = "please fill this tab";
            } else {
                $sname= inputtype($_POST['name']);
                if (!preg_match("/^[a-zA-Z ]*$/", $sname)) {
                    $nameErr = "Only white spaces and letters are allowed";
                } else {
                    $cname = $sname;
                }
            }
            if (empty($_POST['email'])) {
                $emailErr = "please fill this tab";
            } else {
                $email = inputtype($_POST["email"]);
                // check if email syntax is valid
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "enter a valid email address";
                } else {
                    $cemail = $email;
                }
            }
            if ($nameErr != "" || $emailErr != "") {
                global $Emessage;
               $Emessage = "Subscribtion unsuccessful";
            } else {
                $sub_sql = "INSERT INTO subscribers (name,email) VALUES ('{$cname}','{$cemail}')";
                $result_sub_sql = mysqli_query($connection, $sub_sql);
                if ($result_sub_sql) {
                    global $Smessage;
                   $Smessage = "Expect Our blog updates 'as e ey hot!!!!'";
                }
            }

        }


}

?>
