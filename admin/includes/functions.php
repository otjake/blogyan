<?php



function get_all_categories(){

    global $connection;
    $posts_query="SELECT * FROM categories";
    $posts_result=mysqli_query($connection,$posts_query);
    return $posts_result;

}

function get_all_post(){

    global $connection;
    $posts_query="SELECT * FROM posts";
    $posts_result=mysqli_query($connection,$posts_query);
    return $posts_result;

}

function get_all_comments(){

    global $connection;
    $comments_query="SELECT * FROM comments WHERE status='unread' order by comment_id desc ";
    $comments_result=mysqli_query($connection,$comments_query);
    return $comments_result;

}



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

function Admin_blog_upload_form()
{

    global $connection;
    global $category;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['upload'])) {
            if (!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST["date"]) && !empty($_POST["body"]) && !empty($_POST["author"]) && !empty($_POST["keyword"])) {
//category,date,body,author,keyword
                $title = inputtype($_POST['title']);
                $category = ($_POST['category']);
                $date = ($_POST["date"]);
                $body = inputtype($_POST["body"]);
                $author = inputtype($_POST["author"]);
                $keyword = inputtype($_POST["keyword"]);
//to get specific id so we know where we are updating


                $usql = "INSERT INTO posts (title,category,date,body,author,keyword) VALUES ('{$title}','{$category}','{$date}','{$body}','{$author}','{$keyword}')";

                $result = $connection->query($usql);
                if ($result) {
//                    page_redirect('index.php?message=success');
//                    exit();
                    global $Smessage;
                    $Smessage="Upload Successful";
                } else {
//                    page_redirect('index.php?message=error');
//                    exit();
                    global $Emessage;
                    $Emessage="Upload Failed";

                }
            } else {
//                page_redirect('index.php?message=error');
//                exit();
                global $Emmessage;
                $Emmessage="you left tabs empty";
            }

$mail_sql="SELECT * FROM subscribers";
            $result_mail_sql=mysqli_query($connection,$mail_sql);
            if($result_mail_sql->num_rows>0){
                while($rows=mysqli_fetch_assoc($result_mail_sql)){
                    $sub_name=$rows['name'];
                    $sub_email=$rows['email'];
                    $post_sql="SELECT * FROM posts";
                    $result_post_sql=mysqli_query($connection,$post_sql);
                    $row=mysqli_fetch_assoc($result_post_sql);
                    $title=$row['title'];
                    $author=$row['author'];
                    $body=$row['body'];
                    $body_len=substr($body,0,100);//length of words to display
                    $id=$row['post_id'];

            date_default_timezone_set('Etc/UTC');

// Edit this path if PHPMailer is in a different location.
            require_once 'PHPMailerAutoload.php';

            $mail = new PHPMailer;
            $mail->isSMTP();

            /*
             * Server Configuration
             */

            $mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
            $mail->Port = 587; // Which port to use, 587 is the default port for TLS security.
            $mail->SMTPSecure = 'tls'; // Which security method to use. TLS is most secure.
            $mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
            $mail->Username = "email"; // Your Gmail address.
            $mail->Password = "email password"; // Your Gmail login password or App Specific Password.

            /*
             * Message Configuration
             */

            $mail->setFrom('sender email', 'Awesome Website'); // Set the sender of the message.
            $mail->addAddress($sub_email, $sub_name); // Set the recipient of the message.
            $mail->Subject = 'PHPMailer GMail SMTP test22'; // The subject of the message.

            /*
             * Message Content - Choose simple text or HTML email
             */

// Choose to send either a simple text email...
            // Choose to send either a simple text email...
$mail->Body = "


Hello dear <b style='color:blue;'>$sub_name</b>
 We have a new post for you to read ,
 $body_len   
    <a href=' http://localhost/blogCMS/single.php?posts=$id'>Click here</a> for full tory
   
    Thank you for your order @ - https://ecommerse-stage.000webhostapp.com 
   


"; // Set a plain text body.

// ... or send an email with HTML.
// $mail->msgHTML(file_get_contents('contents.html'));
// Optional when using HTML: Set an alternative plain text message for email clients who prefer that.
// $mail->AltBody = 
// ;

// Optional: attach a file
$mail->addAttachment('images/phpmailer_mini.png');

if ($mail->send()) {
    echo "Your message was sent successfully!";
} else {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
                }
            }
        }

    }
}




function Admin_post_view(){
    global $connection;
    $sql="SELECT * FROM posts";   //$psql="SELECT * FROM posts LIMIT 0,2";

    $results_per_page=5;
    //working limits
    //page 1,5 results per/page,LIMIT 0,5 ie start from 1 to first 5
    //page 2,5 results per/page,LIMIT 5,5 ie start from 5 to next 5
    //page 3,5 results per/page,LIMIT 10,5
    //etc
    //algorithm     starting_limit_number=(page_number -1)*number_of_results_per_page
    $result=mysqli_query($connection,$sql);

    $number_of_results=mysqli_num_rows($result);
//    if($result_psql->num_rows >0){

        //determine number of total pages available
       $number_of_pages=ceil($number_of_results/$results_per_page);

        //determine which page number visitor is currently on
        if(!isset($_GET['page'])){
            $page= 1;
        }else{
            $page=$_GET['page'];
        }
//DETERMINE THE SQL LIMIT starting number for the results on the display page
         $this_page_first_result=($page-1)*$results_per_page;

//sql query to get the items of each page
    global $connection;
    $sql="SELECT * FROM posts LIMIT ".$this_page_first_result. ',' .$results_per_page;
    $result=mysqli_query($connection,$sql);


        while($rows= mysqli_fetch_array($result)){

            echo "<div class='jumbotron' style='background-color:'whitesmoke'>";
            echo "<p class='blog-post-meta'>".$rows['date']."</p>";echo "<a href='#'>".$rows['author']."</a><br>";
            echo "<p class='blog-post-meta'>".$rows['title']."</p>";
            $body=$rows['body'];
            $body_len=substr($body,0,100);//length of words to display
            echo $body_len."...";
            $post_id=$rows['post_id'];

            echo "<br>";
            echo "<a href='edit.php?posts=".$post_id."' class='btn btn-primary'>UPDATE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "<a href='delete.php?posts=".$post_id."'  onclick='return confirm('Are you sure ?)' class='btn btn-danger'>DELETE</a>";
            echo "<br>";
            echo "<br>";
            echo "<hr>";
            echo "</div>";

        }

        //displaying page links numbers
