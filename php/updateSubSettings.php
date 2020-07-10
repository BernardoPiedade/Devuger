<?php 
    session_start();

    $db = mysqli_connect('localhost', 'root', 'mysql', 'devuger');

    $errors = array();

    if(isset($_POST['save_changes_username']))
    {
        $current_username = mysqli_real_escape_string($db, $_POST['current_subforum_name']);
        $new_username = mysqli_real_escape_string($db, $_POST['new_subforum_name']);

        if (empty($current_username)) {
            array_push($errors, "Current Sub-Forum name is required");
        }
        if (empty($new_username)) {
            array_push($errors, "New Sub-Forum name is required");
        }

        
            $change_username_query = "SELECT * FROM subforum WHERE sname = '$current_username'";
            $get_user_with_current_username = mysqli_query($db, $change_username_query);

            if (mysqli_num_rows($get_user_with_current_username) > 0)
            {
                $check_if_username_exists = mysqli_query($db, "SELECT * FROM subforum WHERE sname='$new_username'");
                if(mysqli_num_rows($check_if_username_exists) > 0){
                    array_push($errors, "That name already exists.");
                }else{
                    $change_username_query = "UPDATE subforum SET sname = '$new_username' WHERE sname = '$current_username'";

                    mysqli_query($db, $change_username_query);

                    array_push($errors, "Name changed successfully!");

                    $name = $new_username;

                    changeHeader($name);
                }
            } else {
                array_push($errors, "Current name does not match our database");
            }
        
    }

    if(isset($_POST['save_changes_password']))
    {
        $new_descp = mysqli_real_escape_string($db, nl2br($_POST['user_edit_rules'], true));
        $name = $_POST['sub_name'];

        $update_descp = mysqli_query($db, "UPDATE subforum SET rules='$new_descp' WHERE sname='$name'");
        array_push($errors, "Rules changed successfully!");

        changeHeader($name);
    }

    

    if(isset($_POST['save_changes_descp']))
    {
        $new_descp = mysqli_real_escape_string($db, nl2br($_POST['user_edit_description'], true));
        $name = $_POST['sub_name'];

        $update_descp = mysqli_query($db, "UPDATE subforum SET descp='$new_descp' WHERE sname='$name'");
        array_push($errors, "Description changed successfully!");

        changeHeader($name);
    }

    if(isset($_POST['save_changes_color']))
    {
        $new_color = $_POST['hexcolor'];
        $name = $_POST['sub_name'];

        $update_color = mysqli_query($db, "UPDATE subforum SET color='$new_color' WHERE sname='$name'");
        array_push($errors, "Color changed successfully!");

        changeHeader($name);
    }

    function changeHeader($name)
    {
        $errors = array();
        header("location: sub.php?r=" . $name . "");
    }
