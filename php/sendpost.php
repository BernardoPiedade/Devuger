<?php 
    session_start();

    if(isset($_POST['post_send']))
    {
        $title = mysqli_real_escape_string($db, $_POST['post_title']);
        $content = mysqli_real_escape_string($db, nl2br($_POST['post_content'],true));
        $sub = mysqli_real_escape_string($db, $_POST['post_to']);

        $u = $_SESSION['username'];

        //get id of logged in user
        $a = "SELECT * FROM users WHERE username = '$u'";
        $r = mysqli_query($db, $a);
        $row = mysqli_fetch_assoc($r);
        $id = $row['id'];

        //get subreddit details
        $s = "SELECT * FROM subforum WHERE sname = '$sub'";
        $r2 = mysqli_query($db, $s);
        $row2 = mysqli_fetch_assoc($r2);
        $sid = $row2['id'];

        $q = "INSERT INTO posts (userId,subforumId,title,content,uploadDate,numComments) VALUES ('$id','$sid','$title','$content',NOW(),0)";
        $query = mysqli_query($db, $q);

        $f = "UPDATE subforum SET numPosts = numPosts + 1 WHERE id = $sid";
        $d = mysqli_query($db, $f);
        
        changeHeader($db,$title);
    }

    function changeHeader($db,$title)
    {
        $query = "SELECT MAX(id) AS f FROM posts";
        $q = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($q);
        $pId = $row['f'];
        header("location: post.php?id=".$pId."&title=".$title."");
    }
?>