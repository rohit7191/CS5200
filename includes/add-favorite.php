<?php
$favorite = (int)$_GET["movie_id"];
$fav_sql = "call add_favorites('$userid', '$favorite')";

$fav_res = $conn->query($fav_sql);
if ($fav_res->num_rows > 0) {
    while($f = $fav_res->fetch_assoc()) { ?>
        <p class="alert alert-danger">Unable to fav</p>
<?php }
} else {?>
    <p class="alert alert-success">Added to fav</p>
<?php
}
?>
