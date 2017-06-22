<?php require('includes/connection.php'); ?>
<?php
unset($_SESSION['POST']);
session_destroy();
if($_SERVER["REQUEST_METHOD"] == "POST") {
   // username and password sent from form
   session_start();

   $myusername = $_POST['username'];
   $mypassword = $_POST['password'];
   $sql = "SELECT login('$myusername','$mypassword') as userid";

   // If result matched $myusername and $mypassword, table row must be 1 row
   $result = $conn->query($sql);

    if($result->num_rows == 1)
        while($row = $result->fetch_assoc())
            if ($row['userid'] != NULL) {
                $_POST['userid'] = $row['userid'];
                $local_sql = "SELECT * from users where user_id=" . $row['userid'];
                $local_result = $conn->query($local_sql);
                if($local_result->num_rows == 1)
                    while($local_row = $local_result->fetch_assoc())
                        if ($local_row['user_id'] != NULL) {
                            $_POST['role'] = $local_row['user_role'];
                            $_POST['fname'] = $local_row['user_firstname'];
                        }
                $_SESSION['POST'] = $_POST;
                header('Location:profile.php?user_id='.$row['userid']);
            }
            else
                $message = "Username or Password is Invalid. Try Again.";
}
?>

<?php require('includes/header.php'); ?>
<div class="row">

    <div class="col-xs-8">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="assets/images/interst.jpg" alt="...">
      <div class="carousel-caption">
        <h3>Read Reviews</h3>
        <p>Browse movies and read reviews.</p>
      </div>
    </div>
    <div class="item">
      <img src="assets/images/star-wars.jpg" alt="...">
      <div class="carousel-caption">
        <h3>Follow Critics</h3>
        <p>Sign Up to follow your favorite Critics.</p>
      </div>
    </div>
    <div class="item">
      <img src="assets/images/star-trek.jpg" alt="...">
      <div class="carousel-caption">
        <h3>Buy Movie Tickets</h3>
        <p>Login to Buy Tickets for movies!</p>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
    <div class="col-xs-4">

        <?php if(isset($message) && $message != NULL) { ?>
            <div class="alert alert-danger">
                <?=$message?>
            </div>
        <?php }?>

        <!-- <form action="" class="form-signin" method="post">
        <h2 class="form-signin-heading">Sign In</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="password" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form> -->

        <!-- <button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#signIn">
          Sign In
        </button> -->

        <?php include("includes/about.php"); ?>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="signInLabel">Sign In</h4>
                    </div>
                    <div class="modal-body">
                        <label for="username" class="sr-only">Username</label>
                        <input type="text" id="username" name="username" class="form-control input-lg" placeholder="username" required autofocus>
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control input-lg" placeholder="password" required autofocus>
                        <!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-lg" type="submit">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div> <!-- /container -->


<?php require('includes/footer.php'); ?>
