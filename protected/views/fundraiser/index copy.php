 <style>
    .bx-wrapper .bx-controls-direction a {
        display: block;
    }

    #slider-col3 .bx-prev {
        display: none;
    }

    #slider-col3 .bx-next {
        display: none;
    }
   .i-left-img {
    background: #eaeaea none repeat scroll 0 0;
    float: left;
    height: 288px !important;
    margin-bottom: 20px;
    margin-top: 28px !important;
    text-align: center;
    width: 100%;
}
.i-left-img img {
    height: 287px;
    margin : auto;
    /* width:100%;
    max-width: 278px; */
    vertical-align: middle;
}
.user_messaging_form {
    color: #1982b3 !important;
}
.inner-page p{
    margin-top: 28px;
}
.at-share-btn-elements {
    margin: 0 auto;
    text-align: center;
}

/*div.example1tooltip {
    max-width: 900px !important;
}*/


.top-box, figure, .bottom-text{
	display:block;
	clear:both;
}

.popup-box {
	overflow: hidden;
	clear:both;
	
}

.top-box figure{
	
	width:40%;
	margin:0 auto !important;
        float: left;
        
}
/*.top-box figure img{
    width: 100%;
}*/

/*.top-box figure img{
 height: 200px !important;   
}*/

.top-box article{
	display:block;
	text-align:center
}

.right-content{
	display:block;
	width: 59%;
        float: right;
	margin:0 auto !important;
/*        border: 1px solid #464646;*/
        overflow: hidden;
/*        padding: 2px;*/
}
.art_cls{
    text-align: center;
    margin-top: 20px;
}
article p{
    line-height: 22px;
    font-size: 14px;
    
}
article h1 {
    font-size: 16px;
    
}
.clr{
    color:#464646;
}
.slider5_col.abcds h4 {
    margin: 15px 0px !important;
    color: green;
    text-align: left;
    margin: 20px 0 0 0;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
}
.vid_dv {
    display: block;
    clear: both;
 }

 .slider-logo{
     position:relative;
 }

 .slider-logo img {          
     border-radius: 50%;     
     width:180px;
     height:120px;
     position: absolute;
     bottom: -15px;
     left: 10px;
 }

 .i-left-img .bx-viewport{
     overflow: visible !important;
 }


 .fundraiser-bg{    
    background-image: url(<?php echo $slider_images['background_image']; ?>) !important; 
    background-size: cover; 
    background-repeat:no-repeat; 
    background-position: center center;  

    float: left;
    height: 288px !important;
    margin-bottom: 20px;
    margin-top: 28px !important;
    text-align: center;
    width: 100%;
    position: relative;
    overflow: visible;
 }

 .fundraiser-champion-logo{
    background-image: url(<?php echo $slider_images['champion_logo']; ?>); 
    background-size: cover; 
    background-repeat:no-repeat; 
    background-position: center center;  
    border: 1px solid black;
    border-radius: 50%;     
    width:180px;
    height:120px;
    position: absolute;
    bottom: -15px;
    left: 10px;
    overflow: visible;
 }

 .fund-img-wrap{
    width: 100%;
    height: 100%;
    position: static;
    margin: auto;
    vertical-align: top;
    z-index: 10000;
    background: #eaeaea none repeat scroll 0 0;
 }

 .fundraiser-image{
    background-image: url(<?php echo $slider_images['fundraiser_image']; ?>); 
    background-size: cover; 
    background-repeat:no-repeat; 
    background-position: center center; 
    width: 300px;
    height: 100%;
    position: static;
    margin: auto;
    vertical-align: top;
 }
 .case-box{
    width:50% !important;
 }

 @media (max-width: 767px){
    .case-img {
        width: 100% !important;
        float: left;
        text-align: center;
    }
    .case-box{
        width: 100% !important;
        text-align: center;
    }
    .case-txt{
        text-align: center;
    }
    
}

.abcds{
    font-family: Arial, Helvetica, sans-serif;
}

.more-cases{
    padding: 5px 0px;
    height: 30px;
}
.more-cases a{
    color: #1982b3;
    text-decoration: none;
    width: 100%;
    float: left;
    font-size: 14px;
}

