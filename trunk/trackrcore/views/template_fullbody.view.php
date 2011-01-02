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
        <div id="wrapper" class="fullscreen">

            <div id="logo"> <a href="<?php echo $base_url; ?>"><?php echo img_tag('logo.png', ' alt="' . $site_name . '"'); ?></a> </div>

            <?php $this->load->view($main_content); ?>

        </div>

    </body>
</html>