<div id="home" class="navbar-wrapper" data-spy="affix" data-offset-top="40">
    <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->

    <div class="container"  >
        <!-- login -->
        <div class="pull-right mobilerightclear loginarea	">
            <div class="follower">
                <div class="loginfieldsdiv">       
                    <div class=" logindivarea " role="menu" aria-labelledby="dLabel" id="loginarea"  >
                        <?php include_once(getcwd() . "/protected/views/site/login.php"); ?>
                    </div>


                    <div>


                    </div>

                </div>
            </div>
        </div>		
        <!-- login -->
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>	
                <a class="brand" href="#home"><img class="logo" src="<?php echo "/themes/" . Yii::app()->params['Project'] . Yii::app()->params['Logo']; ?>" /></a>
                <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                <!--/.nav-collapse -->
            </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->
    </div> 
</div>