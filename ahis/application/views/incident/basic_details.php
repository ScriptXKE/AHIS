<div class="row-fluid">
<div class="span2">
    <div class="mbox_nav sidebar">
        <ul id="mypageNav">
            <li class="current"><a href="#">Basic Details</a></li>
            <li><a href="symptoms.html">Symptoms</a></li>
            <li><a href="surveillance.html">Surveillance</a></li>
            <li><a href="lab.html">Laboratory</a></li>
            <li><a href="prognosis.html">Prognosis</a></li>
        </ul>
    </div>
</div>
<div class="span10">

    <!-- START NEW INCIDENT FORM -->
    <form method="post" action="<?php echo base_url(); ?>incident/create">
    <div class="w-box w-box-blue">
        <div class="w-box-header">
            <h4>New Case</h4>
        </div>
        <div class="w-box-content cnt_a">
            <div class="row-fluid">
                <div class="span6">
                    <p class="heading_a">Case Information</p>
                     <div class="formSep">
                        <label for="s_offline">SMS Details</label>
                        <div id="list_basic" class="SMS-list">       
                        <ul>
                            <li>
                                <span class="list-username"><a href="javascript:void(0)">Nicolas Kerandi</a></span>
                                <span class="list-info"><span>Phone:</span>(+254) 720 555 555</span>
                                <span class="list-info"><span>Email:</span> nicolas@netmedia.co.ke</span>
                                <span class="list-info"><span>Info: </span>Guys, I am buying pizza at our next Saturday meeting</span>
                            </li>
                            
                        </ul>
                        </div>
                     </div>

                    <div class="formSep">
                        <label for="description">About the case</label>
                        <textarea name="description" id="description" cols="30" rows="6" class="span8" placeholder="Enter details about the incident here"></textarea>
                    </div>
                   
                </div>
                <div class="span6">
                    <p class="heading_a">Case Details</p>

                    <div class="formSep">
                        <label for="location_id">Town where incident is reported:</label>
                        <select name="location_id" id="location_id" class="span6">
                            <?php foreach ($town_listing->result() as $town) { ?>
                            <option value="<?php echo $town->id; ?>"><?php echo ucwords(strtolower($town->name)); ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="formSep">
                        <label for="animal_id">Animal affected:</label>
                        <select name="animal_id" id="animal_id" class="span6">
                            <?php foreach ($animal_listing->result() as $animal) { ?>
                            <option value="<?php echo $animal->id; ?>"><?php echo ucwords(strtolower($animal->name)); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                     <div class="formSep">
                    <label for="animal_herd_size">How many animals in the herd?</label>
                    <input type="text" id="animal_herd_size" name="animal_herd_size" class="span8" value="0" size="10" maxlength="5" />
                </div>
                 <div class="formSep">
                    <label for="num_animals_affected">How many animals affected?</label>
                    <input type="text" id="num_animals_affected" name="num_animals_affected" class="span8" value="25" />
                </div>
                 <div class="formSep">
                    <label for="symptoms_duration">How many days have the symptoms been observed?</label>
                    <input type="text" id="symptoms_duration" name="symptoms_duration" class="span8" value="2 Weeks" />
                </div>
                </div>
            </div>

    </div>
      <div class="w-box-footer">
            <div class="f-center">
                <button class="btn btn-ahis-3">Save</button>
                <button class="btn btn-link inv-cancel">Cancel</button>
            </div>
        </div>

    </div>
    </form>
    <!-- END NEW INCIDENT FORM -->
    
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
       
        <div class="w-box-content">
            <div class="ch-messages">   
                <div class="ch-message-item clearfix">
                    <img class="ch-image img-avatar" alt="" src="<?php echo base_url(); ?>assets/avatars/<?php echo $this->session->userdata('avatar'); ?>" alt="My Photo" />
                   <div class="ch-content">
                        <p class="ch-name">
                             <strong>Germain Mirindi</strong>
                            <span class="ch-time">10:54</span>
                        </p>
                        I think this cow ran away from my herd. It was the only healthy one left so it ran away from all the other contagious cows. Guess the disease still got you cow! Ha!
                    </div>
                </div>
             </div>
         </div>
         <!-- Saved Comments Section - END -->
         
         <!-- Enter Comments Section -->
        <div class="w-box-footer">
            <div class="ch-message-add control-group">
                <div class="input-append">
                 <textarea name="s_off_message" id="s_off_message" cols="30" rows="3" class="span10 ch-message-input">
Add your comments here</textarea><br />
                    <button class="btn btn-success" type="button">Add Comment</button>
                </div>
            </div>
        </div>
        </div>
        <!-- Enter Comments Section - END -->
      
        </div>
    </div>    
</div>
