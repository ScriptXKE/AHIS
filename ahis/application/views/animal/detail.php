Animal Detail

<h2><?php echo anchor("animal/add/", "Add New") ?></h2>
<?php if (isset($animals)) : ?>

<table width="100%">
<tr>
	<td width="20%">Animal name</td>
	<td width="20%">Actions</td>
</tr>
<?php foreach($animals->result_array() as $animal) : ?>
<tr>
	<td><h3><?php echo $animal['animal_name']; ?></h3></td>
	<td><?php echo anchor("animal/edit/".$animal['animal_id'], "Edit") ?> | <?php echo anchor("animal/delete/".$animal['animal_id'], "Delete") ?> </td>

</tr>
<?php endforeach; ?>
<?php echo $this->pagination->create_links(); ?>
</table>

<?php endif; ?>