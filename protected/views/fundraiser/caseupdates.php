<style>
    .why_use_mobi_title_blk {
        background-color: #1f1a17;
        padding: 10px;
        width: 300px;
        clear: both;
    }
    .why_use_mobi_title_blk h3 {
        color:#ffffff;
    }
    .csh_img img {
    height: 221px;
    width: 186px;
       margin-top: 0px;
    float: left;
        margin-right: 20px;
}
.dtd {
    margin-left: 33px;
    display: block;
    font-size: 18px;
}
.simply-scroll {
    display: none;
}
div#why_use_mobiTrust_content {
    border-bottom: 1px solid #1982b3;
}
#Crowd_Support {
    display:  block;
    overflow:  hidden;
    margin-bottom: 30px;
}
.fdd_cl p {
    width: auto;
    margin: 5px 0;
    float: none;
}
</style>
<!--Start content----------------------------------------------------------->
<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport'/>
<?php

$fundraisertitle = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser_object->fundraiser_title);
$this->metaTitle = $fundraiser_object->fundraiser_title;
$page_url = ABS_PATH . $_SERVER['REDIRECT_URL']."/index.php/fundraiser/".$fundraiser_object->id."/".$fundraisertitle;
//$page_url = 'http://testing.siliconithub.com/MobiTrustWeb/cms/aboutus';
$fb_share = file_get_contents('http://graph.facebook.com/?id=' . $page_url . '');
$fb_share1 = json_decode($fb_share);
//$fb_share_count = FrontCoreController::fb_count($page_url);
?>
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!-- Start content -->
<?php $dddd=$_REQUEST['id'];?>

<?php $featured_fundraiseraa = CaseUpdates::model()->find(array('select' => '*', 'condition' => 'id = "' . $dddd . '" ')); ?>
<?php $featured_fundraiseraa22 = SetupFundraiser::model()->find(array('select' => '*', 'condition' => 'id = "' . $featured_fundraiseraa->fundraiser . '" ')); ?>
<div class="inner-container">
    <div class="inner-left fdd_cl">
     <?php echo CHtml::hiddenField('new_id', $dddd, array('id' => 'new_id12')); ?>

        <?php
//                 $case_updt = SetupFundraiser::model()->findAll(array('select' => '*', 'condition' => 'ftype_id = "' . $fundraiser_object->ftype_id . '" '));
                 //$featured_fundraiser = CaseUpdates::model()->findAll(array('select' => '*', 'condition' => 'fundraiser = "' . $featured_fundraiseraa->fundraiser . '" AND id != "' . $featured_fundraiseraa->id . '" '));
                $featured_fundraiser = CaseUpdates::model()->findAll(array('select' => '*', 'order'=>'id DESC', 'condition' => 'fundraiser = "' . $featured_fundraiseraa->fundraiser . '" '));
//                $featured_fundraiser = SetupFundraiser::model()->findAll(array('select' => '*', 'condition' => 'ftype_id = "' . $fundraiser_object->ftype_id . '" '));
                $chunk_record = array_chunk($featured_fundraiser, 4);
                if (!empty($chunk_record)) {
                    foreach ($chunk_record as $chunk_row) { ?>
                            <?php
                            if (!empty($chunk_row)) {
                                foreach ($chunk_row as $chunk_sub) {
                                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $chunk_sub->message_update);
                                    $title = str_replace("'", '', $title);
                                    $title = strtolower($title); ?>
        <div id="case-<?php echo $chunk_sub->id; ?>">
        
        <div id="why_use_mobiTrust_content" class="inner-page">
       
        <div class="Crowd_Support" id="Crowd_Support" style="margin-top:40px;">
            
            <div id="Crowd_Support" class="csh_img">
                <img style="" src="<?php echo SITE_ABS_PATH_IMAGE . $chunk_sub->image; ?>" alt=""/>
               <artical> 
               <h3 class="dtd"><?php echo date('M dS', strtotime($chunk_sub->update_date)); ?></h3>
               <p><?php echo nl2br($chunk_sub->message_update); ?></p>
<!--                <h3><?php //echo $Crowd_Support->page_name; ?></h3>-->
               </artical>
            </div>
            <!--<h3 id="Crowd_Support"><?php echo $Crowd_Support->page_name; ?></h3>-->

            
            <?php //echo $chunk_sub->video; ?>
            <?php if(!empty($chunk_sub->video)) { ?>
            <div class="vid_dv">    
                    <?php /* ?>
                    <iframe width="420" height="315"
                    src="https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1&mute=1">
                    </iframe>
                    <?php */ ?>
                    <?php  ?>
                    <iframe width="420" height="315"
                        src="<?php echo $chunk_sub->video; ?>&autoplay=1&mute=1">
                    </iframe>
                    <?php  ?>
                    <!-- <iframe width="420" height="315"
                    src="https://www.youtube.com/embed/LcOpR7Br4P8?autoplay=1&mute=1">
                    </iframe> -->
           </div>
             <?php } ?>
        </div>
<!--             <iframe width="420" height="345" src="https://www.youtube.com/embed/XGSy3_Czz8k">
</iframe>-->
    </div>
     </div>     
        
        <?php }
                            }
                            ?>
                      
                    <?php }
                }
                ?>
        
    </div>
        
    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
    </div>

<script>
    $(document).ready(function () {
       // alert("aaaaa");
        var value_dt = '#<?php echo $_REQUEST['id'];?>';
       // alert(value_dt);
        //$("html, body").animate({scrollTop: $(value_dt).offset().top}, 2000);
       // $(value_dt).show();
    });
</script> 
<script>
    $(document).ready(function () {
        $("#3").simplyScroll();
    });
</script>
<script>
    $(document).ready(function () {
        <?php if(!empty($_REQUEST['target'])) {    ?>
        var target = "#<?php echo $_REQUEST['target']; ?>";
        if($(target).length > 0) {
            $('html, body').animate({
                scrollTop: $(target).offset().top - ($('.main_head').height() + 20)
            }, 2000);
        }
        <?php } ?>        
    });
</script>