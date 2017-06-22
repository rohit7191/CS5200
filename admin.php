<?php require("includes/connection.php"); ?>
<?php require("includes/header.php"); ?>
<?php if (isset($_POST['approve']) && $_POST["approve"] != NULL) {
    if($_POST["approve"] == "true") {
        $approveSql = "call adminMovieUpdate(".(int)$_POST['movie_id'].")";
        $approveRes = $conn->query($approveSql);
    }
    else if($_POST["approve"] == "false") {
        $approveSql = "call adminMovieDelete(".(int)$_POST['movie_id'].")";
        $approveRes = $conn->query($approveSql);
    }
    echo "<p class='alert alert-success'>Done</p>";
} ?>
<div class="page-header">
    <h1>Movies Pending Approval</h1>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <td>Movie Name</td>
            <td>Movie Description</td>
            <td>Producer</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>

        <?php
        $forApprovalSql = "call adminPendingApproval()";
        $forApprovalRes = $conn->query($forApprovalSql);

        if ($forApprovalRes->num_rows > 0) {
            // output data of each row
            while($forApproval = $forApprovalRes->fetch_assoc()) {
                if($forApproval["msg"] != "NULL") {?>

                <tr>
                    <td>
                        <?=$forApproval["movie_name"]?>
                    </td>
                    <td>
                        <?=$forApproval["movie_description"]?>
                    </td>
                    <td>
                        <?=$forApproval["pname"]?>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-xs-6">
                                <form class="" action="" method="post">
                                    <input class="sr-only" type="number" name="movie_id" value="<?=$forApproval["movie_id"]?>">
                                    <button class="btn btn-success" type="submit" name="approve" value="true">Approve</button>
                                </form>
                            </div>
                            <div class="col-xs-6">
                                <form class="" action="" method="post">
                                    <input class="sr-only" type="number" name="movie_id" value="<?=$forApproval["movie_id"]?>">
                                    <button class="btn btn-danger" type="submit" name="approve" value="false">Decline</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>

        <?php }
            }
        } ?>

    </tbody>
</table>

<?php require("includes/footer.php"); ?>
