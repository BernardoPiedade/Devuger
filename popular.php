<?php include('php/server.php'); ?>
<?php
    $title = "Devuger - Popular Posts";
?>
<?php include('includes/header.php'); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-9 py-3">
                    <?php 

                        $query = "SELECT * FROM posts ORDER BY numComments DESC";
                        $q = mysqli_query($db, $query);
                    
                        if(mysqli_num_rows($q) > 0)
                        {
                            while($row = mysqli_fetch_assoc($q))
                            {
                                $name = $row['subredditName'];
                                $q2 = "SELECT * FROM subreddit WHERE sname = '$name'";
                                $r = mysqli_query($db, $q2);
                                $row2 = mysqli_fetch_assoc($r);
                                $color = $row2['color'];

                                echo 
                                    '<article>
                                        <div class="media text-muted pt-3">
                                            <svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="'.$color.'"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="media-body">
                                                <a href="post.php?id='.$row['id'].'&title='.$row['title'].'"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                <strong class="d-block text-gray-dark article-title">'.$row['title']. '</strong></a>' . strip_tags(mb_strimwidth($row['content'], 0, 125, "..."), '<br/>') . '<br>
                                                <small>Posted by: <a class="article-b-links" href="user.php?username='.$row['userName'].'">'.$row['userName'].'</a>&nbsp;|&nbsp;Posted in: <a class="article-b-links" href="sub.php?r='.$row['subredditName'].'">'.$row['subredditName'].'</a>&nbsp;|&nbsp;<a href="post.php?id='.$row['id'].'&title='.$row['title'].'#comments-seccion">Comments('.$row['numComments'].')</a></small></p>
                                            </div>
                                        </div>
                                    </article>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>

<?php include('includes/footer.php'); ?>