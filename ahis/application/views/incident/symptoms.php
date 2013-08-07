<div class="row-fluid">
<div class="span2">
    <div class="mbox_nav sidebar">
        <ul id="mypageNav">
            <?php echo $this->incident_model->incident_menu_items('symptoms'); ?>
        </ul>
    </div>
</div>
<div class="span10">

    <!-- START INCIDENT SYMPTOMS -->
    <form method="post" action="<?php echo base_url() . 'incident/symptoms'; ?>">
    <div class="w-box w-box-blue">
        <div class="w-box-header">
            <h4>Surveillance</h4>
        </div>
        <div class="w-box-content cnt_a">
            <div class="row-fluid">
                <div class="span12">
                   <p class="heading_a">Symptoms</p>
                    <div class="formSep">
                        <div>Select the symptoms for this incident:</div>
                        <div class="scrollable-div-fixed-max-height-200px	">
                        <?php
                        foreach ($symptoms_listing->result() as $symptom) { 
                        // check if the symptom id is already selected for this incident
                        $symptom_id_in_array = '';
                        if (in_array($symptom->id, $array_symptoms_ids)) {
                        	// set the checkbox
                        	$symptom_id_in_array = ' checked="checked"';
                        }
                        ?>
                        <div class="symptom-listing">
                        <span class="list-info inline-info incident-sms-checkbox"><input type="checkbox" name="symptom_id[]" id="symptom_id[]" value="<?php echo $symptom->id; ?>"<?php echo $symptom_id_in_array; ?> <?php echo set_checkbox('symptom_id[]'); ?> /></span> <?php echo $symptom->description; ?><br />
                        </div>
                        <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
                                           
    	</div>
        <div class="w-box-footer">
            	<div class="f-center">
                <button class="btn btn-ahis-3" type="submit">Save</button>
               	<button class="btn btn-link inv-cancel">Cancel</button>
           		</div>
       		</div>                          
    </div>
    </form>
    <!-- END INCIDENT SYMPTOMS -->
    
    <div class="w-box w-box-blue">
         <div class="w-box-header">
            <h4>Additional Comments</h4>
       
            <div class="pull-right">
             <a data-toggle="collapse" data-parent="#accordion2" href="#myComments">
             <span>Show/Hide</span></a>
             </div>
         </div>
       

        <!-- Saved Comments Section -->
        <div id="myComments">
        
        <?php if ($symptoms_comments_listing->num_rows() > 0) { ?>

        <div class="w-box-content">
            <div class="ch-messages"> 
            <?php 
            foreach ($symptoms_comments_listing->result() as $symptom_comment) { 
                // get the avatar
                $avatar = (trim($symptom_comment->avatar) == "") ? 'missing.avatar.jpg' : $symptom_comment->avatar;
                $comment_owner = $symptom_comment->firstname . ' ' . $symptom_comment->surname;
                $comment_details = $symptom_comment->comment_details;
                $comment_posted_timestamp = $symptom_comment->date_posted;
                ?>
                <div class="ch-message-item clearfix">
                    <img class="ch-image img-avatar" alt="" src="<?php echo base_url(); ?>assets/avatars/<?php echo $avatar; ?>" alt="{$comment_owner}" />
                   <div class="ch-content">
                        <p class="ch-name">
                             <strong><?php echo $comment_owner; ?></strong>
                            <span class="ch-time"><?php echo date('l, jS F Y - h:i:s A', strtotime($comment_posted_timestamp)); ?></span>
                        </p>
                        <?php echo $comment_details; ?>
                    </div>
                </div>
                <?php } ?>
             </div>
         </div>

        <?php } ?>
        <!-- Saved Comments Section - END -->
         
        <!-- Enter Comments Section -->
        <form method="post" action="<?php echo base_url(); ?>incident/symptoms_comments">
        <div class="w-box-footer">
            <div class="ch-message-add control-group">
                <div class="input-append">
                 <textarea name="symptoms_comment" id="symptoms_comment" cols="30" rows="3" class="span10 ch-message-input" placeholder="
Add your comments here"></textarea><br />
                    <button class="btn btn-success" type="submit">Add Comment</button>
                </div>
            </div>
        </div>
        </form>
        <!-- Enter Comments Section - END -->
      
        </div>
    </div>    
</div>
