<?php
echo var_dump($_POST);
$review_sql = "call add_review(".
                (int)$_POST['movie_id']. ",".
                (int)$_POST['user_id']. ",'".
                $_POST['title']."','".
                $_POST['review']."')";
echo $review_sql;
$review_result = $conn->query($review_sql);
echo $review_result->num_rows;

// if ($review_result->num_rows > 0)
//     while($review_row = $review_result->fetch_assoc())
//         if ($review_row["msg"] == NULL) {
//             echo "something happened";
//         }
// else echo
//         "<span class='alert alert-success'>" .
//         "Your comment has been posted!" .
//         "</span>";
?>
