All the settlements shall be displayed here

<h2>Read all</h2>


<h2><?php echo anchor("settlement/add/", "Add New") ?></h2>
<?php if (isset($gis)) : ?>

<table width="80%">
<tr>
	<td width="20%">country name</td>
	<td width="20%">zone name</td>
	<td width="20%">Region Name</td>
	<td width="20%">district name</td>
	<td width="20%">Actions</td>
</tr>
<?php foreach($gis->result_array() as $settlement) : ?>
<tr>
	<td><?php echo $settlement['country_name']; ?></td>
	<td><?php echo $settlement['zone_name']; ?></td>
	<td><?php echo $settlement['region_name']; ?></td>
	<td><?php echo $settlement['district_name']; ?></td>
	<td><?php echo anchor("settlement/detail/".$settlement['district_id'], "Detail") ?> | <?php echo anchor("settlement/edit/".$settlement['district_id'], "Edit") ?> | <?php echo anchor("settlement/delete/".$settlement['district_id'], "Delete") ?> </td>

</tr>
<?php endforeach; ?>
<?php echo $this->pagination->create_links(); ?>
</table>

<?php endif; ?>