.case-update-row{
    width:100%;
	padding:0 0 10px 0px;
	margin:0 0 20px 0;
	float: left;
	border-bottom:#f0f0f0 1px solid;
}

</style>

<script>

<?php 

$title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser_object->fundraiser_title);
$title = str_replace("'", '', $title);
$title = strtolower($title);
$short_description = substr($fundraiser_object->tell_ur_fund_story,0,200);
$fundraiser_url = Yii::app()->createAbsoluteUrl('fundraiser/index', array('id' => $fundraiser_object->id, 'fundraiser_name' => $title));

?>

<?php if(!empty($slider_images['background_image'])){ ?>

    $(document).ready(function () {
        setInterval(function() {         
            $(".fund-img-wrap").fadeToggle(3000,'linear');        
        }, 8000);
    });

<?php } ?>

</script>

<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport'/>
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59550d20c87b27bc"></script> 

<?php

$this->metaTitle = $fundraiser_object->fundraiser_title;

?>
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!-- Start content -->
<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <?php $name=$fundraiser_object->fundraiser_title; ?>
            <h4><?php echo $fundraiser_object->fundraiser_title; ?></h4>
                       
            <div class="fundraiser-bg">
                <div class="fund-img-wrap">
                    <div class="fundraiser-image">
                    </div>
                </div> 
                <?php if(!empty($slider_images['champion_logo'])){ ?>
                 <div class="fundraiser-champion-logo">
                 </div>
                 <?php } ?>
            </div>
            
            <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>
            <div class="percent_line" style="width:'.$percentage.'"></div>
            <!-- code for page content -->
            <div class="fundraiser_description_blk">
                <p><?php echo nl2br($fundraiser_object->tell_ur_fund_story); ?></p>
            </div>
        </div>
    </div>

    <?php $percentage = UtilityHtml::get_fundraiser_percent($fundraiser_object->fundriser_goal_amount, $fundraiser_object->id); ?>
    <div class="inner-right">
        <div class="inner-right-col">
            <div class="i-right-ttl">
                <?php echo '' . number_format($fundraiser_object->fundriser_goal_amount, 0, ",", ",") . ' NGN'; ?>
            </div>
            <div class="slider-bottom-img ">
                <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
            </div>
            <div class="percent-col">
                <span><?php echo UtilityHtml::get_fundraiser_percent($fundraiser_object->fundriser_goal_amount, $fundraiser_object->id); ?></span> <?php echo UtilityHtml::fundraiser_time_elapsed($fundraiser_object->fundr_timeline_to); ?>
            </div>
            <p>
                <strong><?php echo Donations::model()->count(array('select' => 'id', 'condition' => 'fundraiser_id = ' . $fundraiser_object->id . '')) ?></strong>
                <b>donations</b><br/>
            </p>

            <div class="btn-col">
                <a href="<?php echo $this->createUrl('fundraiser/donations', array('id' => $fundraiser_object->id, 'fundraiser_name' => $fundraiser_object->fundraiser_title)); ?>"
                   class="donate-btn donation_form">Donate Now</a>

                <div>
                    <?php
                    $title = urlencode($fundraiser_object->fundraiser_title);
                    $url = urlencode($fundraiser_url);
                    $summary = urlencode($fundraiser_object->fundraiser_description);
                    $image = (SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser_object->uplod_fun_img);
                    ?>
                </div>

                <div class="social-btn-tw">
                    <?php
                    echo CHtml::ajaxLink(
                        'Send a hug',
                        array('Fundraiser/Hugcounter'),
                        array(
                            'type' => 'POST', 'data' => array('fundraiser_id' => $fundraiser_object->id),
                            'dataType' => 'json',
                            'success' => 'js: function(data) {
                                $(".hug_count").html("("+data.hug_count+")");
                                if(data.already_hug == 1){
                                alert("You have already sent a hug");
                                }
                        }',
                        ),
                        array('id' => 'btn_hug_count', 'class' => 'social-btn')
                    );
                    ?>

                    <span class="hug_count">
                    (<?php
                        /*
                         * Code for get total hug of fundraiser
                         */
                        $hug_count = FundraiserHug::model()->count(array('select' => 'id', 'condition' => 'fundraiser_id = ' . $fundraiser_object->id . ' '));
                        if (!empty($hug_count)) {
                            echo $hug_count;
                        } else {
                            echo '0';
                        }
                        ?>)	</span>
                </div>
            </div>
        </div>

    </div>
    <div class="inner-right1">
    <div class="f-team">
            <?php

                $fundraiser_data = $fundraiser_object;
                $fundraiser_data = SetupFundraiser::model()->findByPk($_REQUEST['id']);
                $fundraiser_title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser_data->fundraiser_title);
                $fundraiser_title = str_replace("'", '', $fundraiser_title);
                $fundraiser_title = strtolower($fundraiser_title);
                $supporter = Supporter::model()->findAll(array('select' => 'user_id,fundraiser_id,supporter_image,supporter_message', 'condition' => 'fundraiser_id = ' . $_REQUEST['id'] . ' AND status = "Y" ', 'order' => 'id DESC', 'limit' => '3'));

                ?>
                    <div class="f-team-ttl">Fundraising Team</div>

                        <div class="f-team-row">

                            <?php

                            $beneficiary_image = '';
                            $fund_manager_image = '';
                            $lead_supporter_image = '';                            
                            
                            if($fundraiser_object->user_type =='community'){
                                $fund_manager_image = Yii::app()->request->baseUrl . "/uploads/images/one-goal-crest.png"; 
                            }else{                                
                                if(!empty($fundraiser_object->upload_pic_fun_manager)){
                                    $fund_manager_image = SITE_ABS_PATH_FUNDRAISER_IMAGE.$fundraiser_data->upload_pic_fun_manager;                                     
                                }else{
                                    $fund_manager_image = Yii::app()->request->baseUrl."/images/Noimage.jpg";
                                }
                            }

                            if(!empty($fundraiser_object->uplod_pic_lead_supptr)){
                                $lead_supporter_image = SITE_ABS_PATH_FUNDRAISER_IMAGE.$fundraiser_data->uplod_pic_lead_supptr;                                     
                            }

                            if(!empty($fundraiser_data->uplod_pic_benif)){
                                $beneficiary_image = SITE_ABS_PATH_UPLOD_PIC_BENIF_THUMB . $fundraiser_data->uplod_pic_benif;
                            }

                            if(empty($beneficiary_image)){
                                if($fundraiser_object->user_type =='corporate'){

                                if($fundraiser_object->benifi_type =='community'){
                                    $beneficiary_image = Yii::app()->request->baseUrl . "/uploads/images/community-image.png";
                                }else if($fundraiser_object->benifi_type =='public'){
                                    $beneficiary_image = Yii::app()->request->baseUrl . "/uploads/images/public-image.png";
                                }


                                }else{
                                    $beneficiary_image = Yii::app()->request->baseUrl."/images/Noimage.jpg";
                                }
                            }

                            if(empty($lead_supporter_image)){                            
                                if($fundraiser_object->user_type =='corporate'){
                                    $lead_supporter_image = Yii::app()->request->baseUrl . "/uploads/images/one-goal-crest.png";
                                }else{
                                    $lead_supporter_image = Yii::app()->request->baseUrl."/images/Noimage.jpg";
                                }   
                            }       

                            if($fundraiser_object->user_type =='community'){
                                if($fundraiser_object->benifi_type =='community'){
                                    $beneficiary_image = Yii::app()->request->baseUrl . "/uploads/images/community-image.png";
                                }else if($fundraiser_object->benifi_type =='public'){
                                    $beneficiary_image = Yii::app()->request->baseUrl . "/uploads/images/public-image.png";
                                }
                                                                                                
                            }  

                            ?>

                            <div class="f-img">  
                                <img class="round-img" src="<?php echo $beneficiary_image; ?>" alt="" /></div>
                                <p>
                                    <b class="clr"> <?php echo 'Beneficiary'; ?></b>
                                    <br/>
                                    <?php if($fundraiser_object->benifi_type =='public'){ ?> 
                                        <i>- The Public -</i>
                                    <?php }else{ ?>
                                        <i>- <?php echo $fundraiser_object->benifiry_name; ?>-</i>
                                    <?php } ?>
                                    
                                </p>
                            </div>
                            
                            <div class="f-team-row">
                                <div class="f-img"> 
                                    <img class="round-img" src="<?php echo $lead_supporter_image; ?>" alt="" />
                                </div>
                                <p>
                                    <b class="clr"> <?php echo ($fundraiser_object->user_type =='corporate') ? "Lead Sponsor":"Lead Supporter";?></b>
                                    <br/>
                                    <i>- <?php echo $fundraiser_data->lead_supptr_name; ?> -</i>
                                    <br/><?php $user_profile->userType->user_role; ?>
                                </p>
                            </div>
                            
                            <div class="f-team-row">                            
                                <div class="f-img"> 
                                    <img class="round-img" src="<?php echo $fund_manager_image; ?>" alt="" />
                                </div>
                                <p> 
                                    <b class="clr"> <?php echo "Fund Manager"; ?></b>
                                    <?php
                                    $fund_manager_name = $fundraiser_data->fund_mange_name;
                                    if($fundraiser_data->user_type == 'community'){
                                        $fund_manager_name = 'OneGoal';
                                    }
                                    ?>
                                    <br/><i>- <?php echo $fund_manager_name; ?>-</i>                                    
                                </p>
                           </div>
                        <a href="<?php echo $this->createUrl('fundraiser/become_supporter', array('id' => $fundraiser_object->id, 'fundraiser_name' => $fundraiser_object->fundraiser_title, 'fundraiser_image' => $fundraiser_object->uplod_fun_img)); ?>" class="support-btn Supporter_form">Become a Supporter</a>                          
        </div>
    </div>
    <div class="clear"></div>
   
    <div class="fundraiser_bot-link-blk">
            <a href="<?php echo SITE_ABS_PATH."index.php/fundraiser/embed_fundraiser?id=". $fundraiser_object->id."&fundraiser_name=".$fundraiser_object->fundraiser_title."&fundraiser_image=".$fundraiser_object->uplod_fun_img; ?>" class="bot-link Supporter_form" id="embed_fundraiser">Embed this fundraiser on a website or blog</a>
            <a href="<?php echo SITE_ABS_PATH."index.php/fundraiser/report_fundraiser?id=". $fundraiser_object->id."&fundraiser_name=".$fundraiser_object->fundraiser_title."&fundraiser_image=".$fundraiser_object->uplod_fun_img; ?>" class="bot-link Supporter_form">Report this fundraiser</a>
    </div>
    <!--Supporters-->
    <?php $supporters_data = Supporter::model()->findAll(array('select' => '*', 'condition' => 'fundraiser_id = "' . $_REQUEST['id'] . '" '));
  //  if (!empty($supporters_data)) { ?>
        <div id="supporter-row" style="margin-bottom:0px;">
            <div class="inner-container">
                <h4>Supporters (<?php echo count($supporters_data); ?>)</h4>
                <div class="clear"></div>
                <div id="slider-col4">
                    <div id="static_slide">
                       <?php rsort($supporters_data); ?>
                        <?php $supporter_count = count($supporters_data); ?>                        
                            <div class="slider20">
                                <?php 
                                    $user_image = '';
                                    
                                    $static_img_count=12-$supporter_count;
                                    $static_img_array=array();
                                    for($i=1;$i<=$static_img_count;$i++){
                                        //$user_image = Yii::app()->request->baseUrl . "/images/Noimage.jpg";
                                        $user_image = SITE_ABS_PATH_SUPPORTER_THUMB. "/Noimage.jpg";
                                        array_push($static_img_array,$user_image);
                                    }
                                    $merged_array = array_merge( $supporters_data, $static_img_array) ;

                                    foreach ($merged_array as $support) {

                                        $www=$support['supporter_image'];
                                    if(!empty($support['supporter_image']) || file_exists(SUPPORTER_IMAGE_THUMBNAIL . $support['supporter_image'])) {
					                    $user_image = SITE_ABS_PATH_SUPPORTER_THUMB . $support['supporter_image'];
                                    } else {
					                    $user_image = Yii::app()->request->baseUrl. "/images/Noimage.jpg";
                                    }
                                    if(!empty($support['supporter_image']) || file_exists(SUPPORTER_IMAGE_ORIGINAL . $support['supporter_image'])) {
					                    $user_image1 = SITE_ABS_PATH_SUPPORTER_IMAGE . $support['supporter_image'];
                                    } else {
					                    $user_image1 = Yii::app()->request->baseUrl. "/images/Noimage.jpg";
                                    }
                                    $us_detls=Users::model()->find(array( 'select' => 'username', 'condition' => 'id = "' . $support['user_id'] . '" '));
                                    $created_date1=substr($support['created_date'],0,10);
                                    $date12=date_create($created_date1);
                                    $created_date=date_format($date12,"dS F Y");
                                    ?>
                                <?php if(empty($support['supporter_image'])) { ?>
                                <div class="slide_cls"><img src="<?php echo $user_image; ?>"  alt="<?php echo $user_image; ?>"/></div>
                                <?php } else {?>
                                <div class="slide_cls"><img src="<?php echo $user_image; ?>" class="example1tooltip" data-uid='<div class="popup-box"><div class="top-box"><figure><img src="<?php echo $user_image1; ?>" ></figure><div class="right-content"><article><h1><?php echo $us_detls; ?></h1><p>Joined</p><p><?php echo $created_date; ?></p></article><article class="art_cls"><p>Social Media posting (4)</p> <p>Emails sent (40)</p><p>SMS sent (32)</p></article></div></div></div>' title="" alt="<?php echo $user_image; ?>"/></div>
                                <?php } ?>
                            <?php } ?>
                            </div>
                        <?php //}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="case-update-row">
            <h4>Case Updates (<?php echo $total_case_updates; ?>) 
            <?php if($total_case_updates > 0){ ?>
                <?php 
                    $first_case = $case_updates[0]; 
                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $first_case->message_update);
                    $title = str_replace("'", '', $title);
                    $title = strtolower($title); 
                ?>
                <a class="read-more" style="font-size:15px;" href="<?php echo $this->createUrl('fundraiser/caseupdates', array('id' => $first_case->id, 'fundraiser_name1' => $title, )); ?>">View All &raquo;</a>
            <?php } ?>
        </h4>                     
            <?php if(empty($case_updates)) { ?>
                <div id="slider-col5">            
                    <div class="slider5_col abcds">    
                        <h4>No updates available</h4>
                    </div>        
                </div>
            <?php } else { ?>
                <?php foreach($case_updates as $case){ ?>
                <?php 
                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $case->message_update);
                    $title = str_replace("'", '', $title);
                    $title = strtolower($title); 
                ?>
                    <div class="case-box">
                        <div class="case-img">
                            <img style="width:227px;height: 221px"src="<?php echo SITE_ABS_PATH_IMAGE . $case->image; ?>" alt=""/>
                        </div>
                        <div class="case-txt">
                            <strong><?php echo date('M dS', strtotime($case->update_date)); ?></strong><br/>
                            <b><?php echo 'by ' . $case->user_name; ?></b><br/>
                            <?php $ah= nl2br($case->message_update);
                            echo substr($ah, 0, 100) . '...'; ?>
                            <br/>
                            <a class="read-more" href="<?php echo $this->createUrl('fundraiser/caseupdates', array('id' => $case->id, 'fundraiser_name1' => $title,'target'=>'case-'.$case->id )); ?>">Read More &raquo;</a>
                        </div>
                    </div>
                <?php } ?>
        <?php } ?>
        </div>
    </div>
