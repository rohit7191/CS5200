<?php if($row["user_role"] == 'Critic') {
    $followers_sql = "select * from followers where critic_id='$profile_id'";
    $followers_result = $conn->query($followers_sql);
    $followers_count = $followers_result->num_rows;
    ?>
    <div class="panel panel-default">
    <div class="panel-heading"><?=$followers_count?> Followers</div>
    <div class="panel-body">
    <p><?=$followers_count?> Fans follow this critic!</p>
    </div>

    <ul class="list-group">
        <?php if ($followers_result->num_rows > 0) {
                while($followers_row = $followers_result->fetch_assoc()) {
                $followers_fans_sql = "select * from users where user_id=".$followers_row["fan_id"];
                $followers_fans_result = $conn->query($followers_fans_sql);
                if ($followers_fans_result->num_rows == 1) {
                    while($followers_fans_row = $followers_fans_result->fetch_assoc()) {
                    ?>
                    <li class="list-group-item">
                        <a href="/cs5200/profile.php?user_id=<?=$followers_row["fan_id"]?>"><?=$followers_fans_row["user_firstname"]?> <?=$followers_fans_row["user_lastname"]?></a>
                    </li>
                <?php }
                }
            }
        } ?>

    </ul>
    </div>
<?php } else if ($row["user_role"] == 'Fan') {
    $followers_sql = "select * from followers where fan_id='$profile_id'";
    $followers_result = $conn->query($followers_sql);
    $followers_count = $followers_result->num_rows; ?>

    <div class="panel panel-default">
    <div class="panel-heading"><?=$followers_count?> Following</div>
    <div class="panel-body">
    <p><?=$profile_firstname?> follows <?=$followers_count?> critics!</p>
    </div>
    <ul class="list-group">
        <?php if ($followers_result->num_rows > 0) {
                while($followers_row = $followers_result->fetch_assoc()) {
                $followers_fans_sql = "select * from users where user_id=".$followers_row["critic_id"];
                $followers_fans_result = $conn->query($followers_fans_sql);
                if ($followers_fans_result->num_rows == 1) {
                    while($followers_fans_row = $followers_fans_result->fetch_assoc()) {
                    ?>
                    <li class="list-group-item clearfix">
                        <a href="/cs5200/profile.php?user_id=<?=$followers_row["critic_id"]?>"><?=$followers_fans_row["user_firstname"]?> <?=$followers_fans_row["user_lastname"]?></a>
                    </li>
                <?php }
                }
            }
        } ?>

    </ul>
</div>

<?php } ?>
