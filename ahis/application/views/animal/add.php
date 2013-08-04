<h2>Create </h2>
<?php echo form_open('animal/create'); ?>

<p>
<label for="animal">Animal:</label>
<input type="text" name="animal" id = "animal">
</p>

<p>
	<input type="submit" value="Submit" />
</p>

<?php echo form_close(); ?>