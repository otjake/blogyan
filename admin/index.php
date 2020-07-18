<?php require_once("includes/session.php");?>
<?php confirm_logged_in();?>

<?php include("includes/functions.php"); ?>
<?php $category='posts';include("includes/header.php"); ?>
<?php
Admin_blog_upload_form();

?>

         <div class="blog-header">
				
            <strong><h1 class="blog-title">WELCOME <?php echo $_SESSION['fullname']; ?></h1></strong>
             <br>
             <h1 class="blog-title"> ADD A NEW BLOG HERE</h1>
            </div>
<div class="new_blog">

<?php
if(!empty($Smessage)){
    echo "<p class='alert alert-success'> $Smessage </p>";
}
if(!empty($Emessage)){
    echo "<p class='alert alert-danger'> $Emessage </p>";
}
if(!empty($Emmessage)){
    echo "<p class='alert alert-danger'> $Emmessage </p>";
}

	?>
	
	<form method="POST" action="index.php">
		<div class="form-group">
		<b>TITLE:
			<input type="text" class="form-control" name="title" placeholder="Blog Title"/>
			</b>
		</div>
		
		<div class="form-group">						
                                <b>Category:
								<select name="category">
                                    <?php
                                    //getting all subjects
                                    $categories= get_all_categories();
                                    //counting the rows
                                     $categories_count=mysqli_num_rows($categories);
                                    //$subject_count+1 because we are adding one more row/subject
                                    for($count=1 ;$count<= $categories_count ;$count++){

                                        echo "<option value=\"{$count}\"";
                                        $rows=mysqli_fetch_assoc($categories);
                                        echo ">{$rows['cat_title']}</option>";
                                    }
                                       ?>
                                    </select>
                                    </b>
							</div>
<!--        NEW BLOG FORM-->
		<div class="form-group">
		<b>DATE:
			<input type="text" class="form-control" name="date" placeholder="format-:27 november,2007"/>
			</b>
		</div>
		
		<div class="form-group">
		<b>BODY:
			<textarea cols="66" rows="10" class="form-control" name="body" placeholder="Your full story"></textarea>
			</b>
		</div>
			<div class="form-group" hidden>
		<b>AUTHOR:
			<input type="text" class="form-control" name="author" value="<?php echo $_SESSION['fullname']; ?>">
			</b>
		</div>
		
			<div class="form-group">
		<b>keyword:
			<input type="text" class="form-control" name="keyword" placeholder="something unique to ease searching">
			</b>
		</div>
		<button type="submit" id="upload" name="upload" class="btn btn-primary">Upload Post</button>
	</form>


</div>
<br>
<br>
<br>
<!--        NEW BLOG FORM-->

<!--BLOGS-->

<div >

<?php
//ALERT MESSAGES USING URL STRPOS
                                $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                if(strpos($fullUrl,"dmessage=error")== TRUE){

                                    echo "  <div id=\"ealert\" class=\"alert alert-danger \">
                 <a  id=\"linkClose\" href=\"#\" class=\"close\" >&times;</a>
                        <strong>Error!</strong> Something went wrong
                    </div>";

                                }
                                elseif(strpos($fullUrl,"dmessage=correct")== TRUE){

                                    echo "<div id='salert' class='alert alert-success' >
    <a  id='linkClose' href='#' class='close'>&times;</a>DELETED</div>";

                                }




    Admin_post_view();
                                ?>
</div>
<!--BLOGS-->
<br>
<br>
<!--<nav>-->
<!--    <ul class="pager">-->
<!--        <li><a href="#">Previous</a></li>-->
<!--        <li><a href="#">Next</a></li>-->
<!--    </ul>-->
<!--</nav>-->




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


