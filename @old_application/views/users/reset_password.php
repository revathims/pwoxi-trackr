<div id="loginform" class="ui-corner-all">

    <h1>Reset Password</h1>

    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>


    <?php if ($errors) {
    ?>
        <p class="ui-state-error ui-corner-all"><?php echo $errors; ?></p>
    <?php } ?>

    <?php if ($message) {
    ?>
        <p class="ui-state-highlight ui-corner-all"><?php echo $message; ?></p>
    <?php } ?>

    <div class="pagecontent-left">

        <?php
        // preparing form elements:
        $email = array(
            'name' => 'email',
            'id' => 'email',
            'size' => 32,
            'value' => set_value('email'),
            'class' => 'ui-corner-all'
        );


        echo form_open('users/reset');
        echo form_label('Email', $email['id']);
        echo form_input($email);
        echo form_hidden('action', 'resetpassword');


        echo form_submit('submit', 'Reset Password', 'class="ui-corner-all"');
        //echo anchor('users/signup', 'Signup for FREE account!', 'class="ui-corner-all"');
        echo form_close();
        ?>

    </div>

    <div class="pagecontent-right">




    </div>
    <div class="cleardiv"></div>
</div><!-- end login_form-->