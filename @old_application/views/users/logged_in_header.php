<div id="loginform_header">

    <?php //@todo replace the links below with CI link creation helper. ?>

    <div id="buttons">

        <?php
        // if company's main contact then only show the My Company Link
        $main_contact = $this->session->userdata('main_contact');
        if ($main_contact == 1) {
 ?>
            <a href="<?php echo $base_url; ?>company/" class="likebtn ui-corner-all">My Company</a>
<?php } ?>

        <a href="<?php echo $base_url; ?>users/" class="likebtn ui-corner-all">My Account</a>
        <a href="<?php echo $base_url; ?>users/signout" class="likebtn ui-corner-all">Sign Out</a>
    </div>



</div><!-- end login_form-->