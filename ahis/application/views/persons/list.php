<!-- main content -->
<div class="container">
    <div class="row-fluid">
        <div class="span9">
            <div class="w-box">
                <div class="w-box-header">
                    <div class="btn-group">
                        <a href="<?php echo base_url() . 'persons/add/'; ?>" class="btn btn-inverse btn-mini delete_rows_dt" data-tableid="dt_gal" title="Add User">Add User</a>

                    </div>
                </div>
                <div class="w-box-content">
                    <table class="table table-vam table-striped" id="dt_gal">
                        <thead>
                            <tr>
                                

                                <th>Name</th>
                                <th>Surname</th>
                                <th>Other Names</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th >Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //var_dump($results);
                            foreach ($results as $row) {
                                echo "<tr>";
                                echo "<td>" . $row->firstname."</td>";
                                echo "<td>" . $row->surname."</td>";
                                echo "<td>" . $row->othernames."</td>";
                                echo "<td>" . $row->email."</td>";
                                echo "<td>" . $row->telephone."</td>";
                                ?>
                            <td>
                                    <div class="btn-group">
                                        <a href="<?php echo base_url().'persons/edit/'.$row->id ?>" class="btn btn-mini" title="Edit"><i class="icon-pencil"></i></a>
                                        <a href="<?php echo base_url().'persons/view/'.$row->id ?>" class="btn btn-mini" title="View"><i class="icon-eye-open"></i></a>
                                        <a href="<?php echo base_url().'persons/delete/'.$row->id ?>" onClick="deletechecked(<?php echo base_url().'persons/delete/'.$row->id ?>)"     class="btn btn-mini" title="Delete"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                                <?php
                                echo "</tr>";
                            }
                            ?>

                            
                        </tbody>
                    </table>
                </div>
                <div> <?php echo $this->pagination->create_links(); ?> </div>
            </div>
            <!-- confirmation box -->
            <div class="hide">
                <div id="confirm_dialog" class="cbox_content">
                    <div class="sepH_c"><strong>Are you sure you want to delete this row(s)?</strong></div>
                    <div>
                        <a href="#" class="btn btn-small btn-beoro-3 confirm_yes">Yes</a>
                        <a href="#" class="btn btn-small confirm_no">No</a>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="span3">
        <div class="w-box">
            <div class="w-box-header">
                <h4>Create Person From SMS</h4>
            </div>
        </div>
        <div class="w-box-content"></div>
    </div>
    </div>
    
</div>
<!-- end main content -->