<?php require("includes/connection.php"); ?>
<?php require("includes/header.php"); ?>
<?php
if (isset($_POST['movie_title']) && isset($_POST['movie_description']) && $_POST["movie_title"] != NULL && $_POST["movie_description"] != NULL) {

$add_sql = "call producer_add_movie('$userid','".$_POST["movie_title"]."','".$_POST["movie_description"]."')";

$add_res = $conn->query($add_sql);

echo "<p class='alert alert-warning'>Your request is pending for Approval.</p>";
}

?>
<div class="page-header">
    <h1>Add a Movie</h1>
</div>

<form class="" action="" method="post">
    <input type="text" id="movie_title" name="movie_title" class="form-control" placeholder="Movie Title" required>
    <textarea id="movie_description" name="movie_description" class="form-control" rows="3" required></textarea>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

<?php require("includes/footer.php"); ?>
