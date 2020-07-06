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
$userRank = $rowd['uRank'];

$sub_color = $rsd['color'];

$logedUser = $_SESSION['username'];
?>
<?php
$title = "Devuger - $username";

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
						<title>Profile: <?php echo $username; ?></title>
						<rect width="100%" height="100%" fill="<?php echo $color; ?>" /><text x="50%" y="50%" fill="" dy=".3em"></text>
					</svg><b><?php echo $username; ?></b></h2>
				<small>Rank: <?php echo $userRank; ?></small>
				<small>&nbsp;&nbsp; | &nbsp;&nbsp;</small><small>Member since: <?php echo $creationDate; ?></small>
				<div class="descp py-3 mb-3">
					<div class="content-border">
						<p class="pl-2 content"><?php echo nl2br($descp); ?></p>
					</div>
				</div>
				<h3>Latest post made:</h3>
				<hr class="border-bottom border-gray">
				<?php

				$query_get_user_posts = "SELECT * FROM posts WHERE userId = '$u_ID' ORDER BY id DESC LIMIT $offset, $total_posts_per_page";
				$get_user_posts = mysqli_query($db, $query_get_user_posts);

				if (mysqli_num_rows($get_user_posts) > 0) {
					while ($get_user_posts_row = mysqli_fetch_assoc($get_user_posts)) {

						$subforumId = $get_user_posts_row['subforumId'];
						$q2 = "SELECT * FROM subforum WHERE id = '$subforumId'";
						$rs = mysqli_query($db, $q2);
						$row2 = mysqli_fetch_assoc($rs);
						$sub_color = $row2['color'];
						$sub_name = $row2['sname'];

						echo
							'<article>
											<div class="media text-muted pt-3">
												<svg class="bd-placeholder-img mr-2 rounded mt-3" style="opacity: 0.7;filter: alpha(opacity=70);" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label=""><title></title><rect width="100%" height="100%" fill="' . $sub_color . '"/><text x="50%" y="50%" fill="" dy=".3em"></text></svg>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="media-body">
													<a href="post.php?id=' . $get_user_posts_row['id'] . '&title=' . $get_user_posts_row['title'] . '"><p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
													<strong class="d-block text-gray-dark article-title">' . $get_user_posts_row['title'] . '</strong></a>' . strip_tags(mb_strimwidth($get_user_posts_row['content'], 0, 125, "..."), '<br/>') . '<br>
													<small>Posted by: <a class="article-b-links" href="user.php?username=' . $u . '">' . $u . '</a>&nbsp;|&nbsp;Posted in: <a class="article-b-links" href="sub.php?r=' . $sub_name . '">' . $sub_name . '</a>&nbsp;|&nbsp;<a href="post.php?id=' . $get_user_posts_row['id'] . '&title=' . $get_user_posts_row['title'] . '#comments-seccion">Comments(' . $get_user_posts_row['numComments'] . ')</a></small></p>
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
			<div class="col-md-3">
				<h4>Sub-Forums followed:</h4>
				<hr class="border-bottom border-gray">

				<?php
				$query_get_followed_forums = "SELECT * FROM subforum WHERE id IN (SELECT subId FROM subscriptions WHERE userId = '$u_ID') ORDER BY id DESC";
				$get_user_followed_forums = mysqli_query($db, $query_get_followed_forums);

				if (mysqli_num_rows($get_user_followed_forums) > 0) {
					while ($get_user_followed_forums_rows = mysqli_fetch_assoc($get_user_followed_forums)) {
						echo '<small><p><a href="sub.php?r=' . $get_user_followed_forums_rows['sname'] . '">' . $get_user_followed_forums_rows['sname'] . '</a></p></small>';
					}
				}
				?>

			</div>
		</div>

		<div class="row">
			<?php if ($username == $logedUser) : ?>
				<div class="col-md-12 text-center mt-5 py-5">
					<h5>Settings</h5>
					<hr class="border-bottom border-gray">

					<p><a href="javascript:void();" id="Show_Edit_Username">Edit Username</a>&nbsp;&nbsp; | &nbsp;&nbsp;
						<a href="javascript:void();" id="Show_Edit_Password">Edit Password</a>&nbsp;&nbsp; | &nbsp;&nbsp;
						<a href="javascript:void();" id="Show_Edit_Email">Edit Email</a>&nbsp;&nbsp; | &nbsp;&nbsp;
						<a href="javascript:void();" id="Show_Edit_Description">Edit Description</a>&nbsp;&nbsp; | &nbsp;&nbsp;
						<a href="javascript:void();" id="Show_Edit_Profile_Color">Edit Profile Color</a></p>

					<?php include('php/errors.php'); ?>
				</div>

			<?php endif ?>
		</div>
		<?php if ($username == $logedUser) : ?>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 text-center mt-4" id="Show_Edit_Username_Div">
					<form action="user.php?username=<?php echo $username; ?>" method="post">
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
						<button class="btn btn-primary float-right ml-2" type="button" id="close_username">Close</button>
						<button type="submit" id="Submit_New_Username" class="btn btn-primary float-right" name="save_changes_username">Save changes</button>
					</form>
				</div>
				<div class="col-md-6 text-center mt-4" id="Show_Edit_Password_Div">
					<form action="user.php?username=<?php echo $username; ?>" method="post">
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
						<button class="btn btn-primary float-right ml-2" type="button" id="close_password">Close</button>
						<button type="submit" id="Submit_New_Password" class="btn btn-primary float-right" name="save_changes_password">Save changes</button>
					</form>
				</div>
				<div class="col-md-6 text-center mt-4" id="Show_Edit_Email_Div">
					<form action="user.php?username=<?php echo $username; ?>" method="post">
						<div class="input-group">
							<div class="input-group-text">Current email</div>
							<input class="form-control" type="email" name="current_email" required>
						</div>
						<br>
						<div class="input-group">
							<div class="input-group-text">New email</div>
							<input class="form-control" type="email" name="new_email" required>
						</div>
						<br>
						<button class="btn btn-primary float-right ml-2" type="button" id="close_email">Close</button>
						<button type="submit" id="Submit_New_Email" class="btn btn-primary float-right" name="save_changes_email">Save changes</button>
					</form>
				</div>
				<div class="col-md-6 text-center mt-4" id="Show_Edit_Description_Div">
					<form action="user.php?username=<?php echo $username; ?>" method="post">
						<div class="input-group">
							<textarea class="form-control rounded-0" rows="5" name="user_edit_description"><?php echo nl2br($descp); ?></textarea>
						</div>
						<br>
						<button class="btn btn-primary float-right ml-2" type="button" id="close_descp">Close</button>
						<button type="submit" id="Submit_New_Description" class="btn btn-primary float-right" name="save_changes_descp">Save changes</button>
					</form>
				</div>
				<div class="col-md-6 text-center mt-4" id="Show_Edit_Color_Div">
					<form action="user.php?username=<?php echo $username; ?>" method="post">

						<input type="text" id="hex" style="display: none" name="hexcolor">
						<input type="color" id="color">

						<br>
						<button class="btn btn-primary float-right ml-2" type="button" id="close_color">Close</button>
						<button type="submit" id="Submit_New_Color" class="btn btn-primary float-right" name="save_changes_color">Save changes</button>
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
		<?php endif ?>
	</div>
</main>

<?php include('includes/footer.php'); ?>