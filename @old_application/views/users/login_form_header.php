<div id="loginform_header">


  
  <?php //echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
  <?php //if ($incorrect_login == 1) { echo '<p class="ui-state-error ui-corner-all">Opps! wrong username or password.</p>'; };  ?>
  
  <?php
	
	// preparing form elements:
	$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'size'	=> 32,
	'value' => 'username',
	'class' => 'ui-corner-all'
	);
	
	$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => 'password',
	'class' => 'ui-corner-all'
	);
		
	echo form_open('users/validate');
	
	echo form_input($username);
	
	echo form_password($password);
	echo form_submit('submit', 'Sign In', 'class="ui-corner-all"');
	echo form_close();
	?>

</div><!-- end login_form-->