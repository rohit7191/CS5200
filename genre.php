<?php require('includes/connection.php'); ?>
<?php require('includes/header.php'); ?>
<?php
    $sql = "select * from genre";
    $genres = $conn->query($sql);
?>
<div class="btn-group btn-group-justified btn-group-lg" role="group">
    <?php

    if ($genres->num_rows > 0) {
        // output data of each row
        while($row = $genres->fetch_assoc()) {
            if (isset($_GET['genre']) && $_GET['genre'] != NULL && $_GET['genre'] == $row["genre_id"]) {
                $genre_name = $row["genre_name"];
                $active = "active";
            } else {
                $active = " ";
            }
            echo
            "<a class='btn btn-default $active' href=/cs5200/genre.php?genre=". $row["genre_id"] . ">" .
                 $row["genre_name"] .
                 "</a>";
        }
    } else {
        echo "0 results";
    }

    ?>
</div>
<?php
if (isset($_GET['genre']) && $_GET['genre'] != NULL) {
    $genre = $_GET['genre'];
    $sql = "call searchByGenre('$genre')";
    $result = $conn->query($sql);
?>
<h1><?=$genre_name?></h1>

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
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            //
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
<?php } ?>
<?php require('includes/footer.php'); ?>
