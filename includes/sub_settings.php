			<div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center" id="Show_Edit_Username_Div">
                    <form action="sub.php?r=<?php echo $forum_name; ?>" method="post">
                        <div class="input-group">
                            <div class="input-group-text">Current Sub-Forum Name</div>
                            <input class="form-control" type="text" name="current_subforum_name" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-text">New Sub-Forum Name</div>
                            <input class="form-control" type="text" name="new_subforum_name" required>
                        </div>
                        <br>
                        <button class="btn btn-primary float-right ml-2" type="button" id="close_username">Close</button>
                        <button type="submit" id="Submit_New_Username" class="btn btn-primary float-right" name="save_changes_username">Save changes</button>
                    </form>
                </div>

                <div class="col-md-6 text-center" id="Show_Edit_Password_Div">
                    <form action="sub.php?r=<?php echo $forum_name; ?>" method="post">
                        <div class="input-group">
                            <input type="text" name="sub_name" value="<?php echo $forum_name; ?>" style="display: none;">
                            <textarea class="form-control rounded-0" rows="5" name="user_edit_rules"><?php echo nl2br($rules); ?></textarea>
                        </div>
                        <br>
                        <button class="btn btn-primary float-right ml-2" type="button" id="close_password">Close</button>
                        <button type="submit" id="Submit_New_Password" class="btn btn-primary float-right" name="save_changes_password">Save changes</button>
                    </form>
                </div>

                <div class="col-md-6 text-center" id="Show_Edit_Description_Div">
                    <form action="sub.php?r=<?php echo $forum_name; ?>" method="post">
                        <div class="input-group">
                            <input type="text" name="sub_name" value="<?php echo $forum_name; ?>" style="display: none;">
                            <textarea class="form-control rounded-0" rows="5" name="user_edit_description"><?php echo nl2br($descp); ?></textarea>
                        </div>
                        <br>
                        <button class="btn btn-primary float-right ml-2" type="button" id="close_descp">Close</button>
                        <button type="submit" id="Submit_New_Description" class="btn btn-primary float-right" name="save_changes_descp">Save changes</button>
                    </form>
                </div>

                <div class="col-md-6 text-center" id="Show_Edit_Color_Div">
                    <form action="sub.php?r=<?php echo $forum_name; ?>" method="post">

                        <input type="color" id="color">
                        <input type="text" id="hex" style="display: none" name="hexcolor">
                        <input type="text" name="sub_name" value="<?php echo $forum_name; ?>" style="display: none;">
                        <br>
                        <button class="btn btn-primary float-right ml-2" type="button" id="close_color">Close</button>
                        <button type="submit" id="Submit_New_Color" class="btn btn-primary float-right" name="save_changes_color">Save changes</button>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>