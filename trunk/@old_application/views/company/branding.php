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
    <h1><?php echo $company_detail['company_name']; ?> Branding</h1>
    <?php if ($errors) {
        echo $errors;
    } ?>
    <?php if ($message) {
 ?>
        <p class="ui-state-highlight ui-corner-all"><?php echo $message; ?></p>
<?php } ?>
<?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>


    <div class="pagecontent-left">
        <h4>Your Logo</h4>
        <p>Your logo appears on every page, logo must be in GIF, JPEG or PNG format and cannot be more then 200 pixels wide.</p>
        <div id="showlogo" class="ui-corner-all">
            <?php
            // if company logo is in FB
            if ($company_detail['logo'] != NULL || $company_detail['logo'] != '') {
                // @todo add file exists checking here
            ?>
                <div class="logo"> <?php echo img_tag($company_detail['logo'], ' alt="' . $company_detail['company_name'] . '"', 'company'); ?> </div>
                <p class="margin-bottom"><a href="javascript:void(0);" id="delaction" onclick="javascript:del_logo('<?php echo $company_detail['cid'] ?>');">Delete this logo</a></p>
            <?php } ?>
            <?php
            $upload_logo = array(
                'name' => 'upload_logo',
                'id' => 'upload_logo',
                'class' => 'ui-corner-all'
            );

            echo form_open_multipart('company/logo_upload');
            echo form_upload($upload_logo);
            echo form_submit('submit', 'Upload Now', 'class="ui-corner-all block margin-top"');
            echo form_close();
            ?>
        </div>

    </div>

    <div class="pagecontent-right">

        <h4>Company Information</h4>
        <p class="margin-bottom">Your company information will reflect on your billing address and as well to public.</p>
        <?php
            // preparing form elements:
            $company_name = array(
                'name' => 'company_name',
                'id' => 'company_name',
                'size' => 32,
                'value' => set_value('company_name', $company_detail['company_name']),
                'class' => 'ui-corner-all'
            );

            $phone = array(
                'name' => 'phone',
                'id' => 'phone',
                'size' => 32,
                'value' => set_value('phone', $company_detail['phone']),
                'class' => 'ui-corner-all'
            );

            $fax = array(
                'name' => 'fax',
                'id' => 'fax',
                'size' => 32,
                'value' => set_value('fax', $company_detail['fax']),
                'class' => 'ui-corner-all'
            );

            $url = array(
                'name' => 'url',
                'id' => 'url',
                'size' => 32,
                'value' => set_value('url', $company_detail['url']),
                'class' => 'ui-corner-all'
            );

            $address = array(
                'name' => 'address',
                'id' => 'address',
                'size' => 32,
                'value' => set_value('address', $company_detail['address']),
                'class' => 'ui-corner-all'
            );

            echo form_open('company/settings_update');
            echo form_label('Company Name', $company_name['id']);
            echo form_input($company_name);
            echo form_label('Phone', $phone['id']);
            echo form_input($phone);

            echo form_label('Fax', $fax['id']);
            echo form_input($fax);
            echo form_label('URL', $url['id']);
            echo form_input($url);

            echo form_label('Address', $address['id']);
            echo form_textarea($address);

            echo form_submit('submit', 'Update', 'class="ui-corner-all block margin-top"');
            echo form_close();
        ?>
    </div>
    <div class="cleardiv"></div>
</div>
