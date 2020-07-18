<?php require_once("includes/session.php");?>
<?php confirm_logged_in();?>
<?php include("includes/functions.php");?>
<?php include("includes/header.php");?>
<br>
<blockquote>Search Result</blockquote>
<div class="blog-post">
    <?php search_result(); ?>
</div><!-- /.blog-post -->





</div><!-- /.blog-main -->

<?php include("includes/sidebar.php");?>
<?php include("includes/footer.php");?>
