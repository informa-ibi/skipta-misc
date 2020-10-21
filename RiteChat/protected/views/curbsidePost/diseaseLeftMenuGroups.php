<!-- Pop up  Content -->

<?php
try {
    ?>
         <script type="text/javascript">
               if('<?php echo count($groups) ?>'>0)
                   {
                       $("#groupsMenu").show();


                       }
                       else
                       {
                           $("#groupsMenu").hide();

                       }
         </script>
          
                   
               <?php if(count($groups) > 0){ ?>
                   <div>

                        <?php foreach ($groups as $group) {$i=0;
                           
                       ?>
  <div class="disease_topicssectiondiv topicsClassAdmin " id="<?php echo  $group['_id']?>Mgmnt" onclick="sessionStorage.objclicked='<?php echo  $group['_id']?>Mgmnt';">
                                                <div class="disease_topic_icon">
                                                    <a class="pull-left marginzero smallprofileicon"><img src="<?php echo$group['GroupProfileImage'] ?>"></a>
                                                </div>
                                                <div class="disease_topic_menutitle">
                                               <a href="/<?php echo  $group['GroupName'] ?> "><?php echo $group['GroupName'] ?></a>      
                                              
                         
                                                </div>
                                                </div>
                          
                          
                     
               <?php $i=$i+1;} ?> 
                       
                       
            
                      <?php } else {?>
                    <div style="text-align:center;">
                   No data found
                   </div>
               <?php } ?> </div>
                <?php if($groupsCount>5) { ?>
                           
                             <div class="alignright clearboth paddingr10"> <a class="more" href="/groups">more <i class="fa fa-youtube-play"></i></a></div>
                           
                       <?php } ?>

             
           
          

    <?php
} catch (Exception $exc) {
    
}
?>

