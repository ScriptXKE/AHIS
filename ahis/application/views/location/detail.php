Locations Detail

<h2><?php echo anchor("location/add/", "Add New") ?></h2>
<?php if (isset($gis)) : ?>

<table width="100%">
<tr>
	<td width="20%">Town name</td>
	<td width="20%">District name</td>
	<td width="20%">Region Name</td>
	<td width="20%">Zone name</td>
	<td width="20%">country name</td>
	<td width="20%">Actions</td>
</tr>
<?php foreach($gis->result_array() as $location) : ?>
<tr>
	<td><h3><?php echo $location['town_name']; ?></h3></td>
	<td><?php echo $location['district_name']; ?></td>
	<td><?php echo $location['region_name']; ?></td>
	<td><?php echo $location['zone_name']; ?></td>
	<td><?php echo $location['country_name']; ?></td>	
	<td><?php echo anchor("location/edit/".$location['town_id'], "Edit") ?> | <?php echo anchor("location/delete/".$location['town_id'], "Delete") ?> </td>

</tr>
<?php endforeach; ?>
<?php echo $this->pagination->create_links(); ?>
</table>

<?php endif; ?>