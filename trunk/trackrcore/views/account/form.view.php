<?php if ($formtype == 'edit') { ?>
    <h2>Edit Profile</h2>
<?php } ?>

    
    <div class="pagenote">
        Last Login Since: 
        <?php
        $login_date = $user_info['last_login_on'];
        $now = time();

        echo timespan($login_date, $now);
        ?>
        
    </div>
    
    <div class="cleardiv"></div>
    
<div class="forms">
    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
    <?php
    if ($some_error == 1) {
        echo '<p class="ui-state-error ui-corner-all">Opps! There was an unknown error. please try again.</p>';
    };
    
    if ($this->session->flashdata('profile_update'))
    {
       echo '<p class="ui-state-highlight ui-corner-all">Success. Profile Updated.</p>';

    }
    
    ?>
    
    

    <?php
// preparing form elements:
    $first_name = array(
        'name' => 'first_name',
        'id' => 'first_name',
        'size' => 45,
        'value' => set_value('first_name', $user_info['first_name']),
        'class' => 'ui-corner-all'
    );

    $last_name = array(
        'name' => 'last_name',
        'id' => 'last_name',
        'size' => 45,
        'value' => set_value('last_name', $user_info['last_name']),
        'class' => 'ui-corner-all'
    );

    $job_title = array(
        'name' => 'job_title',
        'id' => 'job_title',
        'size' => 45,
        'value' => set_value('job_title', $user_info['job_title']),
        'class' => 'ui-corner-all'
    );

    echo form_open('account/');
    echo form_label('First Name', $first_name['id']);
    echo form_input($first_name);

    echo form_label('Last Name', $last_name['id']);
    echo form_input($last_name);

    echo form_label('Job Title', $job_title['id']);
    echo form_input($job_title);
    
    
    echo form_hidden('action', $formtype);


    echo form_submit('submit', 'Save', 'class="ui-corner-all"');
    echo form_close();
    ?>

</div>