</div>
<?php 


/*                    
$tweet_message = 'Visit this page on Giveyourbit and show humanity by supporting the fundraiser ('.$fundraiser_object->fundraiser_title.')';
?>

<div id="comment-row" style="">
    <div class="inner-container">
        <div style="width: 70%; height:100%; float:left;">
            <div class="fb-like" data-href="<?php echo $fundraiser_url; ?>" data-width="" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
        </div>    
        <div style="width: 30%; height:100%;float:left;text-align:right;">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="<?php echo $tweet_message; ?>" data-url="<?php echo $fundraiser_url; ?>" data-via="giveyourbit" data-lang="en" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div> 
</div>
<?php */ ?>

<div class="clear"></div>
<div id="comment-row" style="padding: 0px;">
    <div class="inner-container">
        <div class="fb-comments" data-href="<?php echo $fundraiser_url; ?>" data-width="100%" data-numposts="5"></div>
    </div>
</div>

<div class="clear"></div>
<div class="inner-container">
    <a href="<?php echo $this->createUrl('fundraiser/donations', array('id' => $fundraiser_object->id, 'fundraiser_name' => $fundraiser_object->fundraiser_title)); ?>"
       class="donate-btn donation_form">Donate Now</a>

    <div class="clear"></div>
    <p>&nbsp;</p>

    <p>&nbsp;</p>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {                            
        $('.example1tooltip').tooltip({
            content:function(event, ui) { 
                return $(this).attr('data-uid'); 
            }
        });
        $('.slider20').bxSlider({
            slideWidth: 70,
            minSlides: 1,
            maxSlides: 11,
            slideMargin: 20,
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.slider2').bxSlider({
            slideWidth: 70,
            minSlides: 3,
            maxSlides: 12,
            slideMargin: 19.5
        });
    });
