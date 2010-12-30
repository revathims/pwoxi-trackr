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

    <h4>Clients</h4>

    <div class="subpagenav">
        <ul>
            <li><a href="<?php echo $base_url; ?>company/addclient" class="ui-corner-all active">Add Client</a></li>
        </ul>
    </div>
    <div class="cleardiv"></div>


    <?php if (count($all_clients)) {
    ?>

        <table class="grids">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Person Name</th>
                    <th>Phone Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

        <?php foreach ($all_clients as $row) {
        ?>
            <tbody>
                <tr>
                    <td><?php echo $row['company_name']; ?></td>
                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>Edit | Delete | Active</td>

                </tr>
            </tbody>

        <?php } ?>

    </table>

    <?php
    } // if count is zero then show friendly message
    else {
    ?>

        <h3>You don't have any clients yet, <a href="<?php echo $base_url; ?>company/addclient">please add one</a> to start using <?php echo config_item('site_name'); ?></h3>

    <?php } ?>

    <div class="cleardiv"></div>

</div>