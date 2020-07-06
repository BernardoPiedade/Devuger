<?php include('php/server.php'); ?>
<?php
session_start();

$pid = $_GET['id'];
$t = $_GET['title'];

$q = "SELECT * FROM posts WHERE id = '$pid'";
$r = mysqli_query($db, $q);
$rowd = mysqli_fetch_assoc($r);
$userId = $rowd['userId'];
$subId = $rowd['subforumId'];
$uploadDate = $rowd['uploadDate'];
$content = $rowd['content'];


//Get username of the one who posted
$getUser_Posted = "SELECT * FROM users WHERE id = '$userId'";
$runQueryGetUser_Posted = mysqli_query($db, $getUser_Posted);
$rowGetUser = mysqli_fetch_assoc($runQueryGetUser_Posted);
$userPostedName = $rowGetUser['username'];

//get the subforum to which it was posted
$getSub_Posted = "SELECT * FROM subforum WHERE id = '$subId'";
$runQueryGetSub_Posted = mysqli_query($db, $getSub_Posted);
$rowGetSub = mysqli_fetch_assoc($runQueryGetSub_Posted);
$subPostedName = $rowGetSub['sname'];


$u = $_SESSION['username'];

$w = "SELECT * FROM users WHERE username = '$u'";
$e = mysqli_query($db, $w);
$rowt = mysqli_fetch_assoc($e);
$color = $rowt['color'];

?>
<?php include('php/sendcomment.php'); ?>
<?php
$title = "Devuger - $t";

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
}
?>
<?php include('includes/header.php'); ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-9 py-5">
                <div class="container">
                    <h2 class="post-title"><?php echo $t; ?></h2>
                    <small>Posted by: <a href="user.php?username=<?php echo $userPostedName; ?>"><?php echo $userPostedName; ?></a>&nbsp;|&nbsp;<a href="sub.php?r=<?php echo $subPostedName; ?>"><?php echo $subPostedName; ?></a>&nbsp;|&nbsp;Uploaded: <?php echo $uploadDate; ?></small>

                    <div class="content-border">
                        <p class="pl-2 content"><?php echo $content; ?></p>
                    </div>
                    <hr>

                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '
                                    <div class="comment">
                                        <form method="POST" action="post.php?id=' . $pid . '&title=' . $t . '">
                                            <label><b>Tell them how it is:</b></label>
                                            <textarea class="form-control rounded-0" rows="5" name="post-comment" placeholder="Remember to be polite :)" required></textarea><br>
                                            <button class="btn btn-teal float-right" name="send-comment">Comment</button>
                                        </form>
                                    </div><br>
                                    ';
                    }
                    ?>
                    <br>
                    <div class="mt-3 mb-3" id="comments-seccion">
                        <?php

                        $query = "SELECT * FROM comments WHERE postID = $pid";
                        $q = mysqli_query($db, $query);

                        if (mysqli_num_rows($q) > 0) {
                            while ($row = mysqli_fetch_assoc($q)) {
                                $i = $row['userId'];
                                $a = "SELECT * FROM users WHERE id = '$i'";
                                $s = mysqli_query($db, $a);
                                $d = mysqli_fetch_assoc($s);

                                echo '
                                            <div class="media text-muted pt-3">
                                                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Profile: ' . $d['username'] . '</title><rect width="100%" height="100%" fill="' . $d['color'] . '"/></svg>
                                                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                <strong class="d-block text-gray-dark"><a href="user.php?username=' . $d['username'] . '">' . $d['username'] . '</a></strong>
                                                ' . nl2br($row['comment']) . '</p>
                                            </div>
                                        ';
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
            <?php include('includes/right_side_bar.php'); ?>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>