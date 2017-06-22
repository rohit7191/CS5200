<?php

    $sql = "select * from movies where movie_id =".$_GET['movie_id'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) { ?>

            <div class=jumbotron>
                <h1><?=$row["movie_name"]?></h1>
                <p><?=$row["movie_description"]?></p>
                <p class="btn btn-warning">Rating: <?=$row["movie_rating"]?></p>
                <?php if($role == "Fan") {
                    $hasFavSql = "select count(*) as counted from favorites where favorite_id =".$_GET['movie_id']." and user_id =".$userid;
                    $hasFavRes = $conn->query($hasFavSql);
                    if ($hasFavRes->num_rows > 0) {
                        while($hasFavRow = $hasFavRes->fetch_assoc()) {
                            if($hasFavRow["counted"] == 0) {?>
                <form class="" action="" method="post">
                    <button type="submit" name="favorite" value="true" class="btn btn-danger btn-lg glyphicon glyphicon-heart"></button>
                </form>
                <?php }
            }
        }
    } ?>
                <?php if ($role=="Fan") {
                    $hasRatedSql = "select count(*) as counted from user_ratings where movie_id =".$_GET['movie_id']." and fan_id =".$userid;
                    $hasRatedRes = $conn->query($hasRatedSql);
                    if ($hasRatedRes->num_rows > 0) {
                        while($hasRatedRow = $hasRatedRes->fetch_assoc()) {
                            if($hasRatedRow["counted"] == 0) {
                    ?>

                <p>
                    <form class="" action="" method="post">
                        <input type="number" id="user_id" name="user_id" class="form-control input-lg sr-only" required value=<?=$userid?>>
                        <input type="number" id="movie_id" name="movie_id" class="form-control input-lg sr-only" required value=<?=$row['movie_id']?>>
                        <label class="radio-inline">
                            <input type="radio" name="rating" id="rating1" value="1"> 1
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rating" id="rating2" value="2"> 2
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rating" id="rating3" value="3"> 3
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rating" id="rating4" value="4"> 4
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rating" id="rating5" value="5"> 5
                        </label>
                        <button type="submit" class='btn btn-primary btn-sm'>Rate Movie</button>
                    </form>

                </p>
                <?php }
            }
        }
    } ?>
            </div>
            <!-- producer -->
            <div class="row">
                <div class="col-xs-6">
                    <?php if ($role=="Fan") { ?>
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Showtimes</div>
                        <div class="panel-body">
                        <p>Buy tickets to this movie.</p>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Theatre Name</th>
                                    <th>Showtime</th>
                                    <th>Seats Available</th>
                                    <th>Cost/Ticket</th>
                                    <th>Buy</th>
                                </tr>
                            </thead>
                            <tdata>
                        <?php
                        $showtimes_sql = "select mt.movie_theatre_index, b.theatre_name, c.showtime, mt.seats_available, mt.cost_per_ticket
	 	from movies a inner join movietheatre mt
		 	on a.movie_id = mt.movie_id
            inner join theatre b
				on mt.theatre_id = b.theatre_id
			inner join time_info c
				on mt.showtime_id = c.showtime_id
         where mt.seats_available != 0
         	and a.movie_id =".$row['movie_id'];
                        $showtimes = $conn->query($showtimes_sql);
                        if ($showtimes->num_rows > 0) {
                            while($s = $showtimes->fetch_assoc()) { ?>
                                <tr>
                                    <td><?=$s["theatre_name"]?></td>
                                    <td><?=$s["showtime"]?></td>
                                    <td><?=$s["seats_available"]?></td>
                                    <td><?=$s["cost_per_ticket"]?></td>
                                    <td>
                                        <a type="button" class="btn btn-success btn-xs"
                                        data-toggle="modal" data-target="#buy<?=$s["movie_theatre_index"]?>">
                                          Buy Now
                                        </a>
                                    </td>

                                    <?php include("includes/buy-ticket.php"); ?>
                                </tr>
                        <?php }
                    } else {
                        echo "<tr><td><p class=lead>No Shotimes Available</p></td></tr>";
                    }?>
                </tdata>
            </table>
                    </div>
                    <?php } ?>
                    <?php if ($role=="Critic") {

                        $findCriticReview = "select count(*) as counted from review where critic_id='$userid' and movie_id=".$row['movie_id'];
                        $findCriticResult = $conn->query($findCriticReview);
                        if ($findCriticResult->num_rows > 0) {
                            // output data of each row
                            while($findCriticReviewRow = $findCriticResult->fetch_assoc()) {
                                if ($findCriticReviewRow["counted"] != 0) {
                                    echo "You've already reviewed";
                                } else { ?>

                                    <form class="" action="" method="post">
                                        <input class="sr-only" type="number" name="movie_id" value="<?=$row['movie_id']?>">
                                        <input class="sr-only" type="number" name="user_id" value="<?=$userid?>">
                                        <input type="text" class="form-control" placeholder="Title" name="title" maxlength="10">
                                        <textarea name="review" id="review" class="form-control" rows="3"></textarea>
                                        <button type="submit" class="btn btn-default">Submit Review</button>
                                    </form>

                                <?php }
                            }
                        } else {
                            echo "3erhjf";
                        }
                    }
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Reviews</h3>
                            </div>
                            <div class="panel-body">
                    <?php
                        $findAllReviews =  "select * from review where movie_id=".$row['movie_id'];
                        $getAllReviews = $conn->query($findAllReviews);

                        if ($getAllReviews->num_rows > 0) {
                            // output data of each row
                            while($aReview = $getAllReviews->fetch_assoc()) {
                                $whoCommented = "select * from users where user_id=".$aReview['critic_id'];
                                $whoCommentedRes = $conn->query($whoCommented);
                                if ($whoCommentedRes->num_rows == 1) {
                                    while($aCritic = $whoCommentedRes->fetch_assoc()) {
                                        $reviewer_name = $aCritic["user_firstname"] . " " . $aCritic["user_lastname"];
                                    }
                                } else {
                                    echo "user ";
                                }
                                ?>

                                    <div class="well media">
                                        <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="/cs5200/profile.php?user_id=<?=$aReview['critic_id']?>">
                                            <?=$reviewer_name?></a> said <?=$aReview["title"]?>
                                        </h4>
                                        <p>
                                            <?=$aReview["description"]?>
                                        </p>
                                      </div>

                                    </div>

                                <?php }
                            }

                    ?>
                </div>
            </div>



                </div>

                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Producer</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            $sql = "select * from users where user_id =".$row['producer_id'];
                            $producers = $conn->query($sql);
                            if ($producers->num_rows == 1) {
                                while($p = $producers->fetch_assoc()) { ?>
                                    <h3>
                                    <a href="/cs5200/profile.php?user_id=<?=$p['user_id']?>"><?=$p['user_firstname']?> <?=$p['user_lastname']?></a>
                                    <small>
                                        <a class="btn btn-primary pull-right" href="/cs5200/producer.php?producer=<?=$p['user_id']?>">All Movies by <?=$p['user_firstname']?></a>
                                    </small>
                                    </h3>
                            <?php }
                            }?>
                        </div>
                    </div>

                    <!-- starcast -->
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Cast</div>
                        <div class="panel-body">
                        <p>Click on a name to see actor profile.</p>
                        </div>
                        <ul class="list-group">
                            <?php
                            $sql = "call show_starcast(".$row['movie_id'].")";
                            $actors = $conn->query($sql);
                            if ($actors->num_rows > 0) {
                                while($a = $actors->fetch_assoc()) { ?>
                                    <li class="list-group-item">
                                        <a href="/cs5200/actor.php?actor=<?=$a['starcast_id']?>"><?=$a['starcast_firstname']?> <?=$a['starcast_lastname']?></a>
                                    </li>
                            <?php }
                            }?>
                        </ul>
                    </div>
                </div>


            </div>

    <?php
        }
    } else {?>
            <a class="btn btn-primary btn-lg" href="/cs5200/movie.php?movie_id=<?=$_GET["movie_id"]?>">Go Back to Movie</a>
    <?php }

?>
