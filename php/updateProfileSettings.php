<?php 
    session_start();

    $db = mysqli_connect('localhost', 'root', 'mysql', 'devuger');

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

    if(isset($_POST['save_changes_password']))
    {
        $current_password = mysqli_real_escape_string($db, $_POST['current_password']);
        $new_password = mysqli_real_escape_string($db, $_POST['new_password']);

        $md5_current_password = md5($current_password);
        $password = md5($new_password);

        $query = "SELECT * FROM users WHERE username='$logedUser' AND pass='$current_password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $change_password_query = "UPDATE users SET pass='$password' WHERE pass='$md5_current_password'";
            $r = mysqli_query($db, $change_password_query);
        }

        changeHeader($logedUser);
    }

    function changeHeader($new_username)
    {
        session_destroy();
        session_start();
        $_SESSION['username'] = $new_username;
        header("location: user.php?username=" . $new_username . "");
    }
?>