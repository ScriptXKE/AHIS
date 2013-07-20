<div class="row-fluid">
    
    <div class="span6">
        <div class="w-box">
            <div class="w-box-header">
                <h4>Edit Incident</h4>
            </div>
            <div class="w-box-content">
                <form id="edit-incident" action="<?php echo base_url()."incident/edit"; ?>" method="post">
                    <div class="formSep">
                        <label for="incident_id">Incident Number</label>
                        <input type="text" id="incident_id" name="incident_id" class="span8" value="<?php echo set_value('id', $this->form_data->id); ?>" readonly />
                    </div>
                    <div class="formSep">
                        <label for="incident_reporter">Reported By:</label>
                        <input type="text" id="incident_reporter" name="incident_reporter" class="span8" placeholder="Reporter" value="<?php echo set_value('reporter', $this->form_data->reporter); ?>" />
                        <span class="help-block">Date</span>
                        <input type="text" id="incident_date" name="incident_date" onclick="displayDatePicker('date');" class="span8" placeholder="Date" value="<?php echo set_value('date', $this->form_data->date); ?>" />
                       
                    </div>
                    <div class="formSep">
                        
                        <label for="animal_type">Animal Type</label>
                        <input type="animal_type" id="animal_type" name="animal_type" class="span8" value="<?php echo set_value('animalType', $this->form_data->animalType); ?>" />
                        
                    </div>
                    <div class="formSep">
                        <label>Symptoms List</label>
                        <label for="SymptomsList">List of Symptoms</label>
                        <input type="text" id="SymptomsList" name="SymptomsList" class="span8" value="<?php echo set_value('SymptomsList', $this->form_data->SymptomsList); ?>" />
                    </div>
                    <div class="formSep">
                        <label>Case Notes</label>
                        <label for="NotesList">Notes</label>
                        <input type="text" id="NotesList" name="NotesList" class="span8" value="<?php echo set_value('NotesList', $this->form_data->NotesList); ?>" />
                    </div>
                    <div class="formSep">
                        <label>Tags</label>
                        <label for="TagList">Notes</label>
                        <input type="text" id="TagList" name="TagList" class="span8" value="<?php echo set_value('TagList', $this->form_data->TagList); ?>" />
                    </div>
                    <!-- List all SMS if the case if linked to an SMS that reported, only one SMS per case is allowed, all new SMS open new incidents -->
                    <div class="formSep">
                        <label>SMS</label>
                        <label for="SMSList">Notes</label>
                        <input type="text" id="SMSList" name="SMSList" class="span8" value="<?php echo set_value('SMSList', $this->form_data->SMSList); ?>" />
                    </div>
                    
                    <div class="formSep">
                        <label>Status Level:</label>
                        <label for="incident_open" class="checkbox inline"><input type="checkbox" name="incident_open" id="incident_open"/> Open</label>
                        <label for="incident_investigation" class="checkbox inline"><input type="checkbox" name="incident_investigation" id="incident_investigation"/> Investigation</label>
                        <label for="incident_closed" class="checkbox inline"><input type="checkbox" name="incident_closed" id="incident_closed"/> Closed</label>
                    </div>
                                       
                    <div class="formSep sepH_b">
                        <button class="btn btn-ahis-3" type="submit">Save changes</button>
                        <a href="#" class="btn btn-link">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="span6">
        <div class="w-box">
            <div class="w-box-header">
                <h4>Edit Incident</h4>
            </div>
            <div class="w-box-content cnt_a edit_incident">
                <div class="row-fluid">
                    <!-- dump small map location here using GPS coordinates and google api -->
                    <div class="span2">
                        <div class="map-holder">
                            <img class="map-avatar" alt="" src="<?php echo base_url(); ?>assets/avatars/<?php echo $this->session->userdata('avatar'); ?>">
                        </div>
                    </div>
                    <div class="span10">
                        <p class="formSep"><small class="muted">Location:</small> <span class="label label-success"><?php echo set_value('location'); ?></span></p>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>