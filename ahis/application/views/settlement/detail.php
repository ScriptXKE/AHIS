Settlements Detail

<h2><?php echo anchor("settlement/add/", "Add New") ?></h2>
<?php if (isset($gis)) : ?>

<table width="100%">
<tr>
	<td width="20%">Settlement name</td>
	<td width="20%">District name</td>
	<td width="20%">Region Name</td>
	<td width="20%">Zone name</td>
	<td width="20%">country name</td>
	<td width="20%">Actions</td>
</tr>
<?php foreach($gis->result_array() as $settlement) : ?>
<tr>
	<td><h3><?php echo $settlement['settlement_name']; ?></h3></td>
	<td><?php echo $settlement['district_name']; ?></td>
	<td><?php echo $settlement['region_name']; ?></td>
	<td><?php echo $settlement['zone_name']; ?></td>
	<td><?php echo $settlement['country_name']; ?></td>	
	<td><?php echo anchor("settlement/edit/".$settlement['settlement_id'], "Edit") ?> | <?php echo anchor("settlement/delete/".$settlement['settlement_id'], "Delete") ?> </td>

</tr>
<?php endforeach; ?>
<?php echo $this->pagination->create_links(); ?>
</table>

<?php endif; ?>