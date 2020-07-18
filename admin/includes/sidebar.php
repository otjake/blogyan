<div class="col-sm-3 col-sm-offset-1 blog-sidebar" style="margin-top: 150px;">
    <div class="sidebar-module">
        <h4>Search</h4>
        <hr>
        <form method="GET" action="result.php" class="form-inline">
            <div class="form-group">
                <input type="text" name="search_query" class="form-control" id="exampleInputName2" placeholder="search">
            </div>
<br>
<br>
            <div class="form-group">
                <button type="submit" name="search" class="form-control btn btn-primary btn-sm" >Search</button>
            </div>

        </form>

    </div>
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <hr>
        <p>GOAT blog<em>Our tag</em> We are a body bringing unfiltered and unthethered news to the people and also how we feel for day to day world activities.</p>
    </div>


    <div class="sidebar-module sidebar-module-inset">
        <h4>Adverts</h4>
        <hr>
        <p>Advert placements.</p>
    </div>
    <div class="sidebar-module">
        <h4>Subscribers</h4>
        <hr>
<!--        Outputting subscribers-->

        <?php all_subcribers(); ?>

        <form method="POST">
            <button type="submit" class="btn btn-primary" name="subscribers" style="float: right;" >All Subscribers</button>
        </form>
        <!--        Outputting subscribers-->
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
            <li><a href="#">instagram</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>
</div><!-- /.blog-sidebar -->