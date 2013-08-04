The locations shall be edited here

<?php if (isset($gis)) : ?>

<?php echo form_open('location/addupdate'); ?>

<?php foreach($gis->result_array() as $location) : ?>
<h2>Edit <?php echo $location['town_name']; ?> Town in <?php echo $location['district_name']; ?>  District</h2>
<input type="hidden" name="id" id = "id" value = "<?php echo $location['town_id']; ?> ">
<p>
<label for="Location">Location:</label>
<input type="text" name="town" id = "town" value = "<?php echo $location['town_name']; ?> ">
</p>
<p>
<label for="Location">Location:</label>
<?php echo form_dropdown('districts',$districts,null); ?>
</p>

<p>
	<input type="submit" value="Submit" />
</p>

<?php endforeach; ?>
<?php echo form_close(); ?>

<?php endif; ?>