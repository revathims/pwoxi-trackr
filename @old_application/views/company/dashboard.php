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

    <h4>Activity Stream</h4>

    <?php if (count($activity_stream)) { ?>
    <ul>

        <?php foreach ($activity_stream as $row) { ?>
        <li><?php echo $row['text']; ?></li>
        <?php } ?>

    </ul>

    <?php
    }
    else {
    ?>
    <h3>No Activity yet.</h3>
    <?php } ?>
    <div class="cleardiv"></div>



</div>