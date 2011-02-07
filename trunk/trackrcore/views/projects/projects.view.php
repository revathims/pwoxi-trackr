<h2>Projects</h2>
<div id="secnav">
    <ul>
        <li><a href="<?php echo $base_url; ?>projects/add">Add Project</a></li>
    </ul>
</div>
<div class="cleardiv"></div>

<div class="projeclist">

    <?php 
    if (count($projects) > 0) {
     foreach ($projects as $row) {
    
    ?>
    
        <div class="list">
            <div class="label"><?php echo $row['label']; ?></div>
            <div class="name"><?php echo $row['project_name']; ?></div>
            <div class="desc"><?php echo $row['project_description']; ?></div>
               
        </div>

    <?php }

    } else { ?>

 <div class="list">
            <div class="name">No projects, yet. </div>
        </div>

    <?php } ?>

</div>