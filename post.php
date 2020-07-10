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


//edit post

if(isset($_POST['send_edited_text'])){
    $edited_post = mysqli_real_escape_string($db, $_POST['post_content_edit']);

    $update_post = mysqli_query($db, "UPDATE posts SET content='$edited_post' WHERE id='$pid'");

    header("location: post.php?id=".$pid."&title=".$t."");
}

//delete post

if(isset($_POST['delete_post'])){
    mysqli_query($db, "DELETE FROM posts WHERE id='$pid'");

    header("location: index.php");
}

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

<main class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-9 py-5">
                <div class="container">
                    <h2 class="post-title"><?php echo $t; ?></h2>
                    <small class="pl-2">Posted by: <a href="user.php?username=<?php echo $userPostedName; ?>"><?php echo $userPostedName; ?></a>&nbsp;|&nbsp;Posted in: <a href="sub.php?r=<?php echo $subPostedName; ?>"><?php echo $subPostedName; ?></a>&nbsp;|&nbsp;Uploaded: <?php echo $uploadDate; ?></small>

                    <?php if(strlen($content) > 0) : ?>
                        <div class="content-border">
                            <p class="pl-2 content"><?php echo $content; ?></p>
                        </div>
                    <?php else : ?>
                        <br><br>
                    <?php endif ?>


                    <?php if ($u == $userPostedName) : ?>
                        <small class="pl-2"><a href="#" data-toggle="modal" data-target="#exampleModal">Edit</a>&nbsp;|&nbsp;<form method="post" style="display:inline;"><button class="link" type="submit" name="delete_post">Delete post</button></form></small>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="post.php?id=<?php echo $pid; ?>&title=<?php echo $t; ?>">
                                            <textarea class="form-control rounded-0" name="post_content_edit" rows="7"><?php echo $content; ?></textarea>
                                            <button type="submit" name="send_edited_text" class="btn btn-primary float-right mt-3">Save changes</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

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