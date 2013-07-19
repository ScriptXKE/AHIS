<div class="row-fluid">
    <div class="span6">
        <div class="w-box">
            <div class="w-box-header">
                <h4>User profile</h4>
            </div>
            <div class="w-box-content cnt_a user_profile">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="img-holder">
                            <img class="img-avatar" alt="" src="<?php echo base_url(); ?>assets/avatars/<?php echo $this->session->userdata('avatar'); ?>">
                        </div>
                    </div>
                    <div class="span10">
                        <p class="formSep"><small class="muted">Verified:</small> <span class="label label-success">Yes</span></p>
                        <p class="formSep"><small class="muted">Username:</small> <?php echo $user_details['username']; ?></p>
                        <p class="formSep"><small class="muted">Name:</small> <?php echo $user_details['firstname'] . ' ' . $user_details['surname']; ?></p>
                        <p class="formSep"><small class="muted">Gender:</small> <?php echo ucfirst(strtolower($user_details['gender'])); ?></p>
                        <p class="formSep"><small class="muted">Birthday:</small> 24/06/1974</p>
                        <p class="formSep"><small class="muted">Email:</small> <?php echo $user_details['email']; ?></p>
                        <p class="formSep"><small class="muted">Access Level:</small> Veterinarian</p>
                        <p class="formSep"><small class="muted">Languages:</small> English, Arabic</p>
                        <p class="formSep"><small class="muted">Description:</small> <?php echo $user_details['biodata']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="w-box">
            <div class="w-box-header">
                <h4>User settings</h4>
            </div>
            <div class="w-box-content">
                <form id="profile-update" action="<?php echo base_url()."user/profile"; ?>" method="post">
                    <div class="formSep">
                        <label>Avatar</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 60px; height: 60px;"><img src="<?php echo base_url(); ?>img/dummy_60x60.gif" alt="" ></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 60px; height: 60px;"></div>
                            <span class="btn btn-small btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file"></span>
                            <a href="#" class="btn btn-small btn-link fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                    <div class="formSep">
                        <label for="u_username">Username</label>
                        <input type="text" id="u_username" name="u_username" class="span8" value="<?php echo $user_details['username']; ?>" readonly />
                    </div>
                    <div class="formSep">
                        <label for="u_firstname">Name(s) in Full:</label>
                        <input type="text" id="u_firstname" name="u_firstname" class="span8" placeholder="First Name" value="<?php echo $user_details['firstname']; ?>" />
                        <span class="help-block">First Name</span>
                        <input type="text" id="u_surname" name="u_surname" class="span8" placeholder="Surname" value="<?php echo $user_details['surname']; ?>" />
                        <span class="help-block">Surname</span>
                        <input type="text" id="u_othernames" name="u_othernames" class="span8" placeholder="Other Name(s)" value="<?php echo $user_details['othernames']; ?>" />
                        <span class="help-block">Other Name(s)</span>
                    </div>
                    <div class="formSep">
                        <label for="u_password">Password</label>
                        <input type="password" id="u_password" name="u_password" class="span8" />
                        <span class="help-block">Enter Password</span>
                        <input type="password" id="u_repassword" name="u_repassword" class="span8" />
                        <span class="help-block">Repeat Password</span>
                    </div>
                    <div class="formSep">
                        <label for="u_email">Email</label>
                        <input type="text" id="u_email" name="u_email" class="span8" value="<?php echo $user_details['email']; ?>" />
                    </div>
                    <div class="formSep">
                        <label>Gender</label>
                        <label for="u_male" class="radio inline"><input type="radio" name="u_gender" id="u_male"/> Male</label>
                        <label for="u_female" class="radio inline"><input type="radio" name="u_gender" id="u_female"/> Female</label>
                    </div>
                    <div class="formSep">
                        <label>Clearance Level:</label>
                        <label for="u_newsletter" class="checkbox inline"><input type="checkbox" name="u_newsletter" id="u_newsletter"/> Veterinarian</label>
                        <label for="u_system_msg" class="checkbox inline"><input type="checkbox" name="u_system_msg" id="u_system_msg"/> Field Officer</label>
                        <label for="u_other_msg" class="checkbox inline"><input type="checkbox" name="u_other_msg" id="u_other_msg"/> System Admin</label>
                    </div>
                    <div class="formSep">
                        <label for="u_signature">Description</label>
                        <textarea name="u_signature" id="u_signature" cols="30" rows="4" class="span8"><?php echo $user_details['biodata']; ?></textarea>
                    </div>
                    <div class="formSep sepH_b">
                        <button class="btn btn-ahis-3" type="submit">Save changes</button>
                        <a href="#" class="btn btn-link">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>