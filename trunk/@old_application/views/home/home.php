<!--<div id="nav" class="ui-corner-all">
<?php
//echo anchor('users/profile', 'Profile', 'class="ui-corner-all"');
//echo anchor('users/signout', 'Sign Out', 'class="ui-corner-all"');
?>
</div>-->

<div id="homearea" class="ui-corner-all">
  <div id="left-content">
    <h1>Get organized, in minutes!</h1>
    <ul id="signup-points">
      <li>manage projects quickly and intuitively.</li>
      <li>collaborate with your team and track time.</li>
      <li>manage and maintain releases.</li>
						<li>create invoices and get paid online.</li>
    </ul>
    <div id="buttons">
				
				<?php
				$is_logged_in = $this->session->userdata('is_logged_in');
				if (!isset($is_logged_in) || $is_logged_in != TRUE){ ?>
				<a href="users/signup" class="likebtn ui-corner-all">Signup for FREE account!</a>
				<?php } ?>
				
				<a href="tour" class="likebtn ui-corner-all">Take the tour</a> </div>
  </div>
  <div id="right-content">
    <div id="video" class="ui-corner-all"><?php echo img_tag('video-intro.jpg', ' alt="Tour Video"'); ?></div>
  </div>
  <div class="cleardiv"></div>
</div>
