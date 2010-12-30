<div id="addclient" class="ui-corner-all">


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

    <div class="cleardiv"></div>


    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>
    <?php
    if ($some_error == 1) {
        echo '<p class="ui-state-error ui-corner-all">Opps! There was some problem while adding client, please try again.</p>';
    };
    ?>


    <div id="left-content">

        <h1>Add Client to <?php echo $company_detail['company_name']; ?></h1>

        <?php echo form_open('company/addclient_validate'); ?>
        <fieldset>
            <legend>Contact Person</legend>
            <?php
            // preparing form elements:
            $first_name = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'size' => 45,
                'value' => set_value('first_name'),
                'class' => 'ui-corner-all'
            );

            $last_name = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'size' => 45,
                'value' => set_value('last_name'),
                'class' => 'ui-corner-all'
            );

            $email = array(
                'name' => 'email',
                'id' => 'email',
                'size' => 150,
                'value' => set_value('email'),
                'class' => 'ui-corner-all'
            );
            $contact_type_name = array(
                'name' => 'contact_type',
                'id' => 'contact_type',
            );

            $contact_type_more_parameters = 'id="contact_type" class="ui-corner-all"';

            $contact_type_values = array(
                'Owner' => 'Owner',
                'Technical' => 'Technical',
                'Administrative' => 'Administrative',
                'Support' => 'Support',
            );



            echo form_label('First Name', $first_name['id']);
            echo form_input($first_name);
            echo form_label('Last Name', $last_name['id']);
            echo form_input($last_name);
            echo form_label('Email', $email['id']);
            echo form_input($email);
            echo form_label('Contact Type', $contact_type_name['id']);
            echo form_dropdown($contact_type_name['name'], $contact_type_values, '', $contact_type_more_parameters);
            ?>
            
        </fieldset>

        <fieldset>
            <legend>Company Information</legend>
            <?php
            $company_name = array(
                'name' => 'company_name',
                'id' => 'company_name',
                'size' => 45,
                'value' => set_value('company_name'),
                'class' => 'ui-corner-all'
            );

            $phone = array(
                'name' => 'phone',
                'id' => 'phone',
                'size' => 45,
                'value' => set_value('phone'),
                'class' => 'ui-corner-all'
            );




            $fax = array(
                'name' => 'fax',
                'id' => 'fax',
                'size' => 45,
                'value' => set_value('fax'),
                'class' => 'ui-corner-all'
            );

            $url = array(
                'name' => 'url',
                'id' => 'url',
                'size' => 32,
                'value' => set_value('url'),
                'class' => 'ui-corner-all'
            );

            $address = array(
                'name' => 'address',
                'id' => 'address',
                'size' => 32,
                'value' => set_value('address'),
                'class' => 'ui-corner-all'
            );
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
            ?>

<?php
            echo form_submit('submit', 'Add Client', 'class="ui-corner-all"');
            echo form_close();
?>
        </fieldset>
    </div>

    <div class="cleardiv"></div>
</div>
