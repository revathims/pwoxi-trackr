<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php echo $site_name; ?></title>
<?php echo add_jscript('jquery'); ?>
<?php echo add_jscript('lib'); ?>
<?php echo add_style('main'); ?>
</head>
<body>
<!-- hidden stuff start -->
<div id="ajaxloading" class="ui-corner-all"><?php echo img_tag('ajax-loader.gif', ' alt="Loading..."'); ?></div>

<!-- hidden stuff end -->
<div id="wrapper">
  <div id="header">
    <div id="logo"> <a href="<?php echo $base_url; ?>"><?php echo img_tag('logo.png', ' alt="'.$site_name.'"'); ?></a> </div>
    <div id="headerlogin">

        <?php
        $is_logged_in = $this->init->_get_session_uid();
        if (!isset($is_logged_in) || $is_logged_in != TRUE)
								{
         //  $this->load->view("users/login_form_header.php");
        }
        else
        {
           // $this->load->view("users/logged_in_header.php");
        }
        ?>


    </div>
    <div class="cleardiv"></div>
  </div>
  <?php $this->load->view($main_content); ?>
    <div id="footer" class="ui-corner-all"> Copyright &copy; 2011. Pwoxi Solutions - <?php echo $site_name; ?> &mdash; <a href="/logout">Logout</a></div>
</div>
</body>
</html>
