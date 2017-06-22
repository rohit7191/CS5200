<div>
    <?php
    if (isset($_GET['sort']) && $_GET["sort"] == 'popularity')
        $sorted = "Popularity";
    else $sorted = "Rating";
    ?>
    <div class="page-header">
        <h1>Top Movies <small>Sorted by <?=$sorted?></small></h1>
    </div>

    <div class="btn-group btn-group-lg" role="group">
        <?php if ($sorted == "Rating") { ?>
            <a href="/cs5200/movie.php" class="btn btn-primary active">By Rating</a>
            <a href="/cs5200/movie.php?sort=popularity" class="btn btn-primary">By Popularity</a>
            </div>

        <?php
            include("includes/top-movies-rating.php");
            } else { ?>
                <a href="/cs5200/movie.php" class="btn btn-primary">By Rating</a>
                <a href="/cs5200/movie.php?sort=popularity" class="btn btn-primary active">By Popularity</a>
                </div>
            <?php include("includes/top-movies-popularity.php");
            } ?>
</div>
