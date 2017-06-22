<?php
$buyer = (int)$_POST["user_id"];
$theatre = (int)$_POST["movie_theatre_index"];
$tickets = (int)$_POST["number_of_tickets"];
$order_sql = "call buyTickets('$buyer', '$theatre', '$tickets')";

$order_res = $conn->query($order_sql);
if ($order_res->num_rows == 1) {
    while($o = $order_res->fetch_assoc()) { ?>
        <div class="page-header">
            <h1>Order Placed <small>Your receipt</small></h1>
        </div>
        <p class="lead">
            Tickets for: <?=$o["movie_name"]?>
        </p>
        <p class="lead">
            At: <?=$o["theatre_name"]?>
        </p>
        <p class="lead">
            Time: <?=$o["showtime"]?>
        </p>
        <p class="lead">
            Tickets: <?=$o["number_of_tickets"]?>
        </p>
        <p class="lead">
            Cost: <?=$o["total_cost"]?>
        </p>

        <hr>
        
<?php }
}
?>
