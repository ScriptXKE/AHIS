<div class="row-fluid">
    <div class="span9">
        <div class="w-box">
            <div class="w-box-header">
                <h4>Persons List</h4>
            </div>
            <div class="w-box-content cnt_a user_profile">
                <?php
                echo anchor(base_url() . 'persons/add/', 'Add');
                if (!$results) {
                    echo '<h1>No Data</h1>';
                    exit;
                }
                $header = array_keys($results[0]);

                for ($i = 0; $i < count($results); $i++) {
                    $id = array_values($results[$i]);
                    $results[$i]['Edit'] = anchor(base_url() . 'persons/edit/' . $id[0], 'Edit');
                    $results[$i]['Delete'] = anchor(base_url() . 'persons/delete/' . $id[0], 'Delete', array('onClick' => 'return deletechecked(\' ' . base_url() . 'persons/delete/' . $id[0] . ' \')'));
                    array_shift($results[$i]);
                }

                $clean_header = clean_header($header);
                array_shift($clean_header);
                $this->table->set_heading($clean_header);

// view
                echo $this->table->generate($results);
                echo $this->pagination->create_links();
                ?>
                <script type="text/javascript">
                    function deletechecked(link)
                    {
                        var answer = confirm('Delete item?')
                        if (answer) {
                            window.location = link;
                        }

                        return false;
                    }

                </script>
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