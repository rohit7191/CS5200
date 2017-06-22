<?php
    if ($row["user_role"] == 'Producer') {
        $profile_sql = "select * from producer where producer_id=".$profile_id;
        $profile_result = $conn->query($profile_sql);
        if ($profile_result->num_rows > 0)
            while($profile_row = $profile_result->fetch_assoc())
                echo
                "<p><span class='glyphicon glyphicon-globe'></span>" .
                $profile_row["birthplace"] .
                "</p><p>" . $profile_row["producer_bio"] . "</p>";
    } else if ($row["user_role"] == 'Critic'){
        $profile_sql = "select * from critic where critic_id=".$profile_id;
        $profile_result = $conn->query($profile_sql);
        if ($profile_result->num_rows > 0)
            while($profile_row = $profile_result->fetch_assoc()) {

                $critic_sql = "select * from genre where genre_id=".$profile_row["fav_genre"];
                $critic_result = $conn->query($critic_sql);
                if ($critic_result->num_rows > 0)
                    while($c = $critic_result->fetch_assoc())
                        echo
                        "<p><span class='glyphicon glyphicon-heart'></span> " .
                        "<a href=/cs5200/genre.php?genre=" .
                        $c["genre_id"] . ">" .
                        $c["genre_name"] . "</a></p>";
                echo
                "<p><span class='glyphicon glyphicon-link'></span> " .
                $profile_row["website"] .
                "</p>";
            }
        if ($role == 'Fan') { ?>
            <?php
                $followers_sql = "select count(*) as follower_count from followers where fan_id='$userid' and critic_id='$profile_id'";
                $followers_result = $conn->query($followers_sql);
                if ($followers_result->num_rows == 1)
                    while($f= $followers_result->fetch_assoc())
                        if($f["follower_count"] == 0) {
            ?>
            <form class="" action="" method="post">
                <button class="btn btn-success btn-lg btn-block" type="submit" name="follow" value="<?=$profile_id?>">Follow <?=$profile_firstname?></button>
            </form>
        <?php
            } else { ?>

                <form class="" action="" method="post">
                    <button class="btn btn-danger btn-lg btn-block" type="submit" name="unfollow" value="<?=$profile_id?>">Unfollow <?=$profile_firstname?></button>
                </form>

            <?php }
        }
    }
?>
