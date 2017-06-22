<?php require('includes/connection.php'); ?>
<?php
    if ($post['username'] == NULL)
        header('Location:index.php');
?>
<?php require('includes/header.php'); ?>
<?php
if (isset($_POST['follow']) && $_POST['follow'] != NULL) {
    $follow_sql = "call add_followers(".$_POST['follow'].",".$userid.")";
    $follow_result = $conn->query($follow_sql);
    if (isset($follow_result) && $follow_result->num_rows > 0)
        while($follow_row = $follow_result->fetch_assoc())
            echo
            "<span class='alert alert-danger'>" .
            "You already follow this critic!" .
            "</span>";
    else echo
            "<span class='alert alert-success'>" .
            "You're now following this critic!" .
            "</span>";
}

if (isset($_POST['unfollow']) && $_POST['unfollow'] != NULL) {
    $unfollow_sql = "call unfollow_user(".$_POST['unfollow'].",".$userid.")";
    $unfollow_result = $conn->query($unfollow_sql);
    if ($unfollow_result->num_rows > 0)
        while($unfollow_row = $unfollow_result->fetch_assoc())
            echo
            "<span class='alert alert-danger'>" .
            "You can't unfollow!" .
            "</span>";
    else echo
            "<span class='alert alert-success'>" .
            "You unfollowed!" .
            "</span>";
}
?>
<?php
    if (isset($_GET['user_id']) && $_GET['user_id'] != NULL)
        $profile_id = $_GET['user_id'];
    else
        $profile_id = $userid;

    $sql = "select * from users where user_id =".$profile_id;
    $result = $conn->query($sql);
    //echo var_dump($post);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
            <div class=jumbotron>
                <?php
                $profile_firstname = $row["user_firstname"];
                $profile_lastname = $row["user_lastname"];
                $profile_role = $row["user_role"];
                ?>

                <h1><?=$row["user_firstname"]?> <?=$row["user_lastname"]?>
                <small class="alert pull-right"><?=$row["user_role"]?></small></h1>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">About <?=$row["user_firstname"]?></h3>
                        </div>
                        <div class="panel-body">
                            <p>
                                <span class="glyphicon glyphicon-calendar"></span> <?=$row["date_of_birth"]?>
                            </p>
                            <?php include("includes/profile-details.php"); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8">
                    <?php include("includes/fan-favorite-movies.php"); ?>

                    <?php include("includes/follow-details.php"); ?>
                </div>

            </div>
    <?php }
    } else {
        echo "0 results";
    }

?>

<?php require('includes/footer.php') ?>
