All the Diseases shall be displayed here

<h2>Read all</h2>


<h2><?php echo anchor("disease/add/", "Add New") ?></h2>
<?php if (isset($diseases)) : ?>

<table width="80%">
<tr>
	<td width="20%">Disease name</td>
	<td width="20%">Actions</td>
</tr>
<?php foreach($diseases->result_array() as $disease) : ?>
<tr>
	<td><?php echo $disease['disease_name']; ?></td>
	<td><?php echo anchor("disease/detail/".$disease['disease_id'], "Detail") ?> | 
		<?php echo anchor("disease/edit/".$disease['disease_id'], "Edit") ?> | 
		<?php echo anchor("disease/delete/".$disease['disease_id'], "Delete") ?> </td>

</tr>
<?php endforeach; ?>
<?php echo $this->pagination->create_links(); ?>
</table>

<?php endif; ?>





            
        <!-- main content -->
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-blue">
                            <div class="w-box-header">
                                <h4>Diseases</h4>
                            </div>
                            
                            <div class="w-box-content cnt_a">
                                <div class="row-fluid">
                                
                                    <div class="span6">
                                        <p class="heading_a">Select Disease</p>
                                        
                                        <div class="formSep">
                                        <select id="s2_single" class="span6">
                                            <option value=""></option>
                                        <optgroup label="Cows">
                                            <option value="Mad Cow">Mad Cow</option>
                                            <option value="Milk">Spoiled Milk</option>
                                        </optgroup>
                                        <optgroup label="Camel">
                                            <option value="HD">Hump Disease</option>
                                            <option value="DM">Dry Mouth</option>
                                        </optgroup>
                                    
                                        </select>
                                    </div>
                                    
                                                                       

                                 
                                  </div>
                                  
                                   <div class="span6">
                                   <p class="heading_a">Add/Edit Disease</p>
                                       	<div class="sepH_b">
                                            <input type="button" class="btn btn-info" name="beforeAdd" value="Add Disease" id="beforeAdd"></button>
                                            <input type="button" class="btn btn-info" name="beforeEdit" value="Edit Disease" id="beforeEdit"></button>
                                        </div>
                                        
                                        <!-- confirmation box -->
										<div class="sepH_c" id="addPopup">
                               				<div class="formSep">
                                        		<label>Enter New Disesae</label>
                                       			<input type="text" id="newSet" name="newSet" class="span6" value="--" />
                                   			</div>
                                            
                                            <div class="formSep">
                                        		<a href="#" class="btn btn-small btn-ahis-3 confirm_yes">Save</a>
                                   				<a href="#" class="btn btn-small confirm_no">Cancel</a>
                                   			</div>
                               			</div>
                                                                                
                                        <!-- confirmation box -->
										<div class="sepH_c" id="editPopup">
                               				<div class="formSep">
                                        		<label>Edit Disease Name</label>
                                       			<input type="text" id="newSet" name="newSet" class="span6" value="--" />
                                   			</div>
                                            
                                            <div class="formSep">
                                            	<label for="syptoms">Add symptoms for this disease</label>
                                            	<input type="text" id="syptoms" name="syptoms" class="span6" value="Bleeding">
                                       		</div>
                                            
                                            <div class="formSep">
                                        		<a href="#" class="btn btn-small btn-ahis-3 confirm_yes">Save</a>
                                   				<a href="#" class="btn btn-small confirm_no">Cancel</a>
                                   			</div>
                               			</div>

                                     </div>
                                  
                               </div>
                                                               
                        	</div>
                     
                        </div>
                        
                        
                          <div class="w-box">
                            <div class="w-box-header">
                                Symptoms for:
                            </div>
                            <div class="w-box-content">
                                <table class="table table-vam table-striped" id="dt_gal">
                                    <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Symptom</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>1</td>
                                            <td>Mad Cow</td>
                                            <td width="150px" align="right">
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-mini" title="Edit"><i class="icon-pencil"></i></a>
                                                    <a href="#" class="btn btn-mini" title="View"><i class="icon-eye-open"></i></a>
                                                    <a href="#" class="btn btn-mini" title="Delete"><i class="icon-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                     
                                        <tr>

                                            <td>2</td>
                                            <td>Foot and Mouth</td>
                                            <td width="150px" align="right">
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-mini" title="Edit"><i class="icon-pencil"></i></a>
                                                    <a href="#" class="btn btn-mini" title="View"><i class="icon-eye-open"></i></a>
                                                    <a href="#" class="btn btn-mini" title="Delete"><i class="icon-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

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
            <div class="footer_space"></div>
        </div> 

    

    
    <!-- Common JS -->
        <!-- jQuery framework -->
            <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
            <script src="<?php echo base_url(); ?>js/jquery-migrate.js"></script>
        <!-- bootstrap Framework plugins -->
            <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <!-- top menu -->
            <script src="<?php echo base_url(); ?>js/jquery.fademenu.js"></script>
        <!-- top mobile menu -->
            <script src="<?php echo base_url(); ?>js/selectnav.min.js"></script>
        <!-- actual width/height of hidden DOM elements -->
            <script src="<?php echo base_url(); ?>js/jquery.actual.min.js"></script>
        <!-- jquery easing animations -->
            <script src="<?php echo base_url(); ?>js/jquery.easing.1.3.min.js"></script>

        <!-- power tooltips -->
            <script src="<?php echo base_url(); ?>js/lib/powertip/jquery.powertip-1.1.0.min.js"></script>
        <!-- date library -->
            <script src="<?php echo base_url(); ?>js/moment.min.js"></script>
        <!-- common functions -->
            <script src="<?php echo base_url(); ?>js/ahis_common.js"></script>

        <!-- switch buttons -->
            <script src="<?php echo base_url(); ?>js/lib/ibutton/js/jquery.ibutton.beoro.min.js"></script>
        <!-- enchanced select box, tag handler -->
            <script src="<?php echo base_url(); ?>js/lib/select2/select2.min.js"></script>

            <script src="<?php echo base_url(); ?>js/pages/ahis_settings.js"></script>
            
  <!-- Forms -->  
        <!-- jQuery UI -->
            <script src="<?php echo base_url(); ?>js/lib/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <!-- touch event support for jQuery UI -->
            <script src="<?php echo base_url(); ?>js/lib/jquery-ui/jquery.ui.touch-punch.min.js"></script>
        <!-- progressbar animations -->
            <script src="<?php echo base_url(); ?>js/form/jquery.progressbar.anim.min.js"></script>
        <!-- 2col multiselect -->
            <script src="<?php echo base_url(); ?>js/lib/multi-select/js/jquery.multi-select.min.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/multi-select/js/jquery.quicksearch.min.js"></script>
        <!-- combobox -->
            <script src="<?php echo base_url(); ?>js/form/fuelux.combobox.min.js"></script>
        <!-- file upload widget -->
            <script src="<?php echo base_url(); ?>js/form/bootstrap-fileupload.min.js"></script>
        <!-- masked inputs -->
            <script src="<?php echo base_url(); ?>js/lib/jquery-inputmask/jquery.inputmask.min.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/jquery-inputmask/jquery.inputmask.extensions.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/jquery-inputmask/jquery.inputmask.date.extensions.js"></script>
        <!-- enchanced select box, tag handler -->
            <script src="<?php echo base_url(); ?>js/lib/select2/select2.min.js"></script>
        <!-- password strength metter -->
            <script src="<?php echo base_url(); ?>js/lib/pwdMeter/jquery.pwdMeter.min.js"></script>
        <!-- datepicker -->
            <script src="<?php echo base_url(); ?>js/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <!-- timepicker -->
            <script src="<?php echo base_url(); ?>js/lib/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <!-- colorpicker -->
            <script src="<?php echo base_url(); ?>js/lib/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <!-- metadata -->
            <script src="<?php echo base_url(); ?>js/lib/ibutton/js/jquery.metadata.min.js"></script>
        <!-- switch buttons -->
            <script src="<?php echo base_url(); ?>js/lib/ibutton/js/jquery.ibutton.ahis.js"></script>
        <!-- autosize textarea -->
            <script src="<?php echo base_url(); ?>js/form/jquery.autosize.min.js"></script>
        <!-- textarea counter -->
            <script src="<?php echo base_url(); ?>js/lib/jquery-textarea-counter/jquery.textareaCounter.plugin.min.js"></script>
        <!-- UI Spinners -->
            <script src="<?php echo base_url(); ?>js/lib/jqamp-ui-spinner/globalize/globalize.min.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/jqamp-ui-spinner/globalize/cultures/globalize.culture.fr-FR.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/jqamp-ui-spinner/globalize/cultures/globalize.culture.ja-JP.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/jqamp-ui-spinner/globalize/cultures/globalize.culture.zh-CN.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/jqamp-ui-spinner/compiled/jqamp-ui-spinner.min.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/jqamp-ui-spinner/compiled/jquery-mousewheel-3.0.6.min.js"></script>
        <!-- plupload and the jQuery queue widget -->
            <script type="text/javascript" src="js/lib/plupload/js/plupload.full.js"></script>
            <script type="text/javascript" src="js/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
        <!-- WYSIWG Editor -->
            <script src="<?php echo base_url(); ?>js/lib/ckeditor/ckeditor.js"></script>
         <!-- datatables -->
            <script src="<?php echo base_url(); ?>js/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/datatables/js/jquery.dataTables.sorting.js"></script>
        <!-- datatables bootstrap integration -->
            <script src="<?php echo base_url(); ?>js/lib/datatables/js/jquery.dataTables.bootstrap.min.js"></script>
        <!-- colorbox -->
            <script src="<?php echo base_url(); ?>js/lib/colorbox/jquery.colorbox.min.js"></script>

            <script src="<?php echo base_url(); ?>js/pages/ahis_form_elements.js"></script>
             <script src="<?php echo base_url(); ?>js/pages/ahis_tables.js"></script>



    </body>
</html>