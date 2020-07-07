<div class="col-md-3 py-3">
    <div>
        <h4>Popular Posts:</h4>
        <hr class="border-bottom border-gray">
        <?php 

            $get_random_posts_with_comments = mysqli_query($db, "SELECT * FROM posts WHERE numComments >= 3 ORDER BY numComments DESC LIMIT 5");

            if(mysqli_num_rows($get_random_posts_with_comments) > 0)
            {
                while($run_query_get_random_posts = mysqli_fetch_assoc($get_random_posts_with_comments))
                {
                    echo '<h6><a class="green" href="post.php?id=' . $run_query_get_random_posts['id'] . '&title=' . $run_query_get_random_posts['title'] . '">' . $run_query_get_random_posts['title'] . '</a></h6>';
                }
            }
        
        ?>
    </div>
</div>