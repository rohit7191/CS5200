<?php if($row["user_role"] == "Fan") { ?>
<div class="panel panel-default">
    <div class="panel-heading">Favorite Movie(s)</div>
<?php if($row["user_role"] == 'Fan') {
    //$favsql = "call show_favorites(".$_GET['user_id'].")";
    $favsql = "select a.movie_id as movie_id, a.movie_name as movie_name from movies a
        inner join favorites b
        on a.movie_id = b.favorite_id
        where b.user_id =".(int)$_GET['user_id'];
    //echo $favsql;
    $favmovies = $conn->query($favsql);
    //echo $favmovies->num_rows;
    if ($favmovies->num_rows > 0) {
        echo "<ul class=list-group>";
        while($fav_row = $favmovies->fetch_assoc()) { ?>
            <li class="list-group-item">
                <?=$fav_row["movie_name"]?>
            </li>
        <?php }
        echo "</ul>";
    }
    else echo "<div class=panel-body><p>No Favoriters</p></div>";
} ?>
</div>
<?php } ?>
