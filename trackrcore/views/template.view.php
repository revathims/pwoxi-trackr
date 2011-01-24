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
        <div id="wrapper" class="normal">
            <div id="header">


                <div id="logo"> <a href="<?php echo $base_url; ?>"><?php echo img_tag('logo.png', ' alt="' . $site_name . '"'); ?></a> </div>

                <div id="topnav">

                    <ul>
                        <li><a href="<?php echo $base_url; ?>">Home</a></li>
                        <li><a href="<?php echo $base_url; ?>settings">My Company</a></li>
                        <li><a href="<?php echo $base_url; ?>profile">Profile</a></li>
                        <li><a href="<?php echo $base_url; ?>logout">Logout</a></li>
                    </ul>
                </div>
                <div id="mainnav">
                    <ul>
                        <li><a href="<?php echo $base_url; ?>">People</a></li>
                        <li><a href="<?php echo $base_url; ?>projects">Projects</a></li>
                    </ul>

                </div>

                <div class="cleardiv"></div>
            </div>
            <?php $this->load->view($main_content); ?>

            <div id="footer" class="ui-corner-all"> Copyright &copy; <?php echo date('Y'); ?>. Pwoxi Solutions - <?php echo $site_name; ?></div>
        </div>
    </body>
</html>
