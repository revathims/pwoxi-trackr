<div id="homearea" class="ui-corner-all">
    <div id="pagenav">
        <ul>
            <li><a href="<?php echo $base_url; ?>users/" class="ui-corner-bottom active">Dashboard</a></li>
            <li><a href="<?php echo $base_url; ?>users/profile" class="ui-corner-bottom">Profile</a></li>
												<li><a href="<?php echo $base_url; ?>users/changepassword" class="ui-corner-bottom">Change Password</a></li>
        </ul>
        <div class="cleardiv"></div>
    </div>


    <h1><?php echo $user_detail['first_name'] . ' ' . $user_detail['last_name']; ?> Profile</h1>
    <?php if ($errors) { echo $errors; } ?>
    <?php if ($message) {    ?>
        <p class="ui-state-highlight ui-corner-all"><?php echo $message; ?></p>
    <?php } ?>

    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>

        
<div class="pagecontent-left">
        <h4>Change Password</h4>
    
				<?php
            // preparing form elements:
            $current_password = array(
                'name' => 'current_password',
                'id' => 'current_password',
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
												
												echo form_open('users/changepassword');
												echo form_hidden('action', 'changepassword');
            echo form_label('Current Password', $current_password['id']);
            echo form_password($current_password);
            echo form_label('Password', $password['id']);
            echo form_password($password);
            echo form_label('Password Confirm', $password2['id']);
            echo form_password($password2);
												echo form_submit('submit', 'Change Password', 'class="ui-corner-all"');
            echo form_close();
            ?>
				
</div>


        
        <div class="cleardiv"></div>
</div>
