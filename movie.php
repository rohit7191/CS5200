<?php require("includes/connection.php"); ?>
<?php require("includes/header.php"); ?>
<?php
if (isset($_POST['number_of_tickets']) && $_POST["number_of_tickets"] > 0) {
    include("includes/order-placed.php");
}

if (isset($_POST['rating']) && $_POST["rating"] != NULL) {
    include("includes/user-rating.php");
}

if (isset($_POST['review']) && $_POST['review'] != NULL) {
    include("includes/critic-review.php");
}

if (isset($_POST['favorite']) && $_POST['favorite'] == "true") {
    include("includes/add-favorite.php");
}

if (isset($_POST['search']) && $_POST['search'] != NULL) {
    include("includes/search.php");
}
else if (isset($_GET['movie_id']) && $_GET['movie_id'] != NULL) {
    include("includes/movie-details.php");
} else {
    include("includes/top-movies.php");
} ?>
<?php require("includes/footer.php"); ?>
