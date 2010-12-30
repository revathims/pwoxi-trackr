<h2>Add Task</h2>
  
  <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
  
  <?php
	
	// preparing form elements:
	$clients = 'id="clients" class="ui-corner-all"';
	
	$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'class' => 'ui-corner-all'
	);
	
		
	echo form_open('users/validate');
	echo form_label('Client', $clients['id']);
	echo form_dropdown('clients', $clients_lista, '1', $clients);
	echo form_label('Password', $password['id']);
	echo form_password($password);
	echo form_submit('submit', 'Login', 'class="ui-corner-all"');
	echo anchor('users/signup', 'Create Account', 'class="ui-corner-all"');
	echo form_close();
	?>