for($page=1; $page<=$number_of_pages ; $page++){
    echo "<ul class='pagination '>
 <li><a href='index.php?page=".$page."'>".$page."</a></li></ul>";


}


}


?>

<?php
function search_result()
{
    if (isset($_GET['search'])) { //if we are not looking  to get categories run the code below

        $user_search=$_GET['search_query'];

        global $connection;

        $get_post= "SELECT * FROM posts WHERE keyword like '%$user_search%'";//displaying search posts like keywords

        $run_post = mysqli_query($connection, $get_post);
        if ($run_post->num_rows > 0) {

            while ($rows= mysqli_fetch_array($run_post)) {


                echo "<div class='jumbotron' style='background-color:'whitesmoke'>";
                echo "<p class='blog-post-meta'>".$rows['date']."</p>";echo "<a href='#'>".$rows['author']."</a><br>";
                echo "<p class='blog-post-meta'>".$rows['title']."</p>";
                $body=$rows['body'];
                $body_len=substr($body,0,100);//length of words to display
                echo $body_len."...";
                $post_id=$rows['post_id'];

                echo "<br>";
                echo "<a href='edit.php?posts=".$post_id."' class='btn btn-primary'>UPDATE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<a href='delete.php?posts=".$post_id."'  onclick='return confirm('Are you sure ?)' class='btn btn-danger'>DELETE</a>";
                echo "<br>";
                echo "<br>";
                echo "<hr>";
                echo "</div>";

            }
        } else {
            echo "<div class='jumbotron' style='background-color:'white'>";
            echo "<h2 class='error' >Ooops your search dosen't match any description try another format</h2>";
            echo "</div>";
        }
    }
}



?>

<?php
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
$c_id=$rows['comment_id'];
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
        <?php
        echo "<a href='delete_comments.php?comments=".$c_id."'  onclick='return confirm('Are you sure ?)' class='btn btn-danger'>DELETE COMMENT</a>";
        ?>
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
                    <button class=" btn btn-sm btn-primary" type="button"  id="dropdownMenuButton"   style="float: right;" href='filter_replies.php?replies=<?php echo htmlspecialchars(urlencode($c_id)); ?>&posts=<?php echo htmlspecialchars(urlencode($id)); ?>'  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<!--                <button class=" btn btn-sm btn-danger"  name="delete_replies" style="float: right;" href='delete_replies.php?replies=--><?php //echo urlencode($r_id); ?><!--' >-->
<!--                    Delete Replies-->
<!--                </button>-->
<!--                --><?php
            echo "<a href='delete_replies.php?replies=".$r_id."'  onclick='return confirm('Are you sure ?)' class='btn btn-danger'>DELETE</a>";
            ?>
                <br>

                <hr>
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
        $comment_sql = "INSERT INTO replies (comment_id,name,email,body,created_at) VALUES ('{$comment_id}','{$name}','{$email}','{$body}',NOW())";//original

        $result_comment_sql = mysqli_query($connection, $comment_sql);
        if ($result_comment_sql) {
            echo "<script>alert('Comment updated')</script>";
            echo "<script>window.open('filter_replies.php?posts='.urlencode($id).'','_self')</script>";
        } else {
            echo "<script>alert('commented error')</script>";
        }
    }

}
?>

<?php
function all_subcribers()
{
    global $connection;

    if (isset($_POST['subscribers'])) {

        $all_subscribers = "SELECT * FROM subscribers ORDER BY id ASC";
        $result_all_subscribers = mysqli_query($connection, $all_subscribers);
        if ($result_all_subscribers->num_rows > 0) {
            while ($rows = mysqli_fetch_assoc($result_all_subscribers)) {
                $names = $rows['name'];
                ?>
                <ol>
                    <?php echo $rows['id'];?>.&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $names;?>
                </ol>
                <?php
            }
        }

    } else {
//        <!--        Outputting first five latest subscribers-->
        $first_five_subscribers_sql = "SELECT * FROM `subscribers` ORDER BY id DESC LIMIT 0,5";
        $result_first_five_subscribers_sql = mysqli_query($connection, $first_five_subscribers_sql);
        if ($result_first_five_subscribers_sql->num_rows > 0) {
            echo "<th>Latest Subscribers</th>";
            while ($rows = mysqli_fetch_assoc($result_first_five_subscribers_sql)) {
                ?>
                <table class="table table-active">
                    <tr>
                        <td><?php echo $rows['name']; ?></td>
                        <td style="float:right"><?php echo $rows['email']; ?></td>
                    </tr>
                </table>

                <?php
            }
        }

    }
//    <!--        Outputting first five latest subscribers-->
}
?>
