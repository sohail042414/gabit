<style type="text/css">
 li a{
    cursor:pointer;
    text-decoration:none;
}   
/*
.lead_tab ul li{
    flex-grow: 0 !important;
    margin-right: 33px;
}

.lead_tab ul li:last-child{
    margin-right: 0;
}
*/
.sort_dropdown select {
    background: #fff url("../../../../images/dropdwon-icon.png") no-repeat scroll right top !important;
}
/*************************  dropdown button****************************/
.dropbtna {
    background: #f31126;
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)) !important;
    background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%) !important;
    color: white !important;
    padding: 10px !important;
    font-size: 16px !important;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    width: 236px;
    margin-left: -24px;
/*    font-size: 16px;*/
    font-weight: bold;
    text-align: center;
    
}

/* Dropdown button on hover & focus */
.dropbtna:hover, .dropbtna:focus {
   background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0 !important;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#959595), color-stop(0%,#000000), color-stop(8%,#4e4e4e), color-stop(16%,#4e4e4e), color-stop(50%,#0d0d0d), color-stop(83%,#4e4e4e), color-stop(91%,#4e4e4e), color-stop(100%,#1b1b1b)) !important; /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #959595 0%,#000000 0%,#4e4e4e 8%,#4e4e4e 16%,#0d0d0d 50%,#4e4e4e 83%,#4e4e4e 91%,#1b1b1b 100%) !important; /* Chrome10+,Safari5.1+ */
	color:#FFF !important;
}

/* The container <div> - needed to position the dropdown content */
.dropdowna {
    position: relative;
    display: inline-block;
/*    margin-left: 446px;
    margin-bottom: 20px;*/
    margin-left: 35px;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-contenta {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-contenta a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-contenta a:hover {background-color: #f1f1f1}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.showa {
    display:block;
    padding: 10px;
    min-width: 136px !important;
}
#yt0{
    background-color: #FFF !important;
    width: 48% !important;
    border: none !important;
    padding: 3px !important;
}
#yt1{
    background-color: #FFF !important;
    width: 48% !important;
    border: none !important;
    padding: 3px !important;
    
}
.vvv {
    margin-top: 0px !important;
    padding: 20px 25px !important;
    margin-bottom: 55px;
    
}
.sub-menu li{
 list-style:none;
 display:inline-block;
}

.sub-menu li:first-child{
 position:relative;
}

#sub1 li{
 display: inline-block;
 padding: 0 !important;
}

#sub2 li{
 display:inline-block;
 padding: 0 !important;
}

#sub1{
 position: absolute;
    top: 103%;
    padding-left: 0;
    width: 251px !important;
    background-color: #ccc;
    margin: 0 !important;
    left: -3.5%;
}

#sub2{
 position: absolute;
    top: 105%;
    padding-left: 0;
    width: 251px !important;
    background-color: #ccc;
    left: 0.0%;
    margin: 0 !important;
}

#sub1, #sub2{
 display:none;
}
ul.sub-menu {
    text-align: center;
    margin: 0 !important;
    /* margin: 0 auto; */
    float: none;
}

ul#sub1 li a{
    text-align: center;
}

ul#sub2 li a{
    text-align: center;
}
#spn_err{
    color: red;
    font-size: 12px;
    margin-left: 179px;
    text-align: left;
}
div#bn_em {
    /* color: red; */
    font-size: 12px;
    text-align: left;
    line-height: 26px;
    clear: both;
    margin-left: 182px;
    float: left;
    width: 277px;
}
.no_nw{
    display: block !important ;
    font-size: 14px;
    margin-bottom: 13px;
    text-align: left;
    width: 100%;
}
.textbx {
    margin-right: 5px;
    width: 11.4% !important;
}
.textbx2 {
    margin-right: 0 !important;
   }
