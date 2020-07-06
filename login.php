<?php include('php/server.php'); ?>
<?php
$title = "Devuger - Login";

if (isset($_SESSION['username'])) {
    header('location: index.php');
}
?>
<?php include('includes/header.php'); ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-6 py-4">
                <form method="post" action="login.php">
                    <?php include('php/errors.php'); ?>
                    <div class="input-group">
                        <div class="input-group-text">Username</div>
                        <input class="form-control" type="text" name="username">
                    </div>
                    <div class="input-group">
                        <div class="input-group-text">Email</div>
                        <input class="form-control" type="email" name="email">
                    </div>
                    <div class="input-group">
                        <div class="input-group-text">Password</div>
                        <input class="form-control" type="password" name="password_1">
                    </div>
                    <div class="input-group">
                        <div class="input-group-text">Confirm password</div>
                        <input class="form-control" type="password" name="password_2">
                    </div>
                    <div class="input-group">
                        <button class="form-control btn btn-primary" type="submit" name="reg_user">Register</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 py-4 align-self-center">
                <form method="post" action="login.php">
                    <?php include('php/errors.php'); ?>
                    <div class="input-group">
                        <div class="input-group-text">Username</div>
                        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                    </div>
                    <div class="input-group">
                        <div class="input-group-text">Password</div>
                        <input class="form-control" type="password" name="password" value="<?php echo $email; ?>">
                    </div>
                    <div class="input-group">
                        <p><input type="checkbox" name="remember" /> Remember me</p>
                    </div>
                    <div class="input-group">
                        <button class=" form-control btn btn-primary" type="submit" name="login_user">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!--- BS JS --->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>