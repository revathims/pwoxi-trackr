<div id="homearea" class="ui-corner-all">

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

   

    <h1><?php echo $company_detail['company_name']; ?></h1>

    <h4>People</h4>
				
				<div class="subpagenav">
				<ul>
				<li><a href="<?php echo $base_url; ?>users/addpeople" class="ui-corner-all active">Add People</a></li>
				</ul>
				<div class="cleardiv"></div>
                                </div>

    

    <?php foreach ($all_people as $row) {
    ?>

    <?php
        if ($row['main_contact'] == 1) {
            $class_div = 'greendiv';
        } else {
            $class_div = 'bluediv';
        }
    ?>

        <div class="people-box ui-corner-all <?php echo $class_div; ?>">
        <div class="picture">
            <?php
            // if profile picture is in DB
            if ($row['profile_pic'] != NULL || $row['profile_pic'] != '') {
                // @todo add file exists checking here
            ?>
            <?php echo img_tag($row['profile_pic'], ' alt="' . $row['first_name'] . '"', 'profile'); ?>
            <?php } else {
 ?>
<?php echo img_tag('default_small.png', ' alt="' . $row['first_name'] . '"', 'profile'); ?>
<?php } ?>
        </div>
        <div class="name"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></div>
            </div>
<?php } ?>
    <div class="cleardiv"></div>



</div>