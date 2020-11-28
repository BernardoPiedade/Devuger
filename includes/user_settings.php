			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 text-center" id="Show_Edit_Username_Div">
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
				<div class="col-md-6 text-center" id="Show_Edit_Password_Div">
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
				<div class="col-md-6 text-center" id="Show_Edit_Email_Div">
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
				<div class="col-md-6 text-center" id="Show_Edit_Description_Div">
					<form action="user.php?username=<?php echo $username; ?>" method="post">
						<div class="input-group">
							<textarea class="form-control rounded-0" rows="5" name="user_edit_description"><?php echo nl2br($descp); ?></textarea>
						</div>
						<br>
						<button class="btn btn-primary float-right ml-2" type="button" id="close_descp">Close</button>
						<button type="submit" id="Submit_New_Description" class="btn btn-primary float-right" name="save_changes_descp">Save changes</button>
					</form>
				</div>
				<div class="col-md-6 text-center" id="Show_Edit_Color_Div">
					<form action="user.php?username=<?php echo $username; ?>" method="post">

						<input type="color" id="color">
						<input type="text" id="hex" style="display: none" name="hexcolor">

						<br>
						<button class="btn btn-primary float-right ml-2" type="button" id="close_color">Close</button>
						<button type="submit" id="Submit_New_Color" class="btn btn-primary float-right" name="save_changes_color">Save changes</button>
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>