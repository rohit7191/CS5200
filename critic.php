<?php require("includes/connection.php"); ?>
<?php require("includes/header.php"); ?>
<div class="row">
<div class="col-xs-3">

<?php
    $sql = "select * from users where user_role = 'Critic'";
    $critics = $conn->query($sql);
?>
<ul class="list-group">
    <?php

    // if ($_GET['producer'] != NULL) {
    //     $sql = "select * from producer";
    //     $producers = $conn->query($sql);
    // }

    if ($critics->num_rows > 0) {
        // output data of each row

        while($row = $critics->fetch_assoc()) {

            if (isset($_GET['critic']) && $_GET['critic'] != NULL && $_GET['critic'] == $row["user_id"]) {
                $producer_name = $row["user_firstname"] . " " . $row["user_lastname"];
                $active = "active";
            } else {
                $active = " ";
            }

            echo
                "<li class='list-group-item $active'>" .
                "<a class='$active' href=/cs5200/profile.php?user_id=" .
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
</div>
<?php include("includes/footer.php"); ?>
