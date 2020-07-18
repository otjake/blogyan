<?php include("includes/functions.php");?>
<?php include("includes/header.php");?>
<br>
<blockquote>Subscribe</blockquote>
<div class="blog-post">
    <?php
    subscribe_reg();
    ?>
    <form method="POST" action="subscribe.php">
        <?php
        if(!empty($Emessage)){
            echo "<p class='alert alert-danger'>".$Emessage."</p>";
        }?>
        <?php
        if(!empty($Smessage)){
            echo "<p class='alert alert-success'>".$Smessage."</p>";
        }?>
        <div class="form-group">
            <input class="form-control" name="name" placeholder="Name"/>
            <?php
            if(!empty($nameErr)){
                echo "<p class='alert alert-danger'>".$nameErr."</p>";
            }?>
        </div>
        <div class="form-group">
            <input class="form-control" name="email" placeholder="Email"/>
            <?php
            if(!empty($emailErr)){
                echo "<p class='alert alert-danger'>".$emailErr."</p>";
            }?>
        </div>

        <button type="submit" class="btn btn-primary" name="subscribe" >Subscribe</button>
    </form>

</div><!-- /.blog-post -->





</div><!-- /.blog-main -->

<?php include("includes/sidebar.php");?>
<?php include("includes/footer.php");?>
