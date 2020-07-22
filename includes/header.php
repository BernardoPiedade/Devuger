<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" type="image/png" href="img/favicon.png">
	<title><?php echo $title; ?></title>

	<!--- BS CSS --->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!--- CUSTOM CSS --->
	<link rel="stylesheet" href="css/main.css">

	<!--- FONTS --->
	<!--- FONTAWESOME --->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

	<!--- GOOGLE --->
	<link href="https://fonts.googleapis.com/css?family=PT+Serif&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<a class="navbar-brand green" href="index.php">Devuger |</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsExample04">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home Page</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="findforums.php">Find New Forums</a>
					</li>

					<?php if (isset($_SESSION['username'])) : ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Me</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="user.php?username=<?php echo $_SESSION['username']; ?>">Profile: <b><?php echo $_SESSION['username']; ?></b></a>
								<a class="dropdown-item" href="send_post.php">Create Post</a>
								<a class="dropdown-item" href="index.php?logout='1'">Logout</a>
							</div>
						</li>
					<?php elseif (!isset($_SESSION['username'])) : ?>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
					<?php endif ?>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<form action="search.php" method="get">
							<div class="input-group">
								<input type="text" class="form-control" name="search_terms" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="submit" name="search" id="button-addon2">Search</button>
								</div>
							</div>
						</form>
					</li>
				</ul>
			</div>
		</nav>
	</header>