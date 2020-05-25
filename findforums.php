<?php include('php/server.php'); ?>
<?php
    $title = "Devuger - Find New Forums";
?>
<?php include('includes/header.php'); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-9 py-3">
                    <?php 

                        $query = "SELECT * FROM subreddit ORDER BY numPosts DESC";
                        $q = mysqli_query($db, $query);
                    
                        if(mysqli_num_rows($q) > 0)
                        {
                            while($row = mysqli_fetch_assoc($q))
                            {
                                if($row['subscribers'] == 0){$row['subscribers'] = 0;}
                                echo 
                                    '<article>
                                        <div class="media text-muted pt-3">
                                            <svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="'.$row['color'].'"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="media-body">
                                                <a href="sub.php?r='.$row['sname'].'"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                <strong class="d-block text-gray-dark article-title">'.$row['sname'].'</strong></a>'.mb_strimwidth($row['descp'], 0, 125, "...").'<br>
                                                <small>Num of subscribers: '.$row['subscribers'].'&nbsp;|&nbsp;Created on: '.$row['creationDate'].'</small></p>
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