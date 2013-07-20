<div class="content">
    <div class="paging"><?php echo $pagination; ?></div>
    <div class="data"><?php echo $table; ?></div>
    <br />
    <?php echo anchor('incident/add/', 'add new incident', array('class' => 'add')); ?>
</div>