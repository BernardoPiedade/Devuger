<?php 
    session_start();

    $comment_content  = "";

    $db = mysqli_connect('localhost', 'root', 'mysql', 'r_reddit');

    $u = $_SESSION['username'];

    $q = "SELECT * FROM users WHERE username = '$u'";
    $r = mysqli_query($db, $q);
    $row = mysqli_fetch_assoc($r);
    $id = $row['id'];

    if(isset($_POST['send-comment']))
    {
        $comment_content = mysqli_real_escape_string($db, nl2br($_POST['post-comment']));

        $query  = "INSERT INTO comments(userId, postID, comment) VALUES ($id, $pid, '$comment_content')";
        $q = mysqli_query($db, $query);

        $a = "UPDATE posts SET numComments = numComments + 1 WHERE id = $pid";
        $s = mysqli_query($db, $a);
    }
?>