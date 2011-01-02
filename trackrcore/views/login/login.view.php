<div id="loginform" class="forms">

    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
    <?php if ($incorrect_login == 1) { echo '<p class="ui-state-error ui-corner-all">Opps! wrong email or password.</p>'; };  ?>

    <?php
    // preparing form elements:
    $email = array(
        'name' => 'email',
        'id' => 'email',
        'size' => 32,
        'value' => '',
        'class' => 'ui-corner-all'
    );

    $password = array(
        'name' => 'password',
        'id' => 'password',
        'value' => '',
        'class' => 'ui-corner-all'
    );

    echo form_open('login');
    echo form_label('Email', $email['id']);
    echo form_input($email);
    echo form_label('Password', $password['id']);
    echo form_password($password);
    echo form_submit('submit', 'Login', 'class="ui-corner-all"');
    echo form_close();
    ?>
    
 
</div><!-- end login_form-->