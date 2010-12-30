<div id="createuser" class="ui-corner-all">

    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
    <?php
    if ($some_error == 1) {
        echo '<p class="ui-state-error ui-corner-all">Opps! There was some problem while signing you up, please try again.</p>';
    };
    ?>


    <div id="left-content">

         <h1>Signup for Free!</h1>
         
<?php echo form_open('users/validatesignup'); ?>
        <fieldset>
            <legend>Personal Information</legend>
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

            $company_name = array(
                'name' => 'company_name',
                'id' => 'company_name',
                'size' => 45,
                'value' => set_value('company_name'),
                'class' => 'ui-corner-all'
            );

            $email = array(
                'name' => 'email',
                'id' => 'email',
                'size' => 150,
                'value' => set_value('email'),
                'class' => 'ui-corner-all'
            );

            echo form_label('First Name', $first_name['id']);
            echo form_input($first_name);
            echo form_label('Last Name', $last_name['id']);
            echo form_input($last_name);
            echo form_label('Company Name', $company_name['id']);
            echo form_input($company_name);
            echo form_label('Email', $email['id']);
            echo form_input($email);
            echo '<div id="email_status"></div>';
            ?>
        </fieldset>
        <fieldset>
            <legend>Login Information</legend>
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

            $password2 = array(
                'name' => 'password2',
                'id' => 'password2',
                'class' => 'ui-corner-all'
            );

            echo form_label('Username', $username['id']);
            echo form_input($username);
            echo '<div id="username_status"></div>';
            echo form_label('Password', $password['id']);
            echo form_password($password);
            echo form_label('Password Confirm', $password2['id']);
            echo form_password($password2);
            ?>
            </fieldset>
        <?php
            echo form_submit('submit', 'Create Acccount', 'class="ui-corner-all"');
            echo form_close();
        ?>
        </div>
        <div id="right-content">
           
            <h4>No credit card or billing information is required and you can cancel your account at any time.</h4>
            <p><strong>What do I get for free?</strong><br />
                You get 1 user, unlimited projects and unlimited clients, totally free.</p>
            <p><strong>What are the pricing plans?</strong><br />
                We offer a multi-user (gold) plan for <strong>$15</strong>/pm, and a single user (silver) plan for <strong>$5</strong>/pm.
            <p><strong>Is it secure?</strong><br />
                Yes <?php echo $site_name; ?> is safe and secure with 128-bit SSL encryption, pro-active server management and daily backups.
            <p><strong>Who uses <?php echo $site_name; ?>?</strong><br />
            We are trusted by thousands of small businesses and we get great testimonials almost daily!
    </div>
    <div class="cleardiv"></div>
</div>
