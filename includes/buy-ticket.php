<div class="modal fade" id="buy<?=$s["movie_theatre_index"]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" class="" method="post" oninput="cost.value=parseInt(number_of_tickets.value)*parseInt(<?=$s['cost_per_ticket']?>)">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="buyNowLabel">Place Order</h4>
                </div>
                <div class="modal-body">

                    <!--- number of tickets, user id, movie_theatre_index -->
                    <label for="theatre">Theatre</label>
                    <input type="text" id="theatre" name="theatre" class="form-control input-lg" placeholder="Theatre" disabled value="<?=$s["theatre_name"]?>">

                    <label for="showtime">Showtime</label>
                    <input type="text" id="showtime" name="showtime" class="form-control input-lg" disabled value="<?=$s["showtime"]?>">

                    <input type="number" id="user_id" name="user_id" class="form-control input-lg sr-only" required value=<?=$userid?>>
                    <input type="number" id="movie_theatre_index" name="movie_theatre_index" class="form-control input-lg sr-only" required value="<?=$s["movie_theatre_index"]?>">

                    <label for="username">Enter Number of Tickets <mark>Max: <?=$s["seats_available"]?></mark></label>
                    <input type="number" id="number_of_tickets" name="number_of_tickets" class="form-control input-lg" placeholder="5" required autofocus min="1" max="<?=$s["seats_available"]?>" value="1">


                    <output id="cost" name="cost" value=></output>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-lg" type="submit">Buy</button>
                </div>
            </form>
        </div>
    </div>
</div>
