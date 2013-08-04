The settlements shall be edited here

<?php if (isset($gis)) : ?>

<?php echo form_open('settlement/addupdate'); ?>

<?php foreach($gis->result_array() as $settlement) : ?>
<h2>Edit <?php echo $settlement['settlement_name']; ?> Town in <?php echo $settlement['district_name']; ?>  District</h2>
<input type="hidden" name="id" id = "id" value = "<?php echo $settlement['settlement_id']; ?> ">
<p>
<label for="settlement">Settlement:</label>
<input type="text" name="settlement" id = "settlement" value = "<?php echo $settlement['settlement_name']; ?> ">
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