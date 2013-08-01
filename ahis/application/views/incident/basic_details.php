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
                                <span class="list-info"><span>Phone:</span>(+254) 720 555 555<span>Email:</span> nicolas@netmedia.co.ke</span>
                                <span class="list-info"><span>Info: </span>Guys, I am buying pizza at our next Saturday meeting</span>
                            </li>
                            
                        </ul>

                        </div>
                     </div>
                
                    <div class="formSep">
                        <label for="s_off_message">About the case</label>
                        <textarea name="s_off_message" id="s_off_message" cols="30" rows="6" class="span8">
Enter some details about the case here</textarea>
                    </div>
                   
                </div>
                <div class="span6">
                    <p class="heading_a">Case Details</p>

                    <div class="formSep">
                        <label for="case_location">Location</label>
                        <select name="case_location" id="case_location" class="span6">
                            <option value="place1">Hageiza</option>
                            <option value="place3">Hageiza hapo down</option>
                            <option value="place4">Hageiza Uptown</option>
                            <option value="place5">Hageiza Grogon</option>
                        </select>

                    </div>
                    <div class="formSep">
                        <label for="animal_affected">Animal Affected</label>
                        <select name="animal_affected" id="animal_affected" class="span6">
                            <option value="a_cow">Cow</option>
                            <option value="a_goat">Goat</option>
                            <option value="a_chicken">Chicken</option>
                            <option value="a_camel">Camel</option>
                            <option value="a_sheep">Sheep</option>
                            <option value="a_rabbit">Rabbit?</option>

                        </select>
                    </div>
                     <div class="formSep">
                    <label for="herd_animals">How many animals in the herd?</label>
                    <input type="text" id="herd_animals" name="herd_animals" class="span8" value="0" />
                </div>
                 <div class="formSep">
                    <label for="herd_affected">How many animals affected?</label>
                    <input type="text" id="herd_affected" name="herd_affected" class="span8" value="25" />
                </div>
                 <div class="formSep">
                    <label for="herd_days">How many days have the symptoms been observed?</label>
                    <input type="text" id="herd_days" name="herd_days" class="span8" value="2 Weeks" />
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
    
    <div class="w-box w-box-blue">
         <div class="w-box-header">
            <h4>Additional Comments</h4>
       
            <div class="pull-right">
             <a data-toggle="collapse" data-parent="#accordion2" href="#myComments">
             <span>Show/Hide</span></a>
             </div>
         </div>

       <div id="myComments">  
       <!----Saved Comments Section------>
        <div class="w-box-content">
            <div class="ch-messages">   
                <div class="ch-message-item clearfix">
                    <img class="ch-image img-avatar" alt="" src="<?php echo base_url(); ?>assets/avatars/<?php echo $this->session->userdata('avatar'); ?>" alt="My Photo"" />
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
         <!----Saved Comments Section----END------>
         
         <!----Enter Comments Section------>
        <div class="w-box-footer">
            <div class="ch-message-add control-group">
                <div class="input-append">
                 <textarea name="s_off_message" id="s_off_message" cols="30" rows="3" class="span10 ch-message-input">
Add your comments here</textarea><br />
                    <button class="btn btn-success" type="button">Add Comment</button>
                </div>
            </div>
        </div>
        <!----Enter Comments Section----END------>
        </div>
      
        </div>
    </div>    
</div>