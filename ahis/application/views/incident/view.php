<div class="content">
    <h1><?php echo $title; ?></h1>
    <?php echo $message; ?>
    
        <div class="data">
            <table>
                <tr>
                    <td width="30%">ID</td>
                    <td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('id'); ?>"/></td>
                <input type="hidden" name="id" value="<?php echo set_value('id', $this->form_data->id); ?>"/>
                </tr>
                <tr>
                    <td width="30%">Case Number</td>
                    <td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('caseNumber'); ?>"/></td>
                <input type="hidden" name="caseNumber" value="<?php echo set_value('caseNumber', $this->form_data->caseNumber); ?>"/>
                </tr>
                <tr>
                    <td width="30%">Reported By</td>
                    <td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('reporter'); ?>"/></td>
                <input type="hidden" name="reporter" value="<?php echo set_value('reporter', $this->form_data->reporter); ?>"/>
                </tr>
                <tr>
                    <td width="30%">Animal Type</td>
                    <td><input type="text" name="animalType" disabled="disable" class="text" value="<?php echo set_value('animalType'); ?>"/></td>
                <input type="hidden" name="animalType" value="<?php echo set_value('animalType', $this->form_data->animalType); ?>"/>
                </tr>
                 <tr>
                    <td width="30%">List of Symptoms</td>
                    <td><input type="text" name="SymptomsList" disabled="disable" class="text" value="<?php echo set_value('SymptomsList'); ?>"/></td>
                <input type="hidden" name="SymptomsList" value="<?php echo set_value('SymptomsList', $this->form_data->SymptomsList); ?>"/>
                </tr>
                <tr>
                    <td width="30%">Case Notes</td>
                    <td><input type="text" name="NotesList" disabled="disable" class="text" value="<?php echo set_value('NotesList'); ?>"/></td>
                <input type="hidden" name="NotesList" value="<?php echo set_value('NotesList', $this->form_data->NotesList); ?>"/>
                </tr>
                <tr>
                    <td width="30%">Tags</td>
                    <td><input type="text" name="TagList" disabled="disable" class="text" value="<?php echo set_value('TagList'); ?>"/></td>
                <input type="hidden" name="TagList" value="<?php echo set_value('TagList', $this->form_data->TagList); ?>"/>
                </tr>
                <!-- List all SMS if the case if linked to an SMS that reported, only one SMS per case is allowed, all new SMS open new incidents -->
                <tr>
                    <td width="30%">SMS</td>
                    <td><input type="text" name="SMS" disabled="disable" class="text" value="<?php echo set_value('SMS'); ?>"/></td>
                <input type="hidden" name="SMS" value="<?php echo set_value('SMS', $this->form_data->SMS); ?>"/>
                </tr>
                <tr>
                    <td width="30%">Location</td>
                    <td><input type="text" name="location" disabled="disable" class="text" value="<?php echo set_value('location'); ?>"/></td>
                <input type="hidden" name="location" value="<?php echo set_value('location', $this->form_data->location); ?>"/>
                </tr>
                <!-- dump small map location here using GPS coordinates and google api -->
                <tr>
                    <!-- dump small map location here using GPS coordinates and google api -->
                </tr>
                <tr>
                    <td valign="top">Incident Date<span style="color:red;">*</span></td>
                    <td><input type="text" name="date" onclick="displayDatePicker('date');" class="text" value="<?php echo set_value('date', $this->form_data->date); ?>"/>
                        <a href="javascript:void(0);" onclick="displayDatePicker('date');"><img src="<?php echo base_url(); ?>res/css/images/calendar.png" alt="calendar" border="0"></a>
                        <?php echo form_error('date'); ?></td>
                    </td>
                </tr>
                
            </table>
        </div>
    <br />
</div>