<div id="homearea" class="ui-corner-all">
    <div id="pagenav">
        <ul>
            <li><a href="<?php echo $base_url; ?>users/" class="ui-corner-bottom active">Dashboard</a></li>
            <li><a href="<?php echo $base_url; ?>users/profile" class="ui-corner-bottom">Profile</a></li>
												<li><a href="<?php echo $base_url; ?>users/changepassword" class="ui-corner-bottom">Change Password</a></li>
        </ul>
        <div class="cleardiv"></div>
    </div>


    <h1><?php echo $user_detail['first_name'] . ' ' . $user_detail['last_name']; ?> Profile</h1>
    <?php if ($errors) { echo $errors; } ?>
    <?php if ($message) {    ?>
        <p class="ui-state-highlight ui-corner-all"><?php echo $message; ?></p>
    <?php } ?>

    <?php echo validation_errors('<p class="ui-state-error ui-corner-all">', '</p>'); ?>

        
<div class="pagecontent-left">
        <h4>Profile Picture</h4>
    <p>Your profile appears on every page, picture must be in GIF, JPEG or PNG format and cannot be more then 100 pixels wide.</p>
    <div id="showlogo" class="ui-corner-all">
        <?php
        // if company logo is in FB
        if ($user_detail['profile_pic'] != NULL || $user_detail['profile_pic'] != '') {
            // @todo add file exists checking here
        ?>
            <div class="logo"> <?php echo img_tag($user_detail['profile_pic'], ' alt="' . $user_detail['first_name'] . '"', 'profile'); ?> </div>
            <p class="margin-bottom"><a href="javascript:void(0);" id="delaction" onclick="javascript:del_ppic('<?php echo $user_detail['uid'] ?>');">Delete this picture</a></p>
        <?php } ?>
        <?php
        $upload_picture = array(
            'name' => 'upload_picture',
            'id' => 'upload_picture',
            'class' => 'ui-corner-all'
        );

        echo form_open_multipart('users/picture_upload');
        echo form_upload($upload_picture);
        echo form_submit('submit', 'Upload Now', 'class="ui-corner-all block margin-top"');
        echo form_close();
        ?>
    </div>

</div>


        <div class="pagecontent-right">

    <h4>Information</h4>
    <p class="margin-bottom">Your profile information will reflect on your billing address and as well to public.</p>
    <?php
        // preparing form elements:
        $first_name = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'size' => 32,
            'value' => set_value('first_name', $user_detail['first_name']),
            'class' => 'ui-corner-all'
        );

        $last_name = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'size' => 32,
            'value' => set_value('last_name', $user_detail['last_name']),
            'class' => 'ui-corner-all'
        );
								
								    $job_title = array(
            'name' => 'job_title',
            'id' => 'job_title',
            'size' => 32,
            'value' => set_value('job_title', $user_detail['job_title']),
            'class' => 'ui-corner-all'
        );


        $email = array(
            'name' => 'email',
            'id' => 'email',
            'size' => 32,
            'value' => set_value('email', $user_detail['email']),
            'class' => 'ui-corner-all'
        );

        echo form_open('users/profile_update');
        echo form_label('First Name', $first_name['id']);
        echo form_input($first_name);
        echo form_label('Last Name', $last_name['id']);
        echo form_input($last_name);
								
								echo form_label('Job Title', $job_title['id']);
        echo form_input($job_title);

        echo form_label('Email', $email['id']);
        echo form_input($email);

        echo form_submit('submit', 'Update', 'class="ui-corner-all block margin-top"');
        echo form_close();
    ?>


        </div>
        <div class="cleardiv"></div>
</div>
