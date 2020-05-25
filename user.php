<?php include('php/server.php'); ?>
<?php
session_start();

$username = $_GET['username'];

$a = "SELECT * FROM users WHERE username = '$username'";
$r = mysqli_query($db, $a);
$rowd = mysqli_fetch_assoc($r);

$u_ID = $rowd['id'];
$u = $rowd['username'];
$descp = $rowd['descp'];
$color = $rowd['color'];
$creationDate = $rowd['creationDate'];

$sub_color = $rsd['color'];

$logedUser = $_SESSION['username'];
?>
<?php
$title = "Devuger - $username";

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
}
?>
<?php include('php/updateProfileSettings.php'); ?>
<?php include('includes/header.php'); ?>

<main>
	<div class="container py-4">
		<div class="row">
			<div class="col-md-3">
				<svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="">
					<title>Profile: <?php echo $username; ?></title>
					<rect width="100%" height="100%" fill="<?php echo $color; ?>" /><text x="50%" y="50%" fill="" dy=".3em"></text>
				</svg>
				<hr class="border-bottom border-gray">

				<?php if ($username == $logedUser) : ?>

					<p><a href="#" id="Show_Edit_Username">Edit Username</a></p>
					<p><a href="#" id="Show_Edit_Password">Edit Password</a></p>
					<p><a href="#" id="Show_Edit_Email">Edit Email</a></p>
					<p><a href="#" id="Show_Edit_Description">Edit Description</a></p>
					<p><a href="#" id="Show_Edit_Profile_Color">Edit Profile Color</a></p>

				<?php endif ?>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<h2><b><?php echo $username; ?></b></h2>
				<small>Member since: <?php echo $creationDate; ?></small>
				<div class="descp py-3 mb-3">
					<div class="content-border">
						<p class="pl-2 content"><?php echo $descp; ?></p>
					</div>
				</div>
				<h3>Latest post made:</h3>
				<hr class="border-bottom border-gray">
				<?php

				$query_get_user_posts = "SELECT * FROM posts WHERE userId = '$u_ID' ORDER BY id DESC";
				$get_user_posts = mysqli_query($db, $query_get_user_posts);

				if (mysqli_num_rows($get_user_posts) > 0) {
					while ($get_user_posts_row = mysqli_fetch_assoc($get_user_posts)) {

						$name = $get_user_posts_row['subredditName'];
						$q2 = "SELECT * FROM subreddit WHERE sname = '$name'";
						$rs = mysqli_query($db, $q2);
						$row2 = mysqli_fetch_assoc($rs);
						$sub_color = $row2['color'];

						echo
							'<article>
											<div class="media text-muted pt-3">
												<svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $sub_color . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="media-body">
													<a href="post.php?id=' . $get_user_posts_row['id'] . '&title=' . $get_user_posts_row['title'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
													<strong class="d-block text-gray-dark article-title">' . $get_user_posts_row['title'] . '</strong></a>' . strip_tags(mb_strimwidth($get_user_posts_row['content'], 0, 125, "..."), '<br/>') . '<br>
													<small>Posted by: <a class="article-b-links" href="user.php?username=' . $get_user_posts_row['userName'] . '">' . $get_user_posts_row['userName'] . '</a>&nbsp;|&nbsp;Posted in: <a class="article-b-links" href="sub.php?r=' . $get_user_posts_row['subredditName'] . '">' . $get_user_posts_row['subredditName'] . '</a>&nbsp;|&nbsp;<a href="post.php?id=' . $get_user_posts_row['id'] . '&title=' . $get_user_posts_row['title'] . '#comments-seccion">Comments(' . $get_user_posts_row['numComments'] . ')</a></small></p>
												</div>
											</div>
										</article>';
					}
				}


				?>
			</div>
			<div class="col-md-3">
				<h4>Sub-Forums followed:</h4>
				<hr class="border-bottom border-gray">

				<?php
				$query_get_followed_forums = "SELECT * FROM subreddit WHERE id IN (SELECT subId FROM subscriptions WHERE userId = '$u_ID') ORDER BY id DESC";
				$get_user_followed_forums = mysqli_query($db, $query_get_followed_forums);

				if (mysqli_num_rows($get_user_followed_forums) > 0) {
					while ($get_user_followed_forums_rows = mysqli_fetch_assoc($get_user_followed_forums)) {
						echo '<small><p><a href="sub.php?r=' . $get_user_followed_forums_rows['sname'] . '">' . $get_user_followed_forums_rows['sname'] . '</a></p></small>';
					}
				}
				?>

			</div>
		</div>

		<?php if ($username == $logedUser) : ?>

			<!--- Show_Edit_Username --->
			<div class="modal fade" id="Show_Edit_Username_Modal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edit Username</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form action="user.php?username=<?php $username; ?>" method="post">
								<div class="input-group">
									<div class="input-group-text">Current username</div>
									<input class="form-control" type="text" name="current_username" required>
								</div>
								<br>
								<div class="input-group">
									<div class="input-group-text">New username</div>
									<input class="form-control" type="text" name="new_username" required>
								</div>
								<br>
								<button type="submit" class="btn btn-primary float-right" name="save_changes_username">Save changes</button>
							</form>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>

			<!--- Show_Edit_Password --->
			<div class="modal fade" id="Show_Edit_Password_Modal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edit Password</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form action="user.php?username=<?php $username; ?>" method="post">
								<div class="input-group">
									<div class="input-group-text">Current password</div>
									<input class="form-control" type="password" name="current_password" required>
								</div>
								<br>
								<div class="input-group">
									<div class="input-group-text">New password</div>
									<input class="form-control" type="password" name="new_password" required>
								</div>
								<br>
								<button type="submit" class="btn btn-primary float-right" name="save_changes_password">Save changes</button>
							</form>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>

			<!--- Show_Edit_Email --->
			<div class="modal fade" id="Show_Edit_Email_Modal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edit Email</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form action="user.php?username=<?php $username; ?>" method="post">
								<div class="input-group">
									<div class="input-group-text">Current email</div>
									<input class="form-control" type="text" name="current_email" required>
								</div>
								<br>
								<div class="input-group">
									<div class="input-group-text">New email</div>
									<input class="form-control" type="text" name="new_email" required>
								</div>
								<br>
								<button type="submit" class="btn btn-primary float-right" name="save_changes_email">Save changes</button>
							</form>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>

			<!--- Show_Edit_Description --->
			<div class="modal fade" id="Show_Edit_Description_Modal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edit Description</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form action="user.php?username=<?php $username; ?>" method="post">
								<div class="input-group">
									<textarea class="form-control rounded-0" rows="5" name="user_edit_description" required><?php echo $descp; ?></textarea>
								</div>
								<br>
								<button type="submit" class="btn btn-primary float-right" name="save_changes_username">Save changes</button>
							</form>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>

			<!--- Show_Edit_Profile_Color --->
			<div class="modal fade" id="Show_Edit_Profile_Color_Modal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edit Profile Color</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form action="user.php?username=<?php $username; ?>" method="post">
								<div class="input-group">
									<div class="input-group-text">Current username</div>
									<input class="form-control" type="text" name="current_username" required>
								</div>
								<br>
								<div class="input-group">
									<div class="input-group-text">New username</div>
									<input class="form-control" type="text" name="new_username" required>
								</div>
								<br>
								<button type="submit" class="btn btn-primary float-right" name="save_changes_username">Save changes</button>
							</form>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>

		<?php endif ?>

	</div>
</main>

<?php include('includes/footer.php'); ?>