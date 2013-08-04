<h2>Create</h2>
<?php echo form_open('disease/create'); ?>

<p>
<label for="Disease">Disease:</label>
<input type="text" name="Disease" id = "Disease">
</p>


<div class="field_row clearfix">
	<label for="Type">Dropdown Type:</label>
	<div class='form_field'>
	<?php echo form_dropdown('supplier_id', $suppliers, $selected_supplier);?>
	</div>
</div>

<p>
	<input type="submit" value="Submit" />
</p>

<?php echo form_close(); ?>