<?php 
    session_start();

    $db = mysqli_connect('localhost', 'root', 'mysql', 'r_reddit');

    $logedUser = $_SESSION['username'];

    if(isset($_POST['save_changes_username']))
    {
        $current_username = mysqli_real_escape_string($db, $_POST['current_username']);
        $new_username = mysqli_real_escape_string($db, $_POST['new_username']);

        if($current_username == $logedUser)
        {
            $change_username_query = "SELECT * FROM users WHERE username = '$current_username'";
            $get_user_with_current_username = mysqli_query($db, $change_username_query);

            if (mysqli_num_rows($get_user_with_current_username) > 0)
            {
                $change_username_query = "UPDATE users SET username = '$new_username' WHERE username = '$current_username'";

                mysqli_query($db, $change_username_query);
                
                changeHeader($new_username);
            }
        }
    }

    function changeHeader($new_username)
    {
        header("location: user.php?username=" . $new_username . "");
    }
?>