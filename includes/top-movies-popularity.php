
    <table class="table table-striped">
        <thead>
            <tr> <th>Movie Name</th> <th>Description</th> <th>Popularity</th> </tr>
        </thead>
        <tbody>
            <?php
            $popsql = "call searchTop10ByPopularity()";
            $popres = $conn->query($popsql);

            if ($popres->num_rows > 0) {
                while($pr = $popres->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <a href="/cs5200/movie.php?movie_id=<?=$pr['movie_id']?>"> <?=$pr['movie_name']?>
                            </a>
                        </td>
                        <td>
                            <?=$pr['movie_description']?>
                        </td>
                        <td>
                            <?=$pr['movie_popularity']?>
                        </td>
                    </tr>
            <?php }
        }?>
        </tbody>
    </table>
