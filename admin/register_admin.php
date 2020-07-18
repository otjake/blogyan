<?php require_once("includes/session.php");?>
<?php confirm_logged_in();?>
<?php include("includes/functions.php"); ?>
<?php $category='register_admin';include("includes/header.php"); ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Register'])) {
        $username=$fullname=$email="";
        $nameErr=$fnameErr=$emailErr="";

$password = $_POST['password'];
$hashed_password = md5($password);
        if(empty($_POST["user_name"])){
            $nameErr="Name is Required";
        }else {
            $username = inputtype($_POST["user_name"]);
            // check if name is valid
            if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
                $nameErr = "Only letters and white space allowed";
            }
            else{
    $cusername=$username;
}

        }
        if(empty($_POST["email"])){
            $emailErr="enter a valid email address";
        }

        else
        {
            $email=inputtype($_POST["email"]);
            // check if email syntax is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailErr="enter a valid email address";}

            else{
                $cemail=$email;
            }
        }

        if(empty($_POST["fullname"])){
            $fnameErr="Fullname is Required";
        }else {
            $fullname = inputtype($_POST["fullname"]);
            // check if name is valid
            if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
                $fnameErr = "Only letters and white space allowed";
            }else{
                $cfullname=$fullname;
            }

        }
if($nameErr!="" || $emailErr!="" || $fnameErr!=""){
    $Emessage="Registration failed! Some inputs were filled wrong ";
}
else {
    $rsql = "INSERT INTO admin (fullname,email,user_name,hashed_password,date_created) VALUES ('{$cfullname}','{$cemail}','{$cusername}','{$hashed_password}',NOW())";
    $rsql_result = $connection->query($rsql);

    if ($rsql) {
        $Smessage = "successfully created";

}


}

        }
    }




?>

<div class="blog-header">

    <h3 class="blog-title">REGISTER NEW ADMINISTRATOR</h3>
</div>
<div class="new_blog">

<!--    --><?php
//    //ALERT MESSAGES USING URL STRPOS
//    $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//    if(strpos($fullUrl,"message=error")== TRUE){
//
//        echo "  <div id=\"ealert\" class=\"alert alert-danger \">
//                 <a  id=\"linkClose\" href=\"#\" class=\"close\" >&times;</a>
//                        <strong>Error!</strong> Something went wrong
//                    </div>";
//
//    }
//    elseif(strpos($fullUrl,"message=success")== TRUE){
//
//        echo "<div id='salert' class='alert alert-success' >
//    <a  id='linkClose' href='#' class='close'>&times;</a>Uploaded</div>";
//
//    }
//
//    ?>



    <?php
    //	if(!empty($message)){
    //		echo "<p class='alert alert-success>".$message."</p>";
    //
    //
    //	}elseif(!empty($emessage)){
    //		echo "<p class='alert alert-danger>".$emessage."</p>";
//    	}
    ?>

    <form method="POST" action="register_admin.php">
        <div class="form-group">
            <b>FULL NAME
                <input type="text" class="form-control" required name="fullname" placeholder="FULL NAME"/>
            </b>
            <?php
            if(!empty($fnameErr)){
                echo "<p class='alert alert-danger'>".$fnameErr."</p>";
            }?>
        </div>

        <div class="form-group">
            <b>E-MAIL
                <input type="email" class="form-control" required name="email" placeholder="E-MAIL"/>
            </b>
            <?php
            if(!empty($emailErr)){
                echo "<p class='alert alert-danger'>".$emailErr."</p>";
            }?>
        </div>
        <!--        NEW BLOG FORM-->


        <div class="form-group">
            <b>USER NAME:
                <input type="text" class="form-control" required name="user_name" placeholder="USER NAME" />
            </b>
            <?php
            if(!empty($nameErr)){
                echo "<p class='alert alert-danger'>".$nameErr."</p>";
            }?>
        </div>

        <div class="form-group">
            <b>Password:
                <input type="password" class="form-control" name="password" placeholder="Prefered Password "/>
            </b>
        </div>
<!--        <div class="form-group">-->
<!--            <b>DATE:-->
<!--                <input type="date" class="form-control"  name="date" placeholder="USER NAME" />-->
<!--            </b>-->
<!--        </div>-->
        <button type="submit" id="Register" name="Register" class="btn btn-primary">Register Admin</button> <a href="Admin_login.php"   class="btn btn-primary">Login</a>
        <?php
        if(!empty($Emessage)){
            echo "<p class='alert alert-danger'>".$Emessage."</p>";
        }
        if(!empty($Smessage)){
            echo "<p class='alert alert-success'>".$Smessage."</p>";
        }
        ?>
    </form>


</div>
<br>
<br>
<br>
<!--        NEW BLOG FORM-->

<!--BLOGS-->

<div >


</div>
<!--BLOGS-->
<br>
<br>




</div><!-- /.blog-main -->
<script>
    $(document).ready(function(){
//jquery function to show alert using the submit button
        $('#upload').click(function(){
            $('#ealert').show('fade');

//jquery function to close alert within 2 seconds
            setTimeout(function(){
                $('#ealert').hide('fade');
            },2000);
        });
//jquery function to close alert using the cross button
        $('#linkClose').click(function(){
            $('#ealert').hide('fade');
        });
    });


    $(document).ready(function(){
//jquery function to show alert using the submit button
        $('#upload').click(function(){
            $('#alert').show('fade');

//jquery function to close alert within 2 seconds
            setTimeout(function(){
                $('#salert').hide('fade');
            },2000);
        });
//jquery function to close alert using the cross button
        $('#linkClose').click(function(){
            $('#salert').hide('fade');
        });
    });
</script>

<?php include("includes/sidebar.php");?>
<?php include("includes/footer.php");?>



