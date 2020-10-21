 <?php $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
$displayName = Yii::app()->session['TinyUserCollectionObj']['DisplayName'];
?>
         <div id="wah-menu" class="wah-menu" >

             <div class="wah-ul">
                 <?php if(Yii::app()->params['Project']=='Trinity'){ ?>
    <div class="tr_left_pannel " >
    	<div class=" row-fluid">
                <div class="span12">
                <div class="trinity_logo "><img src="/images/system/trinity_logo.png" /></div>
              </div>      
        </div> 
        </div>
                 <?php }?>    
        <div class="preloginbg" >
<div class="pre_loginheader">Login</div>
                            <div class=" logindivarea leftthememenuarea " role="menu" aria-labelledby="dLabel" id="loginarea"  >
<?php include_once(getcwd()."/protected/views/site/login.php");?>
                            </div>
</div>
        <ul class="sidebar-menunav" id="headerBeforeLoginForPostDetail" style="display: none">
   
 <!--one-->
 
 <li class="tr_Stream"><a  ><i class="fa fa-stack-exchange"></i> Stream</a></li>
  <li class="tr_Curbside"><a ><i class="fa fa-quote-left"></i> Curbside</a></li>
                        <li class="tr_Groups"><a class="" ><i class="fa fa-users"></i>  Groups</a>
                         </li>
                                               <li class="tr_PrivateMessaging">
                          <a id="Private_Messaging" class="cursorp " onclick="divrenderget('chatDiv','/chat/index')"><i class="fa fa-clipboard"></i>Private Messaging</a></li>
                                                       <li id="news" class="tr_PrivateMessaging tr_singlemenu">
            
            
        <a id="Private_Messaging" class="cursorp " ><i class="fa fa-list-alt"></i> News</a>
        
        </li>
                
                 <li id="weblinks" class="tr_PrivateMessaging tr_singlemenu">
            <a class="  cursorp " ><i class="fa fa-link"></i>Quick Links</a> </li>
            
        
                <li id="games" class="tr_PrivateMessaging tr_singlemenu">
            <a  ><i class="fa fa-puzzle-piece"></i>Games</a>
        </li>
               
                                              
                                         
        </ul>    
        </div>
               

        </div>
      
<script type="text/javascript">
    $(document).ready(function(){
        Custom.init();

    });
    
    
</script>