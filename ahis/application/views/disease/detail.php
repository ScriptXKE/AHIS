All the Diseases details shall be displayed here

<h2><?php echo anchor("disease/add/", "Add New") ?></h2>

<?php 
if (isset($singledisease))
{
	echo $singledisease['disease_name'];

}
else
{

}

?>


<?php if (isset($diseases)) : ?>

<table width="100%">
<tr>
	<td width="20%">Disease name</td>
	<td width="20%">Actions</td>
</tr>
<?php foreach($diseases->result_array() as $disease) : ?>
<tr>
	<td><h3><?php echo $disease['disease_name']; ?></h3></td>
	<td><h3><?php echo $disease['symptom_name']; ?></h3></td>
	<td><?php echo anchor("disease/edit/".$disease['disease_id'], "Edit") ?> | 
		<?php echo anchor("disease/delete/".$disease['disease_id'], "Delete") ?> </td>

</tr>
<?php endforeach; ?>
<?php echo $this->pagination->create_links(); ?>
</table>

<?php endif; ?>