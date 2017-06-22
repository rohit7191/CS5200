    <table class="table table-striped">
        <thead>
            <tr> <th>Movie Name</th> <th>Description</th> <th>Rating</th> </tr>
        </thead>
        <tbody>
    <?php
    $ratingsql = "CALL searchTop10()";
    $ratingres = $conn->query($ratingsql);

    if ($ratingres->num_rows > 0) {
        while($rr = $ratingres->fetch_assoc()) { ?>
            <tr>
                <td>
                    <a href="/cs5200/movie.php?movie_id=<?=$rr['movie_id']?>">     <?=$rr['movie_name']?>
                    </a>
                </td>
                <td>
                    <?=$rr['movie_description']?>
                </td>
                <td>
                    <?=$rr['movie_rating']?>
                </td>
            </tr>
    <?php }
    }?>
    </tbody>
</table>
