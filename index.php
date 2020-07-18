<?php include("includes/header.php");?>
<?php include("includes/functions.php");?>
<?php subscribe_reg();?>
<?php

if(isset($_GET['category'])){//checking if a category is selected so it could display
$category=mysqli_real_escape_string($connection,$_GET['category']);	
	$psql="SELECT * FROM posts WHERE category='$category'";
}else{
$psql="SELECT * FROM posts";
}
$result_psql=mysqli_query($connection,$psql);
?>
            <div class="blog-header">
				
                <h1 class="blog-title">BlogCMS</h1>
                <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
            </div>

            <div class="blog-post">
				<?php
				if($result_psql->num_rows > 0){
					while($post_rows=mysqli_fetch_array($result_psql)){
              echo  "<a href='single.php?posts=".urlencode($post_rows['post_id'])."' class='blog-post-title'>".$post_rows['title']."</a>";
				
                echo "<p class='blog-post-meta'>".$post_rows['date']."</p>";echo "<a href='#'>".$post_rows['author']."</a><br>";
						$body=$post_rows['body'];
						$body_len=substr($body,0,100);//length of words to display
					echo $body_len."...";
       
         echo "<a href='single.php?posts=".urlencode($post_rows['post_id'])."' class='btn btn-primary'>Read more....</a>";
						echo "<br>";
						echo "<br>";
						echo "<hr>";
					}
				}
					?>

            </div><!-- /.blog-post -->

<!--
            <div class="blog-post">
                <h2 class="blog-post-title">Another blog post</h2>
                <p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>

                <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                <blockquote>
                    <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                </blockquote>
                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <a href="#" class="btn btn-primary">Read more....</a>
            </div> /.blog-post 
-->

<!--
            <div class="blog-post">
                <h2 class="blog-post-title">New feature</h2>
                <p class="blog-post-meta">December 14, 2013 by <a href="#">Chris</a></p>

                <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <ul>
                    <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
                    <li>Donec id elit non mi porta gravida at eget metus.</li>
                    <li>Nulla vitae elit libero, a pharetra augue.</li>
                </ul>
                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
                <a href="#" class="btn btn-primary">Read more....</a>
            </div> /.blog-post 
-->

<!--<nav>-->
<!--    <ul class="pager">-->
<!--        <li><a href="#">Previous</a></li>-->
<!--        <li><a href="#">Next</a></li>-->
<!--    </ul>-->
<!--</nav>-->




        </div><!-- /.blog-main -->

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php");?>
