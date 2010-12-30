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

    <h4>Projects</h4>

  


    <?php
    if ($all_clients_count > 0) {




        if (count($all_projects)) {

            foreach ($all_projects as $row) {
    ?>




<?php
            }
        }

        // if count is zero then show friendly message
        else {
?>
  <div class="subpagenav">
        <ul>
            <li><a href="<?php echo $base_url; ?>company/addproject" class="ui-corner-all active">Add Project</a></li>
        </ul>
    </div>
    <div class="cleardiv"></div>
            <h3>You don't have any projects yet, <a href="<?php echo $base_url; ?>company/addproject" class="ui-corner-all active">please add one</a> to start using <?php echo config_item('site_name'); ?></h3>

<?php } ?>


<?php
        } // if count is zero then show friendly message
        else {
    ?>

            <h3>You don't have any clients yet, <a href="<?php echo $base_url; ?>company/addclient">please add one</a> to start using projects.</h3>

    <?php } ?>

            

    <div class="cleardiv"></div>



</div>