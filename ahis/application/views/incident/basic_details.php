<div class="row-fluid">
<div class="span2">
    <div class="mbox_nav sidebar">
        <ul id="mypageNav">
            <!-- <li class="current"><a href="#">Basic Details</a></li>
            <li><a href="symptoms.html">Symptoms</a></li>
            <li><a href="surveillance.html">Surveillance</a></li>
            <li><a href="lab.html">Laboratory</a></li>
            <li><a href="prognosis.html">Prognosis</a></li> -->
            <?php echo $this->incident_model->incident_menu_items('basic_details'); ?>
        </ul>
    </div>
</div>
<div class="span10">

    <!-- START NEW INCIDENT FORM -->
    <form method="post" action="<?php echo base_url(); ?>incident/basic_details">
    <input type="hidden" name="serial_no" id="serial_no" value="<?php echo strtoupper(substr(md5(time()), 0, 10)); ?>" />
    <div class="w-box w-box-blue">
        <div class="w-box-header">
            <h4>New Incident - Basic Details</h4>
        </div>
        <div class="w-box-content cnt_a">
            <div class="row-fluid">
                <div class="span6">
                    <p class="heading_a">Incident Information</p>
                     <div class="formSep">
                        <label for="s_offline">SMS Details (select text messages related to the incident)</label>
                        <div id="list_basic" class="SMS-list scrollable-sms-div">
                        <?php if ($sms_listing->num_rows() > 0) { ?>
                        <ul>
                            <?php foreach ($sms_listing->result() as $sms_details) { ?>
                            <li class="incident-sms-details">
                                <span class="list-info inline-info incident-sms-checkbox"><input type="checkbox" name="sms_id[]" id="sms_id[]" value="<?php echo $sms_details->id; ?>" <?php echo set_checkbox('sms_id[]'); ?> /></span>
                                <span class="list-info"><?php echo $sms_details->phone_number; ?></span>
                                <span class="list-info sms-message-details"><?php echo $sms_details->description; ?></span>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php }  else { ?>
                        There are no SMS (text messages) in the system.
                        <?php } ?>
                        </div>
                     </div>

                    <div class="formSep">
                        <label for="description">A description about the incident</label>
                        <?php echo form_error('description'); ?>
                        <textarea name="description" id="description" cols="30" rows="6" class="span8" placeholder="Enter details about the incident here"><?php echo set_value('description'); ?></textarea>
                    </div>

                     <div class="formSep">
                        <label for="incident_reporter">Name of person reporting the incident:</label>
                        <?php echo form_error('incident_reporter'); ?>
                        <input type="text" id="incident_reporter" name="incident_reporter" class="span8" value="<?php echo set_value('incident_reporter'); ?>" placeholder="Name of incident reporter" />
                    </div>

                     <div class="formSep">
                        <label for="incident_reporter_phone">Phone number of person reporting the incident:</label>
                        <?php echo form_error('incident_reporter_phone'); ?>
                        <input type="text" id="incident_reporter_phone" name="incident_reporter_phone" class="span8" value="<?php echo set_value('incident_reporter_phone'); ?>" placeholder="Phone # of incident reporter" />
                    </div>
                   
                </div>
                <div class="span6">
                    <p class="heading_a">Incident Details</p>
                    <div class="formSep">
                        <label for="location_id">Town where incident is reported:</label>
                        <?php echo form_error('location_id'); ?>
                        <select name="location_id" id="location_id" class="span6">
                            <?php foreach ($town_listing->result() as $town) { ?>
                            <option value="<?php echo $town->id; ?>" <?php echo set_select('location_id'); ?>><?php echo ucwords(strtolower($town->name)); ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="formSep">
                        <label for="animal_id">Animal affected:</label>
                        <?php echo form_error('animal_id'); ?>
                        <select name="animal_id" id="animal_id" class="span6">
                            <?php foreach ($animal_listing->result() as $animal) { ?>
                            <option value="<?php echo $animal->id; ?>"><?php echo ucwords(strtolower($animal->name)); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                     <div class="formSep">
                    <label for="animal_herd_size">How many animals in the herd?</label>
                    <?php echo form_error('animal_herd_size'); ?>
                    <input type="text" id="animal_herd_size" name="animal_herd_size" class="span8" maxlength="6" value="<?php echo set_value('animal_herd_size'); ?>" size="10" maxlength="5" placeholder="No. of animals in herd / group" />
                </div>
                 <div class="formSep">
                    <label for="num_animals_affected">How many animals affected?</label>
                    <?php echo form_error('num_animals_affected'); ?>
                    <input type="text" id="num_animals_affected" name="num_animals_affected" class="span8" maxlength="6" value="<?php echo set_value('num_animals_affected'); ?>" placeholder="No. of animals affected" />
                </div>
                 <div class="formSep">
                    <label for="symptoms_duration">For how long have the symptoms been observed?</label>
                    <?php echo form_error('symptoms_duration'); ?>
                    <input type="text" id="symptoms_duration" name="symptoms_duration" class="span8" value="<?php echo set_value('symptoms_duration'); ?>" placeholder="No. of days / weeks of sickness" />
                </div>
                </div>
            </div>

    </div>
      <div class="w-box-footer">
            <div class="f-center">
                <button class="btn btn-ahis-3" type="submit">Save</button>
                <button class="btn btn-link inv-cancel" type="button">Cancel</button>
            </div>
        </div>

    </div>
    </form>
    <!-- END NEW INCIDENT FORM -->
    

    </div>    
</div>
