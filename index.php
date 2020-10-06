<?php include('php/server.php'); ?>
<?php
$title = "Devuger - Home Page";

$u = $_SESSION['username'];

$b = "SELECT * FROM users WHERE username = '$u'";
$r = mysqli_query($db, $b);
$r3 = mysqli_fetch_assoc($r);
$id = $r3['id'];

// Pagination stuff
if (isset($_GET['page_num']) && $_GET['page_num'] != "") {
    $page_num = $_GET['page_num'];
} else {
    $page_num = 1;
}

$total_posts_per_page = 15;
$offset = ($page_num - 1) * $total_posts_per_page;
$previous_page = $page_num - 1;
$next_page = $page_num + 1;

if ($_SESSION['username']) {
    $query_num_posts = mysqli_query($db, "SELECT COUNT(*) As total_posts FROM posts WHERE subforumId IN (SELECT subId FROM subscriptions WHERE userId = '$id')");
    $total_posts = mysqli_fetch_array($query_num_posts);
    $total_posts = $total_posts['total_posts'];
    $total_num_of_pages = ceil($total_posts / $total_posts_per_page);
} else {
    $query_num_posts = mysqli_query($db, "SELECT COUNT(*) As total_posts FROM posts");
    $total_posts = mysqli_fetch_array($query_num_posts);
    $total_posts = $total_posts['total_posts'];
    $total_num_of_pages = ceil($total_posts / $total_posts_per_page);
}

// End of pagination

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
?>

<?php include('includes/header.php'); ?>

