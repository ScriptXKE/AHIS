The Animals shall be edited here

<?php if (isset($animals)) : ?>

<?php echo form_open('animal/addupdate'); ?>

<?php foreach($animals->result_array() as $animal) : ?>
<h2>Edit <?php echo $animal['animal_name']; ?> </h2>
<input type="hidden" name="id" id = "id" value = "<?php echo $animal['animal_id']; ?> ">
<p>
<label for="animal">Animal:</label>
<input type="text" name="animal" id = "animal" value = "<?php echo $animal['animal_name']; ?> ">
</p>

<p>
	<input type="submit" value="Submit" />
</p>

<?php endforeach; ?>
<?php echo form_close(); ?>

<?php endif; ?>