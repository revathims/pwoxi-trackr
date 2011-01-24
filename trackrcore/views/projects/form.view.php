<?php if ($formtype == 'add') { ?>
    <h2>Add New Project</h2>
<?php } ?>

<div class="forms">
    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
    <?php
    if ($some_error == 1) {
        echo '<p class="ui-state-error ui-corner-all">Opps! There was an unknown error. please try again.</p>';
    };
    ?>

    <?php
// preparing form elements:
    $project_name = array(
        'name' => 'project_name',
        'id' => 'project_name',
        'size' => 45,
        'value' => set_value('project_name'),
        'class' => 'ui-corner-all'
    );

    $label = array(
        'name' => 'label',
        'id' => 'label',
        'size' => 10,
        'value' => set_value('label'),
        'class' => 'ui-corner-all'
    );

    $project_description = array(
        'name' => 'project_description',
        'id' => 'project_description',
        'value' => set_value('project_description'),
        'class' => 'ui-corner-all long'
    );

    echo form_open('projects/'.$formtype);
    echo form_label('Name', $project_name['id']);
    echo form_input($project_name);
    echo form_label('Label', $label['id']);
    echo form_input($label);
    echo form_label('Description', $project_description['id']);
    echo form_input($project_description);
    echo form_hidden('action', $formtype);


    echo form_submit('submit', 'Add This Project', 'class="ui-corner-all"');
    echo form_close();
    ?>

</div>