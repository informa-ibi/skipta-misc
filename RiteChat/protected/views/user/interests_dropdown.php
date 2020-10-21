<?php if($DropdownList != "failure"){ ?>
<ul aria-labelledby="drop2" role="menu">
    <?php foreach ($DropdownList as $key => $value) { ?>
        <li role="presentation"><a  onclick="addNewInterest('<?php echo $value['Id']; ?>', '<?php  echo $value['Interests']; ?>')" tabindex="-1" role="menuitem"><?php echo str_replace("Interests"," Interests",$value['Interests']); ?> </a></li>

    <?php } ?>

</ul>
<?php } ?>