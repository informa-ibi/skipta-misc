<?php if($DropdownList != "failure"){ ?>
<ul aria-labelledby="drop2" role="menu">
    <?php foreach ($DropdownList as $key => $value) { ?>
        <li role="presentation"><a  onclick="addNewExperience('<?php echo $value['Id']; ?>', '<?php echo $value['Experience']; ?>')" tabindex="-1" role="menuitem"><?php echo str_replace("Experience"," Experience",$value['Experience']); ?> </a></li>

    <?php } ?>

</ul>
<?php } ?>