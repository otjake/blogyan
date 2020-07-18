<div class="col-sm-3 col-sm-offset-1 blog-sidebar" style="margin-top: 150px;">
    <div class="sidebar-module">
        <h4>Search</h4>
        <hr>
        <form method="GET" action="result.php" class="form-inline">
            <div class="form-group">
                <input type="text" name="user_search" class="form-control" id="exampleInputName2" placeholder="search">
            </div>
            <br>
            <br>
            <div class="form-group">
                <p><button type="submit" name="search" value="Search" class="btn btn-sm btn-info form-control">Search</button></p>
            </div>

        </form>

    </div>
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <hr>
        <p>GOAT blog<em>Our tag</em> We are a body bringing unfiltered and unthethered news to the people and also how we feel for day to day world activities.</p>
    </div>
    <div class="sidebar-module">
        <h4>Subscribe</h4>
        <hr>

        <form method="POST" action="">
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

    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>
        <hr>
        <ol class="list-unstyled">
            <li><a href="#">March 2014</a></li>
            <li><a href="#">February 2014</a></li>
            <li><a href="#">January 2014</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Follow us on</h4>
        <hr>
        <ol class="list-unstyled">
            <li><a href="https://www.instagram.com/ot_jake"><i class="fab fa-instagram fa-5x"></i></a></li>
            <li><a href="https://twitter.com/sylvar35"><i class="fab fa-twitter fa-5x"></i></a></li>
            <li><a href="https://api.whatsapp.com/send?phone=+2348179030542"><i class="fab fa-whatsapp fa-5x"></i></a></li>
        </ol>
    </div>
</div><!-- /.blog-sidebar -->