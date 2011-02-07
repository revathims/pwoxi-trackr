<h2>People</h2>
<div id="secnav">
    <ul>
        <li><a href="<?php echo $base_url; ?>people/add">Add People</a></li>
    </ul>
</div>
<div class="cleardiv"></div>

<div class="peopletlist">

    <?php 
    if (count($people) > 0) {
     foreach ($people as $row) {
    
    ?>
    
        <div class="list">
            <div class="label"><?php echo $row['email']; ?></div>
            <div class="name"><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></div>
            <div class="desc"><?php echo $row['job_title']; ?></div>
               
        </div>

    <?php }

    } else { ?>

 <div class="list">
            <div class="name">No people added to your company yet. </div>
        </div>

    <?php } ?>

</div>