The Diseases shall be edited here

<?php if (isset($diiseases)) : ?>

<?php echo form_open('disease/addupdate'); ?>

<?php foreach($diseases->result_array() as $disease) : ?>
<h2>Edit <?php echo $disease['disease_name']; ?> </h2>
<input type="hidden" name="id" id = "id" value = "<?php echo $disease['disease_id']; ?> ">
<p>
<label for="disease">Disease:</label>
<input type="text" name="disease" id = "disease" value = "<?php echo $disease['disease_name']; ?> ">
</p>

<p>
	<input type="submit" value="Submit" />
</p>

<?php endforeach; ?>
<?php echo form_close(); ?>

<?php endif; ?>

