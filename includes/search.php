<?php $search = $_POST['search']; ?>
<h1>You searched for: <?=$search?></h1>
<?php

if (isset($search) && $search != NULL) {
    $sql = "CALL searchByMovieName('$search')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (! isset($row['message']) || $row['message'] != "null")
                echo
                    "<div class='well'>" .
                    "<div class='media'>" .
                    // "<div class='media-left media-middle'>" .
                    // "<a href='#'>" .
                    // "<img class='media-object' src='...'>" .
                    // "</a>" .
                    // "</div>" .
                    "<div class='media-body'>" .
                    "<h3 class='media-heading'>" .
                    "<a href=/cs5200/movie.php?movie_id=". $row['movie_id'] .">" .
                    $row['movie_name'] .
                    "</a>" .
                    "</h3>" .
                    $row['movie_description'] .
                    "</div>" .
                    "</div>" .
                    "</div>";

            else
                echo "<p class=lead>No results found</p>";
        }
    } else {
        echo "<p class=lead>No results found</p>";
    }
}

?>
