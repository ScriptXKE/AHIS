<?php
if(count($result)>0)
{
    $person=$result[0];
}else
{
    
}
?>
<div class="row-fluid">
    <div class="span6">
        <div class="w-box">
            <div class="w-box-header">
                <h4>Person Profile</h4>
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
                        <p class="formSep"><small class="muted">Name:</small> <?php echo $person->firstname . ' ' . $person->surname; ?></p>
                        <p class="formSep"><small class="muted">Username:</small> <?php echo $person->firstname; ?></p>
                        <p class="formSep"><small class="muted">Gender:</small> <?php echo ucfirst(strtolower($person->gender)); ?></p>
                        <p class="formSep"><small class="muted">Birthday:</small> <?php echo date('jS F Y', strtotime($person->birthdate)); ?></p>
                        <p class="formSep"><small class="muted">Email:</small> <?php echo $person->email; ?></p>
                        <p class="formSep"><small class="muted">Telephone:</small> <?php echo $person->telephone; ?></p>
                        <!-- <p class="formSep"><small class="muted">Languages:</small> English, Arabic</p> -->
                        <p class="formSep"><small class="muted">Description:</small> <?php echo $person->biodata; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="w-box">
            <div class="w-box-header">
                <h4>Edit This Person's Bio Data</h4>
            </div>
            <div class="w-box-content">
                <form id="profile-update" action="<?php current_url(); ?>" method="post">
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
                        <label for="u_firstname">Name(s) in Full:</label>
                        <input type="text" id="u_firstname" name="u_firstname" class="span8" placeholder="First Name" value="<?php echo $person->firstname; ?>" />
                        <span class="help-block">First Name</span>
                        <input type="text" id="u_surname" name="u_surname" class="span8" placeholder="Surname" value="<?php echo $person->surname; ?>" />
                        <span class="help-block">Surname</span>
                        <input type="text" id="u_othernames" name="u_othernames" class="span8" placeholder="Other Name(s)" value="<?php echo $person->othernames; ?>" />
                        <span class="help-block">Other Name(s)</span>
                    </div>
                    <div class="formSep">
                        <label for="u_email">Email</label>
                        <input type="text" id="u_email" name="u_email" class="span8" value="<?php echo $person->email; ?>" />
                    </div>
                    <div class="formSep">
                        <label for="u_telephone">Telephone</label>
                        <input type="text" id="u_telephone" name="u_telephone" class="span8" value="<?php echo $person->telephone; ?>" />
                    </div>
                    <div class="formSep">
                        <label>Gender</label>


                        <?php
                        $male = array(
                            'name' => 'u_gender',
                            'id' => 'u_male',
                            'value' => 'Male',
                            'checked' => $person->gender == 'male' ? true : false,
                            'type' => 'radio'
                        );
                        $female = array(
                            'name' => 'u_gender',
                            'id' => 'u_female',
                            'value' => 'Female',
                            'checked' => $person->gender == 'female' ? true : false,
                            'type' => 'radio'
                        );
                        ?>
                        <label for="u_male" class="radio inline"><?php echo form_checkbox($male); ?> Male</label>
                        <label for="u_female" class="radio inline"><?php echo form_checkbox($female); ?> Female</label>
                    </div>
                    <div class="formSep">
                        <label for="u_birthdate">Birthday</label>
                        <input type="text" id="u_birthdate" name="u_birthdate" class="span8" value="<?php echo $person->birthdate; ?>" />
                    </div>
                    <div class="formSep">
                        <label for="u_biodata">Description</label>
                        <textarea name="u_biodata" id="u_biodata" cols="30" rows="4" class="span8"><?php echo $person->biodata; ?></textarea>
                    </div>
                    <div class="formSep sepH_b">
                        <button class="btn btn-ahis-3" type="submit">Save changes</button>
                        <a href="#" class="btn btn-link">Cancel</a>
                    </div>
                    <?php echo form_hidden('id', $person->id) ?>
                </form>
            </div>
        </div>
    </div>
</div>