<div id="signin" class="ui-corner-all">



    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
    <?php
    if ($incorrect_login == 1) {
        echo '<p class="ui-state-error ui-corner-all">The login details used did not match our records. Please try again.</p>';
    };
    ?>

    <div class="pagecontent-left">
        <h1>Sign In</h1>
        <?php
        // preparing form elements:
        $username = array(
            'name' => 'username',
            'id' => 'username',
            'size' => 32,
            'value' => set_value('username'),
            'class' => 'ui-corner-all'
        );

        $password = array(
            'name' => 'password',
            'id' => 'password',
            'class' => 'ui-corner-all'
        );

        echo form_open('users/validate');
        echo form_label('Username', $username['id']);
        echo form_input($username);
        echo form_label('Password', $password['id']);
        echo form_password($password);

        echo form_submit('submit', 'Sign In', 'class="ui-corner-all"');
        //echo anchor('users/signup', 'Signup for FREE account!', 'class="ui-corner-all"');
        echo form_close();
        ?>

    </div>

    <div class="pagecontent-right">

        <h4>Not a member?</h4>
        <p>Not a problem. It's free to sign up and really quick too. Just click the signup button below.</p>
        <p></p>
        <p class="margin-bottom"><?php echo anchor('users/signup', 'Signup for FREE account!', 'class="ui-corner-all likebtn"'); ?></p>


        <h4>Did you forget your password?</h4>

        <p>Don't worry we'll reset it for you. So many passwords to remember these days!</p>

        <p> <?php echo anchor('users/reset', 'Reset Password', 'class="ui-corner-all likebtn margin-bottom"'); ?></p>


    </div>
    <div class="cleardiv"></div>
</div><!-- end login_form-->