.box-body{
    margin-top: 5px !important;
}
.alert{
    margin-top: 30px !important;
}
</style>
<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<?php echo $this->renderPartial('/layouts/cms_banner');?>
<div class="inner-container">
    <div class="lead_support">
        <h4>View/Manage My Fundraiser</h4>
        <div class="lead_tab">
            <?php echo $this->renderPartial('/layouts/dashboard_menu');?>
        </div>
    </div>
    <div class="dashboard_content">
        <div class="inner-page">
            <div id="report_manage_fundraiser">
                <div class="box-body" >
                    <?php echo UtilityHtml::get_flash_message(); ?>
                    <div id="tabs-container">                         
                        <ul class="tabs-menu">                        
                            <li <?php if($tab == 'reports'){ ?> class="current" <?php } ?> ><a href="#tab-1">Reports</a></li>
                            <li <?php if($tab == 'messages'){ ?> class="current" <?php } ?> ><a href="#tab-2">Messaging </a></li>
                            <li <?php if($tab == 'photo'){ ?> class="current" <?php } ?> ><a href="#tab-3">Update Fundraiser Photo</a></li>
                            <li <?php if($tab == 'case'){ ?> class="current" <?php } ?> ><a href="#tab-4">Case Updates </a></li>
                            <?php /*?><li <?php if($tab == 'reward'){ ?> class="current" <?php } ?> ><a href="#tab-5"> Reward program</a></li><?php */ ?>
                            <li <?php if($tab == 'edit'){ ?> class="current" <?php } ?> ><a href="#tab-6">Edit Fundraiser Info </a></li>
                        </ul>                   
                        <div class="tab">

                            <div id="tab-1" class="tab-content" style="<?php echo ($tab == 'reports') ? "display:block;" : "display:none"; ?>" >                                
                                <?php 
                                echo $this->renderPartial('/fundraiser/_reports',array(
                                    'fundraisers_list' => $fundraisers_list,
                                    'tab' =>$tab,
                                    'chart_stats' => $chart_stats,
                                ));
                                ?>
                            </div>
                                                        
                            <div id="tab-2" class="tab-content" style="<?php echo ($tab == 'messages') ? "display:block;" : "display:none"; ?>" >
                                <?php 
                                echo $this->renderPartial('/fundraiser/_messages',array(
                                    'notification' => $notification,
                                    'tab' =>$tab,
                                    'fundraisers_list' => $fundraisers_list,
                                ));
                                ?>
                            </div>
                            <div id="tab-3" class="tab-content" style="<?php echo ($tab == 'photo') ? "display:block;" : "display:none"; ?>" >
                                <?php 
                                    echo $this->renderPartial('/fundraiser/_photo',array(
                                        'model' => $model,
                                        'tab' =>$tab,
                                    ));
                                ?>
                            </div>
                            <div id="tab-4" class="tab-content" style="<?php echo ($tab == 'case') ? "display:block;" : "display:none"; ?>" >
                                <?php 
                                    echo $this->renderPartial('/fundraiser/_case',array(
                                        'case_update' => $case_update,
                                        'case_updates_list' => $case_updates_list,
                                        'fundraisers_list' => $fundraisers_list,
                                        'tab' =>$tab,
                                    ));
                                ?>
                            </div>
                            <?php /* ?>
                            <div id="tab-5" class="tab-content" style="<?php echo ($tab == 'reward') ? "display:block;" : "display:none"; ?>" >
                                <?php 
                                    echo $this->renderPartial('/fundraiser/_reward_program',array(
                                        'case_update' => $case_update,
                                        'tab' =>$tab,
                                        'fundraisers_list' => $fundraisers_list,
                                    ));
                                ?>
                            </div>
                            <?php */ ?>
                            <div id="tab-6" class="tab-content" style="<?php echo ($tab == 'edit') ? "display:block;" : "display:none"; ?>" >   
                                <?php 
                                    echo $this->renderPartial('/fundraiser/_edit',array(
                                        'model' => $model,
                                        'fundraiser' => $fundraiser,
                                        'fundraisers_list' => $fundraisers_list,
                                        'edit_model'=> $edit_model,
                                        'tab' =>$tab,
                                        'ftype_list' => $ftype_list,
                                        'fundraiser_id' => $fundraiser_id,
                                    ));
                                ?>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>    
</div>

<script>
$(document).ready(function() {

    var selected_tab = getUrlParameter('tab');

    console.log('tab');


    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();        
    });
    
});

    
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    var sParameterName;
    var i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

</script>





   