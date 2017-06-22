<?php require("includes/connection.php"); ?>
<?php require("includes/header.php"); ?>
<div class="row">
<div class="col-xs-3">

<?php
    $sql = "select * from users where user_role = 'Producer'";
    $producers = $conn->query($sql);
?>

<ul class="list-group">
    <?php

    // if ($_GET['producer'] != NULL) {
    //     $sql = "select * from producer";
    //     $producers = $conn->query($sql);
    // }

    if ($producers->num_rows > 0) {
        // output data of each row

        while($row = $producers->fetch_assoc()) {

            if (isset($_GET['producer']) && $_GET['producer'] != NULL && $_GET['producer'] == $row["user_id"]) {
                $producer_name = $row["user_firstname"] . " " . $row["user_lastname"];
                $active = "active";
            } else {
                $active = " ";
            }

            echo
                "<li class='list-group-item $active'>" .
                "<a class='$active' href=/cs5200/producer.php?producer=" .
                $row["user_id"] . ">" .
                $row["user_firstname"] . " " . $row["user_lastname"] .
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
    if (isset($_GET['producer']) && $_GET['producer'] != NULL) {
        $producer = $_GET['producer'];
        $sql = "call searchByProducer('$producer')";
        $result = $conn->query($sql);
    ?>
    <h1><?=$producer_name?></h1>

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
    <?php } else { ?>
        <h1>Select an Actor to display movies.</h1>
    <?php } ?>

</div>

</div>

<?php require("includes/footer.php"); ?>
