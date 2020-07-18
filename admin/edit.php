<?php require_once("includes/session.php");?>
<?php confirm_logged_in();?>
<?php include("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<?php
//select and echo previous value query
if(isset($_GET['posts'])) {
    $id = $_GET['posts'];
    $psql = "SELECT posts.* FROM posts WHERE posts.post_id={$id}";
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

//update query
if (isset($_POST['update'])) {
    $update_id = $id;
    $title = $_POST['title'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $body = $_POST['body'];
    $author = $_POST['author'];
    $keyword = $_POST['keyword'];

    $usql = "UPDATE posts SET title='{$title}',category='{$category}', date='{$date}',body='{$body}', author='{$author}', keyword='{$keyword}' WHERE post_id='$update_id'";
    $result_usql = mysqli_query($connection, $usql);
    if ($result_usql) {
       page_redirect('index.php?message=success');
        //$smessage="Successfully Updated";

    } else {
        page_redirect('index.php?message=Error');

        //$Emessage=" Unable to Update";
    }
}


?>

         <div class="blog-header">
				
                <h1 class="blog-title">NEW BLOG</h1>
            </div>
<div class="new_blog">

<?php
//ALERT MESSAGES USING URL STRPOS
//                                $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//                                if(strpos($fullUrl,"message=Error")== TRUE){
//
//                                    echo "  <div id=\"ealert\" class=\"alert alert-danger \">
//                 <a  id=\"linkClose\" href=\"#\" class=\"close\" >&times;</a>
//                        <strong>Error!</strong> Something went wrong
//                    </div>";
//
//                                }
//                                elseif(strpos($fullUrl,"message=success")== TRUE){
//
//                                    echo "<div id='salert' class='alert alert-success' >
//    <a  id='linkClose' href='#' class='close'>&times;</a>Uploaded</div>";
//
//                                }

                               ?>

<!--	--><?php
//	if(!empty($smessage)){
//		echo "<p class='alert alert-success>".$smessage."</p>";
//
//
//	}elseif(!empty($emessage)){
//		echo "<p class='alert alert-danger>".$emessage."</p>";
//	}
//	?>
	
	<form method="POST" action="">

<div>
		<b>TITLE:
			<input type="text" class="form-control" name="title" placeholder="Blog Title" value="<?php echo $title ; ?>"/>
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
                                        if($category== $count){
                                            echo " selected";//space selected tells html the option has been picked
                                        }
                                        $rows=mysqli_fetch_assoc($categories);
                                            echo ">{$rows['cat_title']}</option>";


                                    }
                                       ?>
                                    </select>
                                    </b>
							</div>

		<div class="form-group">
		<b>DATE:
			<input type="text" class="form-control" name="date" placeholder="format-:November 27,2007" value="<?php echo $date ; ?> "/>
			</b>
		</div>
		
		<div class="form-group">
		<b>BODY:
			<textarea cols="66" rows="10" class="form-control" name="body" placeholder="Your full story" value=" " ><?php echo $body ; ?></textarea>
			</b>
		</div>
			<div class="form-group">
		<b>AUTHOR:
			<input type="text" class="form-control" name="author" placeholder="Writters name" value="<?php echo $author ; ?>" >
			</b>
		</div>
		
			<div class="form-group">
		<b>keyword:
			<input type="text" class="form-control" name="keyword" placeholder="something unique to ease searching" value="<?php echo $keyword ; ?>" >
			</b>
		</div>

        <button type="submit"  name="update" class="btn btn-primary" value="edit subject">Update Post</button>
        <a href="index.php" class="btn btn-info">Cancel</a>
	</form>



</div>
<br>
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


