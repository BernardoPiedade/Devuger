<?php include('php/server.php'); ?>
<?php
session_start();

$forum_name = $_GET['r'];

$a = "SELECT * FROM subforum WHERE sname = '$forum_name'";
$r = mysqli_query($db, $a);
$rowd = mysqli_fetch_assoc($r);

$f_ID = $rowd['id'];
$descp = $rowd['descp'];
$subs = $rowd['subscribers'];
$color = $rowd['color'];
$creationDate = $rowd['creationDate'];
$numPosts = $rowd['numPosts'];
$createdBy = $rowd['createdBy'];
$rules = $rowd['rules'];

$get_creator = mysqli_query($db, "SELECT username FROM users WHERE id = '$createdBy'");
$run_query_get_creator = mysqli_fetch_assoc($get_creator);
$creator = $run_query_get_creator['username'];

$logedUser = $_SESSION['username'];
$get_logged_userId = mysqli_query($db, "SELECT id FROM users WHERE username='$logedUser'");
$run_get_logged_user_query = mysqli_fetch_assoc($get_logged_userId);
$logged_userId = $run_get_logged_user_query['id'];

// Check if user is subscribed to the forum
$user_is_subscribed = false;
$find_if_user_is_subscribed = mysqli_query($db, "SELECT subId FROM subscriptions WHERE userId = '$logged_userId' AND subId='$f_ID'");
if (mysqli_num_rows($find_if_user_is_subscribed) > 0) {
    $user_is_subscribed = true;
} else {
    $user_is_subscribed = false;
}

?>
<?php
$title = "Devuger - $forum_name";

// Pagination stuff
if (isset($_GET['page_num']) && $_GET['page_num'] != "") {
    $page_num = $_GET['page_num'];
} else {
    $page_num = 1;
}

$total_posts_per_page = 5;
$offset = ($page_num - 1) * $total_posts_per_page;
$previous_page = $page_num - 1;
$next_page = $page_num + 1;

// Get user total num of posts
$query_user_num_posts = mysqli_query($db, "SELECT COUNT(*) As total_posts FROM posts WHERE userId = '$u_ID'");
$total_posts = mysqli_fetch_array($query_user_num_posts);
$total_posts = $total_posts['total_posts'];
$total_num_of_pages = ceil($total_posts / $total_posts_per_page);


// End of pagination

if (isset($_POST['unsubscribe'])) {
    $unsubscribe_user = mysqli_query($db, "DELETE FROM subscriptions WHERE userId='$logged_userId' AND subId='$f_ID'");
    $minus = mysqli_query($db, "UPDATE subforum SET subscribers = subscribers - 1 WHERE id='$f_ID'");
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['subscribe'])) {
    $subscribe_user = mysqli_query($db, "INSERT INTO subscriptions (userId, subId) VALUES ('$logged_userId', '$f_ID')");
    $plus = mysqli_query($db, "UPDATE subforum SET subscribers = subscribers + 1 WHERE id='$f_ID'");
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
}
?>
<?php include('php/updateProfileSettings.php'); ?>
<?php include('includes/header.php'); ?>

<main class="content-wrapper">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-9">

                <h2><svg class="bd-placeholder-img mr-2 rounded" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="">
                        <title>Forum: <?php echo $forum_name; ?></title>
                        <rect width="100%" height="100%" fill="<?php echo $color; ?>" /><text x="50%" y="50%" fill="" dy=".3em"></text>
                    </svg><b><?php echo $forum_name; ?></b></h2>
                <small>Subscribers: <?php echo $subs; ?></small>
                <small>&nbsp;&nbsp; | &nbsp;&nbsp;</small><small>Created by: <?php echo "<a href='user.php?username=$creator'>$creator</a>"; ?> in <?php echo $creationDate; ?></small>
                <div class="descp py-3 mb-3">
                    <div class="content-border">
                        <p class="pl-2 content"><?php echo nl2br($descp); ?></p>
                    </div>
                </div>
                <h3>Latest post made:</h3>
                <hr class="border-bottom border-gray">
                <?php

                $query_get_forum_posts = "SELECT * FROM posts WHERE subforumId = '$f_ID' ORDER BY id DESC LIMIT $offset, $total_posts_per_page";
                $get_forum_posts = mysqli_query($db, $query_get_forum_posts);

                if (mysqli_num_rows($get_forum_posts) > 0) {
                    while ($get_forum_posts_row = mysqli_fetch_assoc($get_forum_posts)) {

                        $id_user_posted = $get_forum_posts_row['userId'];
                        $get_user_who_posted = mysqli_query($db, "SELECT username FROM users WHERE id='$id_user_posted'");
                        $run_get_user_query = mysqli_fetch_assoc($get_user_who_posted);
                        $username = $run_get_user_query['username'];

                        echo
                            '<article>
											<div class="media text-muted pt-3">
												<svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $color . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="media-body">
													<a href="post.php?id=' . $get_forum_posts_row['id'] . '&title=' . $get_forum_posts_row['title'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
													<strong class="d-block text-gray-dark article-title">' . $get_forum_posts_row['title'] . '</strong></a>' . strip_tags(mb_strimwidth($get_forum_posts_row['content'], 0, 125, "..."), '<br/>') . '<br>
													<small>Posted by: <a class="article-b-links" href="user.php?username=' . $username . '">' . $username . '</a>&nbsp;|&nbsp;Posted in: <a class="article-b-links" href="sub.php?r=' . $forum_name . '">' . $forum_name . '</a>&nbsp;|&nbsp;<a href="post.php?id=' . $get_forum_posts_row['id'] . '&title=' . $get_forum_posts_row['title'] . '#comments-seccion">Comments(' . $get_forum_posts_row['numComments'] . ')</a></small></p>
												</div>
											</div>
										</article>';
                    }
                }


                ?>
                <?php if ($page_num > 1) : ?>
                    <button class="btn btn-primary"><a style="color: white;" <?php echo "href=?username=$username&page_num=$previous_page"; ?>>Prev</a></button>
                <?php endif ?>

                <?php if ($page_num < $total_num_of_pages) : ?>
                    <button class="btn btn-primary"><a style="color: white;" <?php echo "href=?username=$username&page_num=$next_page"; ?>>Next</a></button>
                <?php endif ?>

            </div>
            <div class="col-md-3 py-5">
                <div class="mb-4">
                    <?php if ($user_is_subscribed == true) : ?>
                        <form action="sub.php?r=<?php echo $forum_name; ?>" method="post"><button class="btn btn-teal w-100" type="submit" name="unsubscribe">You're subscribed</button></form>
                    <?php elseif ($user_is_subscribed == false) : ?>
                        <form action="sub.php?r=<?php echo $forum_name; ?>" method="post"><button class="btn btn-teal w-100" type="submit" name="subscribe">Subscribe</button></form>
                    <?php endif ?>
                </div>
                
                

                <div>
                    <h4>Rules:</h4>
                    <hr class="border-bottom border-gray">

                    <?php
                    echo '<p class="pl-2 content">' . nl2br($rules) . '</p>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>