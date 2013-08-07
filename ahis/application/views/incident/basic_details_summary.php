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

    <!-- START INCIDENT SUMMARY -->
    <div class="w-box w-box-blue">
        <div class="w-box-header">
            <h4>Incident - Basic Details Summary</h4>
        </div>
        <div class="w-box-content cnt_a">
            <div class="row-fluid">
                <div class="span6">
                    <p class="heading_a">Incident Information</p>

                    <div class="formSep">
                        <div><span class="incident-details-prompt">Incident Description</span></div>
                        <div class="incident-details-response"><?php echo $incident_details->description; ?></div>
                    </div>

                    <div class="formSep">
                        <div><span class="incident-details-prompt">SMS Messages Related to the Incident:</span></div>
                        <div id="list_basic">
                        <?php if ($sms_listing->num_rows() > 0) { ?>
                        <ul>
                            <?php foreach ($sms_listing->result() as $sms_details) { ?>
                            <li class="incident-sms-details incident-details-response">
                                <span class="list-info"><span class="sms-properties">From <?php echo $sms_details->phone_number; ?> on <?php echo date('jS F Y h:i:s A', strtotime($sms_details->date_received)); ?></span><br/><?php echo $sms_details->description; ?></span>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php }  else { ?>
                        <span  class="incident-details-response">There are no SMS messages related to this incident.</span>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="formSep">
                        <div><span class="incident-details-prompt">Incident reported by:</span> <span class="incident-details-response"><?php echo $incident_details->incident_reporter; ?></span></div>
                    </div>
                    <div class="formSep">
                        <div><span class="incident-details-prompt"><?php echo $incident_details->incident_reporter; ?>'s Phone Number:</span> <span class="incident-details-response"><?php echo $incident_details->incident_reporter_phone; ?></span></div>
                    </div>
                   
                </div>
                <div class="span6">
                    <p class="heading_a">Incident Details</p>
                    <div class="formSep">
                        <div><span class="incident-details-prompt">Town where incident is reported:</span> <span class="incident-details-response"><?php echo $this->base_model->get_town_by_id($incident_details->location_id); ?></span></div>
                    </div>
                    <div class="formSep">
                        <div><span class="incident-details-prompt">Animal affected:</span> <span class="incident-details-response"><?php echo $this->base_model->get_animal_by_id($incident_details->animal_id); ?></span></div>
                    </div>
                    <div class="formSep">
                        <div><span class="incident-details-prompt">Number of Animals in the herd:</span> <span class="incident-details-response"><?php echo $incident_details->animal_herd_size; ?></span></div>
                    </div>
                    <div class="formSep">
                        <div><span class="incident-details-prompt">Number of Animals affected / infected in the herd:</span> <span class="incident-details-response"><?php echo $incident_details->num_animals_affected; ?></span></div>
                    </div>
                    <div class="formSep">
                        <div><span class="incident-details-prompt">Period that symptoms have manifested themselves:</span> <span class="incident-details-response"><?php echo $incident_details->symptoms_duration; ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END INCIDENT SUMMARY -->
    
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
        
        <?php if ($incident_comments_listing->num_rows() > 0) { ?>
        <div class="w-box-content">
            <div class="ch-messages"> 
            <?php 
            foreach ($incident_comments_listing->result() as $incident_comment) { 
                // get the avatar
                $avatar = (trim($incident_comment->avatar) == "") ? 'missing.avatar.jpg' : $incident_comment->avatar;
                $comment_owner = $incident_comment->firstname . ' ' . $incident_comment->surname;
                $comment_details = $incident_comment->incident_comment_details;
                $comment_posted_timestamp = $incident_comment->date_posted;
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
        <form method="post" action="<?php echo base_url(); ?>incident/comments">
        <div class="w-box-footer">
            <div class="ch-message-add control-group">
                <div class="input-append">
                 <textarea name="comment_details" id="comment_details" cols="30" rows="3" class="span10 ch-message-input" placeholder="
Add your incident comments here"></textarea><br />
                    <button class="btn btn-success" type="submit">Add Comment</button>
                </div>
            </div>
        </div>
        </div>
        </form>
        <!-- Enter Comments Section - END -->
      
        </div>
    </div>    
</div>
