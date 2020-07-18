
<?php include("includes/db.php"); ?>
<?php require_once('includes/session.php'); ?>
<?php include("includes/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="all" href="css/login_style.css">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script src="includes/jquery-3.4.1.js"></script>


</head>
<?php
//if( logged_in()) {
//    page_redirect('staff_index.php');
//    //checks if user is already logged in if yes,redirects staff_index
//}

if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['login'])) {
        $username=$password =  "";
        $hashed_password = "";
        $nameErr=$passErr="";


        if (empty($_POST["user_name"])) {
            $nameErr = "Name is Required";
        } else {
            $username = inputtype($_POST["user_name"]);
            // check if name is valid
            if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
                $nameErr = "Only letters and white space allowed";
            } else {
                $cusername = $username;
            }

            if (empty($_POST["password"])) {
                $passErr = "password is Required";
            } else {
                $password = inputtype($_POST["password"]);
                $hashed_password = md5($password);
            }

            if ($nameErr!= "" || $passErr!= "") {
                $Emessage = "Invalid Details";
            } else {
             echo   $rsql = "SELECT * FROM admin WHERE  user_name='{$cusername}' AND hashed_password='{$hashed_password}'";
                $result = mysqli_query($connection, $rsql);
                var_dump($result);
                if ($result->num_rows > 0) {
                    $found_user = mysqli_fetch_array($result);
                    $_SESSION['user_id'] = $found_user['id'];
                    $_SESSION['username'] = $found_user['user_name'];
                    $_SESSION['fullname'] = $found_user['fullname'];
                    $_SESSION['email'] = $found_user['email'];

                    page_redirect('index.php');

                }

            }
        }

    }
}
else{
    //getting a value from logout to display message in the event user logs out
    if(isset($_GET['logout']) && $_GET['logout']==1 ){
        $Lmessage="You have been logged out";
    }
}
?>
<body class="body" >

        <div  class=" col-4 offset-4 form-placement">
            <hr>
            <?php
            if(!empty($Lmessage)){
                echo "<p class='alert alert-danger'>".$Lmessage."</p>";
            }?>
            <form method="POST" action="Admin_login.php" >
               <div class="form-group">
                   <label>USER NAME</label>
                   <input type="text" name="user_name" class="form-control" required  placeholder="Enter user name"/>
                   <?php
                   if(!empty($nameErr)){
                       echo "<p class='alert alert-danger'>".$nameErr."</p>";
                   }?>
               </div>


                <div class="form-group">
                    <label>PASSWORD</label>
                    <input type="password" name="password" class="form-control" required  placeholder="Enter password"/>
                    <?php
                    if(!empty($passErr)){
                        echo "<p class='alert alert-danger'>".$passErr."</p>";
                    }?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg" name="login">Login</button>
                </div>
            </form>

            <hr>
        </div>


    <!--<footer class="blog-footer">-->
    <!---->
    <!--    <p>-->
    <!--        <a href="#">Back to top</a>-->
    <!--    </p>-->
    <!--</footer>-->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script src="" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>-->
<script src="includes/jquery-3.4.1.js"></script>
<script>if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);

    }</script>
<!--<script src="bootstrap/js/bootstrap.js"></script>-->
<!--<script src="bootstrap/js/bootstrap.min.js"></script>-->

<script src="bootstrap/jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>