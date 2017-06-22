<?php
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
   // username and password sent from form

   $myusername = $_POST['username'];
   $mypassword = $_POST['password'];
   $sql = "SELECT login('$myusername','$mypassword') as userid";
 //   $result = mysqli_query($db,$sql);
 //   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 //   $active = $row['active'];
 //
 //   $count = mysqli_num_rows($result);

   // If result matched $myusername and $mypassword, table row must be 1 row
   $result = $conn->query($sql);

   if($result->num_rows == 1)
     while($row = $result->fetch_assoc())
         if ($row['userid'] != NULL)
             header('Location:profile.php?user_id='.$row['userid']);
         else
             echo "Your Login Name or Password is invalid";
}
?>
