<?php require("includes/connection.php"); ?>
<?php require("includes/header.php"); ?>
<div class="row">
<div class="col-xs-3">

<?php
    $sql = "select * from starcast";
    $actors = $conn->query($sql);
?>

<ul class="list-group">
    <?php

    if ($actors->num_rows > 0) {
        // output data of each row

        while($row = $actors->fetch_assoc()) {
            if (isset($_GET['actor']) && $_GET['actor'] != NULL && $_GET['actor'] == $row["starcast_id"]) {
                $actor_name = $row["starcast_firstname"] . " " . $row["starcast_lastname"];
                $active = "active";
            } else {
                $active = " ";
            }
            //echo "1";
            echo
            "<li class='list-group-item $active'>" .
            "<a class='$active' href=/cs5200/actor.php?actor=" .
            $row["starcast_id"] . ">" .
            $row["starcast_firstname"] . " " . $row["starcast_lastname"] .
            "</a>" .
            "</li>";
        }
    } else {
        echo "0 results";
    }

    ?>
</div>

<div class="col-xs-9">

    <?php
    if (isset($_GET['actor']) && $_GET['actor'] != NULL) {
        $actor = $_GET['actor']; ?>

    <?php
        $sql = "select * from starcast where starcast_id='$actor'";
        $result = $conn->query($sql);
    ?>
    <div class="jumbotron">
        <h1><?=$actor_name?></h1>
    <?php

    if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) { ?>
            <div class="row">
            <p>
                <span class="col-xs-4">
                    <span class="glyphicon glyphicon-globe"></span><?=$row["birthplace"]?>
                </span>
                <span class="col-xs-4">
                    <span class="glyphicon glyphicon-calendar"></span><?=$row["date_of_birth"]?>
                </span>
                <span class="col-xs-4">
                    <span class="glyphicon glyphicon-resize-vertical"></span><?=$row["height"]?>
                </span>
            </p>
            </div>
            <hr>
            <p><?=$row['starcast_bio']?></p>
        <?php
        }
    } else {
        echo "0 results";
    }

    ?>

    <?php
        $sql = "call searchByActor('$actor')";
        $result = $conn->query($sql);
    ?>

    <ul class="list-group">
        <li class="list-group-item active row">
            <span class="col-xs-3">
                Title
            </span>
            <span class="col-xs-6">
                Description
            </span>
            <span class="col-xs-3">
                Rating
            </span>

        </li>
        <?php

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li class='list-group-item row'>" .
                     "<span class=col-xs-3>" .
                     "<a href=/cs5200/movie.php?movie_id=". $row["movie_id"] . ">" .
                     $row["movie_name"] .
                     "</a>" .
                     "</span><span class=col-xs-6>" .
                     $row["movie_description"] .
                     "</span><span class=col-xs-3>" .
                     $row["movie_rating"] .
                     "</span>" .
                     "</li>";
            }
        } else {
            echo "0 results";
        }

        ?>
    </ul>
    <?php } else { ?>
        <h1>Select an Actor to display movies.</h1>
    <?php } ?>

</div>

</div>
</div>
<?php require("includes/footer.php"); ?>
