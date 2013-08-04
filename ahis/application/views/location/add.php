<h2>Create Town</h2>
<?php echo form_open('location/create'); ?>

<p>
<label for="Location">Location:</label>
<input type="text" name="town" id = "town">
</p>

<p>
<label for="Location">Location:</label>
<?php echo form_dropdown('districts',$districts,null); ?>
</p>

<p>
	<input type="submit" value="Submit" />
</p>

<?php echo form_close(); ?>