<h2>Create Settlement</h2>
<?php echo form_open('settlement/create'); ?>

<p>
<label for="settlement">settlement:</label>
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