<main class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-9 py-3">
                <?php

                if (isset($_SESSION['username'])) {

                    $query = "SELECT * FROM posts WHERE subforumId IN (SELECT subId FROM subscriptions WHERE userId = '$id') ORDER BY id DESC LIMIT $offset, $total_posts_per_page";
                    $q = mysqli_query($db, $query);

                    if (mysqli_num_rows($q) > 0) {
                        while ($row = mysqli_fetch_assoc($q)) {
                            $subID = $row['subforumId'];
                            $q2 = "SELECT * FROM subforum WHERE id = '$subID'";
                            $r = mysqli_query($db, $q2);
                            $row2 = mysqli_fetch_assoc($r);
                            $subName = $row2['sname'];
                            $color = $row2['color'];

                            $creator = $row["userId"];
                            $q3 = "SELECT * FROM users WHERE id = '$creator'";
                            $r4 = mysqli_query($db, $q3);
                            $row3 = mysqli_fetch_assoc($r4);
                            $creatorName = $row3['username'];

                            echo
                                '<article>
                                            <div class="media text-muted pt-3">
                                                <svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $color . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="media-body">
                                                    <a href="post.php?id=' . $row['id'] . '&title=' . $row['title'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                    <strong class="d-block text-gray-dark article-title">' . $row['title'] . '</strong></a>' . strip_tags(mb_strimwidth($row['content'], 0, 125, "..."), '<br/>') . '<br>
                                                    <small>Posted by: <a class="article-b-links" href="user.php?username=' . $creatorName . '">' . $creatorName . '</a>&nbsp;|&nbsp;Posted in: <a class="article-b-links" href="sub.php?r=' . $subName . '">' . $subName . '</a>&nbsp;|&nbsp;<a href="post.php?id=' . $row['id'] . '&title=' . $row['title'] . '#comments-seccion">Comments(' . $row['numComments'] . ')</a></small></p>
                                                </div>
                                            </div>
                                        </article>';
                        }
					}
					else{

						//find if the user is ubscribed to any sub-forum
						$is_user_subscribed = "SELECT COUNT(subId) AS n FROM subscriptions WHERE userId = '$id'";
						$run_query = mysqli_query($db, $is_user_subscribed);
						$get_results = mysqli_fetch_assoc($run_query);
						$n = $get_results['n'];

						if($n <= 0){
							echo
							'<div class="alert alert-info" role="alert">
								You\'re not subscribed to any sub-forum... Here\'s some of the posts of today.
							  </div>';

							$query = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $total_posts_per_page";
							$q = mysqli_query($db, $query);
			
							if (mysqli_num_rows($q) > 0) {
								while ($row = mysqli_fetch_assoc($q)) {
									$subID = $row['subforumId'];
									$q2 = "SELECT * FROM subforum WHERE id = '$subID'";
									$r = mysqli_query($db, $q2);
									$row2 = mysqli_fetch_assoc($r);
									$subName = $row2['sname'];
									$color = $row2['color'];
			
									$creator = $row["userId"];
									$q3 = "SELECT * FROM users WHERE id = '$creator'";
									$r4 = mysqli_query($db, $q3);
									$row3 = mysqli_fetch_assoc($r4);
									$creatorName = $row3['username'];
			
									echo
										'<article>
											<div class="media text-muted pt-3">
												<svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $color . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="media-body">
													<a href="post.php?id=' . $row['id'] . '&title=' . $row['title'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
													<strong class="d-block text-gray-dark article-title">' . $row['title'] . '</strong></a>' . strip_tags(mb_strimwidth($row['content'], 0, 125, "..."), '<br/>') . '<br>
													<small>Posted by: <a class="article-b-links" href="user.php?username=' . $creatorName . '">' . $creatorName . '</a>&nbsp;|&nbsp;Posted in: <a class="article-b-links" href="sub.php?r=' . $subName . '">' . $subName . '</a>&nbsp;|&nbsp;<a href="post.php?id=' . $row['id'] . '&title=' . $row['title'] . '#comments-seccion">Comments(' . $row['numComments'] . ')</a></small></p>
												</div>
											</div>
										</article>';
								}
							}
						}
						else{
							echo
							'<div class="alert alert-info" role="alert">
								The sub-forums you\'re subscribed to don\'t have posts... Here\'s some of the posts of today.
							  </div>';

							$query = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $total_posts_per_page";
							$q = mysqli_query($db, $query);
			
							if (mysqli_num_rows($q) > 0) {
								while ($row = mysqli_fetch_assoc($q)) {
									$subID = $row['subforumId'];
									$q2 = "SELECT * FROM subforum WHERE id = '$subID'";
									$r = mysqli_query($db, $q2);
									$row2 = mysqli_fetch_assoc($r);
									$subName = $row2['sname'];
									$color = $row2['color'];
			
									$creator = $row["userId"];
									$q3 = "SELECT * FROM users WHERE id = '$creator'";
									$r4 = mysqli_query($db, $q3);
									$row3 = mysqli_fetch_assoc($r4);
									$creatorName = $row3['username'];
			
									echo
										'<article>
											<div class="media text-muted pt-3">
												<svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $color . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="media-body">
													<a href="post.php?id=' . $row['id'] . '&title=' . $row['title'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
													<strong class="d-block text-gray-dark article-title">' . $row['title'] . '</strong></a>' . strip_tags(mb_strimwidth($row['content'], 0, 125, "..."), '<br/>') . '<br>
													<small>Posted by: <a class="article-b-links" href="user.php?username=' . $creatorName . '">' . $creatorName . '</a>&nbsp;|&nbsp;Posted in: <a class="article-b-links" href="sub.php?r=' . $subName . '">' . $subName . '</a>&nbsp;|&nbsp;<a href="post.php?id=' . $row['id'] . '&title=' . $row['title'] . '#comments-seccion">Comments(' . $row['numComments'] . ')</a></small></p>
												</div>
											</div>
										</article>';
								}
							}
						}
					}
                } else {

					echo
						'<div class="alert alert-danger" role="alert">
							You\'re not logged in!
					  	</div>';

                    $query = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $total_posts_per_page";
                    $q = mysqli_query($db, $query);

                    if (mysqli_num_rows($q) > 0) {
                        while ($row = mysqli_fetch_assoc($q)) {
                            $subID = $row['subforumId'];
                            $q2 = "SELECT * FROM subforum WHERE id = '$subID'";
                            $r = mysqli_query($db, $q2);
                            $row2 = mysqli_fetch_assoc($r);
                            $subName = $row2['sname'];
                            $color = $row2['color'];

                            $creator = $row["userId"];
                            $q3 = "SELECT * FROM users WHERE id = '$creator'";
                            $r4 = mysqli_query($db, $q3);
                            $row3 = mysqli_fetch_assoc($r4);
                            $creatorName = $row3['username'];

                            echo
                                '<article>
                                            <div class="media text-muted pt-3">
                                                <svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $color . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="media-body">
                                                    <a href="post.php?id=' . $row['id'] . '&title=' . $row['title'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                    <strong class="d-block text-gray-dark article-title">' . $row['title'] . '</strong></a>' . strip_tags(mb_strimwidth($row['content'], 0, 125, "..."), '<br/>') . '<br>
                                                    <small>Posted by: <a class="article-b-links" href="user.php?username=' . $creatorName . '">' . $creatorName . '</a>&nbsp;|&nbsp;Posted in: <a class="article-b-links" href="sub.php?r=' . $subName . '">' . $subName . '</a>&nbsp;|&nbsp;<a href="post.php?id=' . $row['id'] . '&title=' . $row['title'] . '#comments-seccion">Comments(' . $row['numComments'] . ')</a></small></p>
                                                </div>
                                            </div>
                                        </article>';
                        }
                    }
                }
                ?>

                <nav class="mt-4" aria-label="Page navigation example">
                    <ul class="pagination">
                        <!--- Prev --->
                        <?php if ($page_num > 1) : ?>
                            <li class="page-item"><a class="page-link" <?php echo "href=?page_num=$previous_page"; ?>>Prev</a></li>
                        <?php endif ?>

                        <!--- Next --->
                        <?php if ($page_num < $total_num_of_pages) : ?>
                            <li class="page-item"><a class="page-link" <?php echo "href=?page_num=$next_page"; ?>>Next</a></li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
            <?php include('includes/right_side_bar.php'); ?>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>