<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DBMS</title>
        <!-- Latest compiled and minified CSS -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js">
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Overpass:200,400,400i,700,900" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">CS 5200</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if(isset($_SESSION['POST']) && $_SESSION['POST'] != NULL) { ?>
                        <li>
                            <a href="/cs5200/profile.php?user_id=<?=$userid?>">My Profile<span class="sr-only">(current)</span></a>
                        </li>
                    <?php } else { ?>
                        <li class="active">
                            <a href="/cs5200/index.php">Log In<span class="sr-only">(current)</span></a>
                        </li>
                    <?php } ?>
                    <li><a href="/cs5200/critic.php">Critics</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Movies<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a href="/cs5200/genre.php">Browse by Genres</a></li>
                        <li><a href="/cs5200/actor.php">Browse by Actors</a></li>
                        <li><a href="/cs5200/producer.php">Browse by Producer</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/cs5200/movie.php">Top Movies</a></li>
                        </ul>
                    </li>
                </ul>
                <form action="/cs5200/movie.php" method="post" class="navbar-form navbar-left">
                    <div class="form-group">
                        <input name="search" type="text" class="form-control" placeholder="Search Movies">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <?php if(isset($_SESSION['POST']) && $_SESSION['POST'] != NULL) { ?>
                <ul class="nav navbar-nav navbar-right">

                    <?php if($role=="Producer") { ?>

                        <div class="nav navbar-nav navbar-right navbar-form">

                            <a type="button" class="btn btn-success btn-sm"
                            href="/cs5200/add-movie.php">
                              Add Movie
                            </a>
                        </div>

                    <?php } else if($role=="Admin") {?>
                        <div class="nav navbar-nav navbar-form">
                            <a type="button" class="btn btn-warning btn-sm"
                            href="/cs5200/admin.php">
                              Admin
                            </a>
                        </div>
                    <?php } ?>

                    <!-- <li><a href="/cs5200/profile.php">Name</a></li> -->

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$fname?> <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="/cs5200/profile.php?user_id=<?=$userid?>">Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/cs5200/index.php">Log Out</a></li>
                      </ul>
                    </li>
                </ul>
                <?php } else { ?>
                    <div class="nav navbar-nav navbar-right navbar-form">

                        <a type="button" class="btn btn-success btn-sm"
                        data-toggle="modal" data-target="#signIn">
                          Sign In
                        </a>
                    </div>

                <?php } ?>
            </div>
        </div>
    </nav>

    <div id="primary" class="container">
