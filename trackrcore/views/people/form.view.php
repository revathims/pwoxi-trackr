<?php if ($formtype == 'add') { ?>
    <h2>Add New People</h2>
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
    $first_name = array(
        'name' => 'first_name',
        'id' => 'first_name',
        'size' => 45,
        'value' => set_value('first_name'),
        'class' => 'ui-corner-all'
    );

    $last_name = array(
        'name' => 'last_name',
        'id' => 'last_name',
        'size' => 45,
        'value' => set_value('last_name'),
        'class' => 'ui-corner-all'
    );

    $email = array(
        'name' => 'email',
        'id' => 'email',
        'size' => 45,
        'value' => set_value('email'),
        'class' => 'ui-corner-all'
    );

    $password = array(
        'name' => 'password',
        'id' => 'password',
        'value' => '',
        'class' => 'ui-corner-all'
    );

        $cpassword = array(
        'name' => 'cpassword',
        'id' => 'cpassword',
        'value' => '',
        'class' => 'ui-corner-all'
    );

    echo form_open('people/' . $formtype);
    echo form_label('First Name', $first_name['id']);
    echo form_input($first_name);

    echo form_label('Last Name', $last_name['id']);
    echo form_input($last_name);

    echo form_label('Email', $email['id']);
    echo form_input($email);

    
    echo form_label('Password', $password['id']);
    echo form_password($password);
    
    echo form_label('Confirm Password', $cpassword['id']);
    echo form_password($cpassword);
    
    
    echo form_hidden('action', $formtype);


    echo form_submit('submit', 'Add This Person', 'class="ui-corner-all"');
    echo form_close();
    ?>

</div>