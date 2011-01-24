<h2>Projects</h2>
<div id="secnav">
    <ul>
        <li><a href="<?php echo $base_url; ?>projects/add">Add Project</a></li>
    </ul>
</div>
<div class="cleardiv"></div>

<div class="projectlist">
    <?php foreach ($projects as $row) {
    ?>
    
        <div class="project">
            <div class="project_label"><?php echo $row['label']; ?></div>
            <div class="project_name"><?php echo $row['project_name']; ?></div>
            <div class="project_desc"><?php echo $row['project_description']; ?></div>
               
        </div>

    <?php } ?>

</div>