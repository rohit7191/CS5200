<?php
$rater = (int)$_POST["user_id"];
$rated = (int)$_POST["movie_id"];
$rating = (int)$_POST["rating"];
$rate_sql = "call add_ratings('$rated', '$rater', '$rating')";

$rate_res = $conn->query($rate_sql);
if ($rate_res->num_rows == 1) {
    while($r = $order_res->fetch_assoc()) { ?>
        <?php if($r["msg"] != NULL) {
            echo "You rated!";
        } else {
            echo "Can't rate";
        }?>
<?php }
}
?>
