<div id="createuser" class="ui-corner-all">
    <div id="pagenav">
        <ul>
            <li><a href="<?php echo $base_url; ?>company/" class="ui-corner-bottom active">Dashboard</a></li>
            <li><a href="<?php echo $base_url; ?>company/clients" class="ui-corner-bottom">Clients</a></li>
            <li><a href="<?php echo $base_url; ?>company/projects" class="ui-corner-bottom">Projects</a></li>
            <li><a href="<?php echo $base_url; ?>company/people" class="ui-corner-bottom">People</a></li>
            <li><a href="<?php echo $base_url; ?>company/branding" class="ui-corner-bottom">Branding</a></li>
        </ul>
        <div class="cleardiv"></div>
    </div>
  <h1>Add People For <?php echo $company_detail['company_name']; ?></h1>
		
		
  <?php if ($errors){ echo $errors; } ?>
  <?php if ($message){ ?>
  <p class="ui-state-highlight ui-corner-all"><?php echo $message; ?></p>
  <?php } ?>
  <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
		
  <h4>Information</h4>
  

<?php echo form_open('users/addpeople_validate'); ?>
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
												
												$job_title = array(
                'name' => 'job_title',
                'id' => 'job_title',
                'size' => 45,
                'value' => set_value('job_title'),
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
												
												  echo form_label('Job Title', $job_title['id']);
            echo form_input($job_title);
           
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
            echo form_submit('submit', 'Add', 'class="ui-corner-all"');
            echo form_close();
        ?>
      
		
		
  <div class="cleardiv"></div>
</div>
