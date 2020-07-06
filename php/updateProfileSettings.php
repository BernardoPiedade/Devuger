<?php 
    session_start();

    $db = mysqli_connect('localhost', 'root', 'mysql', 'devuger');

    $logedUser = $_SESSION['username'];

    //initiate vars
    $current_password = "";
    $new_password = "";

    $errors = array(); 

    if(isset($_POST['save_changes_username']))
    {
        $current_username = mysqli_real_escape_string($db, $_POST['current_username']);
        $new_username = mysqli_real_escape_string($db, $_POST['new_username']);

        if (empty($current_username)) {
            array_push($errors, "Current username is required");
        }
        if (empty($new_username)) {
            array_push($errors, "New username is required");
        }

        if($current_username == $logedUser)
        {
            $change_username_query = "SELECT * FROM users WHERE username = '$current_username'";
            $get_user_with_current_username = mysqli_query($db, $change_username_query);

            if (mysqli_num_rows($get_user_with_current_username) > 0)
            {
                $check_if_username_exists = mysqli_query($db, "SELECT * FROM users WHERE username='$new_username'");
                if(mysqli_num_rows($check_if_username_exists) > 0){
                    array_push($errors, "That name already exists.");
                }else{
                    $change_username_query = "UPDATE users SET username = '$new_username' WHERE username = '$current_username'";

                    mysqli_query($db, $change_username_query);

                    array_push($errors, "Username changed successfully!");

                    changeHeader($new_username);
                }
            }
        }else{
            array_push($errors, "Current username does not match our database");
        }
    }

    if(isset($_POST['save_changes_password']))
    {
        $current_password = mysqli_real_escape_string($db, $_POST['current_password']);
        $new_password = mysqli_real_escape_string($db, $_POST['new_password']);

        if (empty($current_password)) {
            array_push($errors, "Current password is required");
        }
        if(empty($new_password)){
            array_push($errors, "New password is required");
        }

        $md5_current_password = md5($current_password);
        $password = md5($new_password);

        $query = "SELECT * FROM users WHERE username='$logedUser'";
        $results = mysqli_query($db, $query);
        $r_results = mysqli_fetch_assoc($results);
        $user_current_password_db = $r_results['pass'];

        if($md5_current_password != $user_current_password_db){
            array_push($errors, "Current password does not match our database");
        }else if($md5_current_password == $user_current_password_db)
        {
            $change_password_query = "UPDATE users SET pass='$password' WHERE username='$logedUser'";
            $r = mysqli_query($db, $change_password_query);
            array_push($errors, "Password changed successfully!");
            changeHeader($logedUser);
        }
    }

    if(isset($_POST['save_changes_email']))
    {
        $current_email = mysqli_real_escape_string($db, $_POST['current_email']);
        $new_email = mysqli_real_escape_string($db, $_POST['new_email']);

        if (empty($current_email)) {
            array_push($errors, "Current email is required");
        }
        if (empty($new_email)) {
            array_push($errors, "New email is required");
        }

        $query = "SELECT * FROM users WHERE username='$logedUser'";
        $results = mysqli_query($db, $query);
        $r_results = mysqli_fetch_assoc($results);
        $user_current_email_db = $r_results['email'];

        if ($current_email != $user_current_email_db) {
            array_push($errors, "Current email does not match our database");
        } else if ($current_email == $user_current_email_db) {

            $check_if_email_exists = mysqli_query($db, "SELECT * FROM users WHERE email='$new_email'");
            if(mysqli_num_rows($check_if_email_exists) > 0)
            {
                array_push($errors, "That email already exists.");
            }else{
                $change_email_query = "UPDATE users SET email='$new_email' WHERE username='$logedUser'";
                $r = mysqli_query($db, $change_email_query);
                array_push($errors, "Email changed successfully!");
                changeHeader($logedUser);
            }
        }
    }

    if(isset($_POST['save_changes_descp']))
    {
        $new_descp = mysqli_real_escape_string($db, nl2br($_POST['user_edit_description'], true));

        $update_descp = mysqli_query($db, "UPDATE users SET descp='$new_descp' WHERE username='$logedUser'");
        array_push($errors, "Email changed successfully!");
        changeHeader($logedUser);
    }

    if(isset($_POST['save_changes_color']))
    {
        $new_color = $_POST['hexcolor'];

        $update_color = mysqli_query($db, "UPDATE users SET color='$new_color' WHERE username='$logedUser'");
        array_push($errors, "Color changed successfully!");
        changeHeader($logedUser);
    }

    function changeHeader($new_username)
    {
        $errors = array();
        session_destroy();
        session_start();
        $_SESSION['username'] = $new_username;
        header("location: user.php?username=" . $new_username . "");
    }
?>