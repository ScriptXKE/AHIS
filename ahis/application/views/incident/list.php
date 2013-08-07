<div class="w-box">
    <div class="w-box-header">
        <div class="btn-group">
            <a href="<?php echo base_url(); ?>incident/basic_details" class="btn btn-inverse btn-mini delete_rows_dt" data-tableid="dt_gal" title="New Incident">New Incident</a>

        </div>
    </div>
    <div class="w-box-content">
        <?php if ($incident_listing->num_rows() > 0) { ?>
        <table class="table table-vam table-striped" id="dt_gal">
            <thead>
                <tr>
                    <th class="table_checkbox" style="width:1%"><input type="checkbox" name="select_rows" class="select_rows" data-tableid="dt_gal" /></th>
            
                    <th style="width:14%">Date</th>
                    <th style="width:10%">Animal</th>
                    <th style="width:60%">Incident Description</th>
                    <th style="width:15%">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($incident_listing->result() as $incident) { ?>
                <tr>
                    <td><input type="checkbox" name="row_sel" class="row_sel" /></td>

                    <td><?php echo date('F j, Y', strtotime($incident->last_update)); ?><br /><?php echo date('h:i:s A', strtotime($incident->last_update)); ?></td>
                    <td><?php echo $this->base_model->get_animal_by_id($incident->animal_id); ?></td>
                    <td><?php echo $incident->description; ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo base_url() . 'incident/basic_details_summary/' . $incident->id; ?>" class="btn btn-mini" title="Edit"><i class="icon-pencil"></i></a>
                            <a href="<?php echo base_url() . 'incident/summary/' . $incident->id; ?>" class="btn btn-mini" title="View"><i class="icon-eye-open"></i></a>
                            <a href="<?php echo base_url() . 'incident/delete/' . $incident->id; ?>" class="btn btn-mini" title="Delete"><i class="icon-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
        
           
            </tbody>
        </table>
        <?php } else { ?>
        <div>There are no incidents in the database.</div>
        <?php } ?>
    </div>
</div>
