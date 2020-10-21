<?php if($DropdownList != "failure"){ ?>
<ul aria-labelledby="drop2" role="menu">
    <?php foreach ($DropdownList as $key => $value) { ?>
        <li role="presentation"><a  onclick="addNewAchievement('<?php echo $value['Id']; ?>', '<?php echo $value['Achievement']; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Achievement']; ?> </a></li>

    <?php } ?>

</ul>
<?php } ?>