</script>
<?php
if(!empty($_REQUEST['fundraiser_code'])){ ?>
    <?php $loadurl = $this->createUrl('fundraiser/become_supporter', array('id' => $fundraiser_object->id, 'fundraiser_name' => $fundraiser_object->fundraiser_title, 'fundraiser_image' => $fundraiser_object->uplod_fun_img,'code'=>$_REQUEST['fundraiser_code']));
    ?>

    <script>
        $(document).ready(function () {

            $.fancybox.open([
                {
                    href : "<?php echo $loadurl; ?>"
//                    title : '1st title'
                }]
                , {
                    maxWidth: 600,
                    maxHeight: 410,
                    fitToView: false,
                    width: '100%',
                    height: '100%',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    'type': 'iframe',
                    helpers : { overlay : { locked : false,closeClick: false  } }
            });

        });
    </script>
<?php }
?>

<?php
/*
if(!empty($_REQUEST['sendflag'])){  
?>
    <?php $loadurl = $this->createUrl('fundraiser/supporter_message', array('flag' => '1')); ?>
    <script>
        $(document).ready(function () {

            $.fancybox.open([
                    {
                        href : "<?php echo $loadurl; ?>"
//                    title : '1st title'
                    }]
                , {
                    maxWidth: 300,
                    maxHeight: 20,
                    fitToView: false,
                    width: '100%',
                    height: '100%',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    'type': 'iframe',
                    helpers : { overlay : { locked : false,closeClick: false  } }
                });

        });
    </script>
<?php } */?>

<?php
if(!empty($_REQUEST['report_id'])){ ?>
    <?php $loadurl = $this->createUrl('fundraiser/report_response',array('report_id'=>$_REQUEST['report_id'])); 
   //   $loadurl=  SITE_ABS_PATH."fundraiser/report_fundraiser?id=". $fundraiser_object->id."&fundraiser_name=".$fundraiser_object->fundraiser_title."&fundraiser_image=".$fundraiser_object->fundraiser_image; 
?>

    <script>
        $(document).ready(function () {

            $.fancybox.open([
                    { 
                        href : "<?php echo $loadurl; ?>"
//                    title : '1st title'
                    }]
                , {
                    maxWidth: 350,
                    maxHeight: 165,
                    fitToView: false,
                    width: '100%',
                    height: '100%',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    'type': 'iframe',
                    helpers : { overlay : { locked : false,closeClick: false  } }
                });

        });
    </script>
    
<?php }
?>

<!-- Script code for the home banner slider -->
<script>
    $('#fundraiser_slider').bxSlider({
        mode: 'fade',
        auto: true,
        //captions: true,
        controls:false,
        pause: 1000,
        speed: 4000
    });
</script>

