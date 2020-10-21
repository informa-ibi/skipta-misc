<?php if($DropdownList != "failure"){ ?>
<ul aria-labelledby="drop2" role="menu">
    <?php foreach ($DropdownList as $key => $value) { ?>
        <li role="presentation"><a  onclick="addNewEducation('<?php echo $value['Id']; ?>', '<?php echo $value['Categoryname']; ?>')" tabindex="-1" role="menuitem"><?php echo $value['Categoryname']; ?> </a></li>

    <?php } ?>
</ul>
<?php } ?>