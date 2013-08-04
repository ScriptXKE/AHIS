<div class="container">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-blue">
                            <div class="w-box-header">
                                <h4>Locations</h4>
                            </div>
                            
                            <div class="w-box-content cnt_a">
                                <div class="row-fluid">
                                
                                    <div class="span6">
                                        <p class="heading_a">Select Location</p>

                                        
                                        <?php echo form_open('location/create'); ?>                                      

                                        
                                        
                                        <div class="formSep">
                                        	<?php echo form_dropdown('districts',$districts,null); ?>
                                        </div>
                                    
                                                                       

                                 
                                  </div>
                                  
                                   <div class="span6">
                                   <p class="heading_a">Add/Edit Location</p>
                                       	<div class="sepH_b">
                                            <input type="button" class="btn btn-info" name="beforeAdd" value="Add" id="beforeAdd"></button>
                                        </div>
                                        
                                        <!-- add settlement option -->
										<div class="sepH_c" id="addPopup">
                                        
                                        	<div class="formSep">
                                        		<label>Enter new Town:</label>
                                       			<input type="text" id="newSet" name="town" class="span6" value="--" id = "town" />
                                       			
                                   			</div>
                                   			<p>
                                        	
                                        </p>
                                            
                                            <div class="formSep">
                                            	<input type="submit" value="Save" class="btn btn-small btn-ahis-3 confirm_yes" />
                                   				<a href="#" class="btn btn-small confirm_no">Cancel</a>
                                   			</div>
                               		
                                    		
                               			</div>
                                                                               

                                     </div>
                                  
                               </div>
                                                               
                        	</div>
                     <?php echo form_close(); ?>
                        </div>
                        
                        
                          <div class="w-box">
                            <div class="w-box-header">
                                Settlements for:
                            </div>
                            <div class="w-box-content">

                            	<h2><?php echo anchor("location/add/", "Add New") ?></h2>
                            	<?php if (isset($gis)) : ?>

                                <table class="table table-vam table-striped" id="dt_gal">
                                    <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Region</th>
                                            <th>District</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach($gis->result_array() as $location) : ?>
                                        <tr>
                                        	<td><?php echo $location['district_id']; ?></td>
                                        	<td><?php echo $location['district_name']; ?></td>
                                        	<td><?php echo $location['region_name']; ?></td>
                                            <td width="150px" align="right">
                                                <div class="btn-group">                                                    
                                                    <?php echo anchor("location/edit/".$location['district_id'], "Edit", 'class="btn btn-mini"', 'i = "icon-pencil"'); ?>
                                                    <?php echo anchor("location/detail/".$location['district_id'], "Detail", 'class="btn btn-mini"', 'i = "icon-eye-open"'); ?>
                                                    <?php echo anchor("location/delete/".$location['district_id'], "Delete", 'class="btn btn-mini"', 'i = "icon-trash"'); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php echo $this->pagination->create_links(); ?>
                                <?php endif; ?>

                            </tbody>
                                </table>
                            </div>
                            
                         
                        
                        </div>
                     
                        
                      
                            </div>
                          
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>





            <select id="yourid">
<option value="Value 1">Text 1</option>
<option value="Value 2">Text 2</option>
</select>

<script src="jquery.js"></script>
<script>
$('#yourid').change(function() {
  alert('The option with value ' + $(this).val() + ' and text ' + $(this).text() + ' was selected.');
});
</script>