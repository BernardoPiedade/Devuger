<?php include('php/server.php'); ?>
<?php
$title = "Devuger - Find New Forums";
?>
<?php include('includes/header.php'); ?>

<?php

if (isset($_GET['search'])) {
    $search_terms = mysqli_real_escape_string($db, $_GET['search_terms']);

    // for forums
    $query_forums = "SELECT * FROM subforum WHERE sname LIKE '$search_terms%'";
    $run_forums_query = mysqli_query($db, $query_forums);

    // for users
    $query_users = "SELECT * FROM users WHERE username LIKE '$search_terms%'";
    $run_users_query = mysqli_query($db, $query_users);
}

?>

<main class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-9 py-3">
                <?php
                // forums
                if (mysqli_num_rows($run_forums_query) > 0) {
                    echo '<h5 class="text-center">Sub-Forums</h5>
                <hr class="border-bottom border-gray">';
                    while ($row_forums = mysqli_fetch_assoc($run_forums_query)) {
                        if ($row_forums['subscribers'] == 0) {
                            $row_forums['subscribers'] = 0;
                        }
                        echo
                            '<article>
                                        <div class="media text-muted pt-3">
                                            <svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $row_forums['color'] . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="media-body">
                                                <a href="sub.php?r=' . $row_forums['sname'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                <strong class="d-block text-gray-dark article-title">' . $row_forums['sname'] . '</strong></a>' . mb_strimwidth($row_forums['descp'], 0, 125, "...") . '<br>
                                                <small>Num of subscribers: ' . $row_forums['subscribers'] . '&nbsp;|&nbsp;Created on: ' . $row_forums['creationDate'] . '</small></p>
                                            </div>
                                        </div>
                                    </article>';
                    }
                }

                echo '<br><br>';
                // users
                if (mysqli_num_rows($run_users_query) > 0) {
                    echo '<h5 class="text-center">Users</h5>
                <hr class="border-bottom border-gray">';
                    while ($row_users = mysqli_fetch_assoc($run_users_query)) {
                        echo
                            '<article>
                                        <div class="media text-muted pt-3">
                                            <svg class="bd-placeholder-img mr-2 rounded mt-1" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $row_users['color'] . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="media-body">
                                                <a href="user.php?username=' . $row_users['username'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                <strong class="d-block text-gray-dark article-title">' . $row_users['username'] . '</strong></a></p>
                                            </div>
                                        </div>
                                    </article>';
                    }
                }

                if (mysqli_num_rows($run_users_query) <= 0 && mysqli_num_rows($run_forums_query) <= 0) {
                    echo '<h5 class="text-center">No users or sub-forums match your search :/ try another word buddy.</h5>';
                }

                ?>
            </div>
            <?php include('includes/right_side_bar.php'); ?>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>