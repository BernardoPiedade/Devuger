<?php include('php/server.php'); ?>
<?php include('php/sendpost.php'); ?>
<?php
$title = "Devuger - Create Post";

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
?>
<?php include('includes/header.php'); ?>

<?php if (!isset($_SESSION['username'])) : ?>

    <main class="content-wrapper">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-12 text-center">
                    <br><br><br><br>
                    <h1>Oh boy :/ login first!</h1>
                    <p><a class="green" href="login.php">click here to login buddy :)</a></p>
                </div>
            </div>
        </div>
    </main>

<?php elseif (isset($_SESSION['username'])) : ?>

    <main class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <br><br>
                    <form method="post" action="send_post.php">
                        <div>
                            <label><b>Title:</b></label>
                            <input class="form-control" type="text" name="post_title" required>
                        </div>
                        <br>
                        <div>
                            <label><b>Content:</b></label>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10" name="post_content"></textarea>
                        </div>
                        <br>
                        <div>
                            <label><b>Post to:</b></label>
                            <input id="sub-to" class="form-control" type="text" name="post_to" required>
                            <?php
                            $u = $_SESSION['username'];

                            $b = "SELECT * FROM users WHERE username = '$u'";
                            $r = mysqli_query($db, $b);
                            $row = mysqli_fetch_assoc($r);
                            $id = $row['id'];

                            $query = "SELECT DISTINCT(sname) FROM subforum WHERE id IN(SELECT subId FROM subscriptions WHERE userId = '$id') ORDER BY sname LIMIT 20";
                            $q = mysqli_query($db, $query);

                            $subs = array();

                            $pos = 0;
                            if (mysqli_num_rows($q) > 0) {

                                while ($row = mysqli_fetch_assoc($q)) {
                                    foreach ($row as $i => $value) {
                                        $subs[$pos] = $row['sname'];
                                        $pos++;
                                    }
                                }

                                echo '<p>';
                                for ($i = 0; $i < count($subs); $i++) {
                                    echo '<span class="subs-span green" id="' . $subs[$i] . '" onclick="clicado(this.id);">' . $subs[$i] . '</span>&nbsp;&nbsp;';
                                }
                                echo '<p>';
                            }
                            ?>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-green mb-2" type="submit" name="post_send">Send Post</button>
                    </form>
                </div>
                <?php include('includes/right_side_bar.php'); ?>
            </div>
        </div>
    </main>

<?php endif ?>

<?php include('includes/footer.php'); ?>