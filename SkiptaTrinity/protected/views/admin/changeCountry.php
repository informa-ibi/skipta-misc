<div class="signdiv">
    <div style="display: none" id="errmsgForCountryChange" class="alert alert-error"></div>
    <div class="alert alert-success" id="sucmsgForCountryChange" style='display: none'></div>          
    
    <div class="row-fluid">
        <div class="span12">
            <div class="span6">
                <label>Old Country</label>
                <div style="padding: 5px;border:1px solid #f4f4f4;font-weight:bold"><?php echo $changeCountryBean->OldCountryName ?></div></div>
            <div class="span6">
                 <label>New Country</label>
                <div style="padding: 5px;border:1px solid #f4f4f4;font-weight:bold"><?php echo $changeCountryBean->NewCountryName ?></div></div>
        </div>
    </div>
    <div class="groupcreationbuttonstyle alignright padding8top">
        <input type="button" value="Accept" id="countryChangeButton" class="btn"> 
        <input type="button" value="Reject" id="countryChangeRejectButton" class="btn btn_gray"> 
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#countryChangeButton').unbind("click");
        $('#countryChangeButton').bind("click", function(){
            acceptCountryChange(<?php echo $changeCountryBean->UserId ?>, <?php echo $changeCountryBean->NewCountryId ?>); 
        });
        $('#countryChangeRejectButton').unbind("click");
        $('#countryChangeRejectButton').bind("click", function(){
            rejectCountryChange(<?php echo $changeCountryBean->UserId ?>); 
        });
    });
</script>