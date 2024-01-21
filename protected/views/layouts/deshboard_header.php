<style>
@media (min-width:801px)  {
    .mobile-explore{
        display: none !important;
    }
    .mobile-explore-wrap{
        display:none;
    }
 }

 @media (max-width:767px)  {
    .mobile-explore-wrap{
        margin : 1px auto;
    }
 }

</style>
<!--Start Header------------------------------------------------------------->
<div class="main_head">
    <div class="center_head">
        <div class="center_head_top">
            <div class="center_head_top_left">
                <div class="logo">
                    <a href="<?php echo $this->createUrl('site/index'); ?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" />
                    </a>
                </div>
            </div>
            <div class="center_head_top_right">
                <div class="center_head_top_right_search_box">
                    <?php $setfun = SetupFundraiser::model()->find(array('select' => '*')); 
             $secr_ys= $setfun->search_yes;
             //if($secr_ys=="1") {?>
                    <?php
                    $model = new SetupFundraiser();
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'locate_fundraiser',
                        'enableAjaxValidation' => false,
                        'action' => array('site/locate_fundraiser')
                    ));
                    echo CHtml::submitButton('', array("class" => "icon"));
		    
		            echo CHtml::hiddenField('selectedvalue','id');
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                'name'=>'search',
                                'value'=>$model->search_field,
                                'source'=>CController::createUrl('site/autocomplete'),
                                'options'=>array(
                                'select'=>'js:function( event, ui ) {
                                            $("#search").val( ui.item.label );
                                            $("#selectedvalue").val( ui.item.value );
                                            return false;
                                      }',
                                ),
                                'htmlOptions'=>array(
                                'onfocus' => 'js: this.value = null; $("#search").val(null); $("#selectedvalue").val(null);',
                                'class' => '#search',
                                'placeholder' => "Search Fundraiser...",
                                ),
                                ));                    
			
		    $this->endWidget();
            // }
                    ?>
                </div>

                <div class="center_head_top_right_login_link logout_cls">
                    <ul>
                        <li><a href="<?php echo $this->createUrl('Fundraise/Logout'); ?>">Logout</a></li>
                    </ul>
                </div>
                <div class="center_head_top_right_social_link1">
                    <span>
                        <?php
                        if ((Yii::app()->controller->id == "fundraise" && (
                                Yii::app()->controller->action->id == "index" 
                                || Yii::app()->controller->action->id == "fund_transfer" 
                                || Yii::app()->controller->action->id == "invite" 
                                || Yii::app()->controller->action->id == "invite_friends"
                            )) 
                            || (Yii::app()->controller->id == "site" && (Yii::app()->controller->action->id == "notifications"))
                            || (Yii::app()->controller->id == "fundraiser" && (Yii::app()->controller->action->id == "managefundraiser"))
                            || (Yii::app()->controller->id == "account" && (Yii::app()->controller->action->id == "profile" || Yii::app()->controller->action->id == "update_profile"))
                            || (Yii::app()->controller->id == "testimonials" && (Yii::app()->controller->action->id == "create"))
                            || (Yii::app()->controller->id == "fundrequest" && (Yii::app()->controller->action->id == "index" || Yii::app()->controller->action->id == "update"))                            
                            ){ 
                        //&&(Yii::app()->frontUser->role =='fundraiser' || Yii::app()->frontUser->role =='supporter')
                        ?>
                        <div class="dropdown">
                            <a class="dropbtn" id="dropbtn6">My Fundraiser</a>
                            <div class="dropdown-content">
                                <?php $myFundraisers = Fundraiser::model()->getMyFundraisers(); ?>
                                <?php foreach ($myFundraisers as $data){ ?>
                                    <a href="<?php echo SITE_ABS_PATH."index.php/fundraiser/".$data['id']."/".$data['slug']; ?>"> <?php echo  $data['title']; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <a href="<?php echo $this->createUrl('fundraise/index');//Dashboard?>">
                            My Dashboard<?php //echo "(".Yii::app()->frontUser->role.")"; ?>
                        </a>
                        <?php } ?>
                    </span>
                    <span class="mobile-explore">
                        <a style="color:red;" href="<?php echo $this->createUrl('fundraiser/locatefundraiser'); ?>">Explore Fundraisers</a>
                    </span>
                    <?php if(Yii::app()->frontUser->role =='fundraiser'){ ?>
                        <span class="mobile-explore">
                            <a style="color:#098fc6;" href="<?php echo $this->createUrl('fundraise/index'); ?>">Start a Fundraiser</a>
                        </span>
                    <?php } ?>
                    <span>
                        Welcome <a href="<?php echo $this->createUrl('fundraise/index');?>"><?php
                        if(!empty($_SESSION['front_username'])){
                            $myvalue = $_SESSION['front_username'];
                            $arr = explode(' ',trim($myvalue));
                            echo $arr[0];
                          //  echo $_SESSION['front_username'];
                        }else{
                            $myvalue = $_SESSION['front_name'];
                            $arr = explode(' ',trim($myvalue));
                            echo $arr[0];
                        }
                        ?></a>
                    </span>
                </div>

            </div>
        </div>
        <div class="center_head_bottom">

            <nav class="nav-collapse">
                <ul>

                    <li
                        class="home_icon <?php if (Yii::app()->controller->action->id == 'index' && Yii::app()->controller->id == 'site') { ?> active <?php } ?>">
                        <a href="<?php echo $this->createUrl('site/index'); ?>"><img
                                src="<?php echo Yii::app()->request->baseUrl; ?>/images/nav_homeicon.png"></a>
                    </li>
                    <li
                        class="nav1 <?php if (Yii::app()->controller->action->id == 'how_this_work') { ?> active <?php } ?>">
                        <a href="<?php echo $this->createUrl('cms/how_this_work') ?>">How This works</a>
                    </li>
                    <li class="nav2 <?php if (Yii::app()->controller->action->id == 'aboutus') { ?> active <?php } ?>">
                        <a href="<?php echo $this->createUrl('cms/aboutus') ?>">About Giveyourbit</a>
                    </li>
                    <li
                        class="nav3 <?php if (Yii::app()->controller->action->id == 'support_and_contact_centre') { ?> active <?php } ?>">
                        <a href="<?php echo $this->createUrl('cms/support_and_contact_centre') ?>">Support & Contact
                            Centre</a>
                    </li>

                    <?php /* ?>
                    <li class="nav4 <?php if (Yii::app()->controller->action->id == 'careers') { ?> active <?php } ?> ">
                        <a href="<?php echo $this->createUrl('cms/careers') ?>">Careers</a>
                    </li>
                    <?php */ ?>
                    <li
                        class="nav4 <?php if (Yii::app()->controller->action->id == 'media_reviews') { ?> active <?php } ?> ">
                        <a href="<?php echo $this->createUrl('cms/media_reviews') ?>">Media</a>
                    </li>
                    <li class="nav5 <?php if (Yii::app()->controller->action->id == 'fees') { ?> active <?php } ?> ">
                        <a href="<?php echo $this->createUrl('cms/fees') ?>">Fees</a>
                    </li>
                    <li class="nav6 <?php if (Yii::app()->controller->id == 'stories' && Yii::app()->controller->action->id == 'index') { ?> active <?php } ?> ">
                        <a class="has-loader" href="<?php echo $this->createUrl('stories/index') ?>">Success Stories</a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>
<a style="display: none;" id="create-pass" href="<?php echo $this->createUrl('account/password'); ?>"></a>

<!--End Header------------------------------------------------------------->
<script>
$(document).ready(function() {
    $("#dropbtn6").click(function() {
        $(".dropdown-content").slideToggle("500");
    });
});
</script>

<?php if(isset($_SESSION['front_ask_password']) && $_SESSION['front_ask_password']=='Y'){ ?>
<script>
$(document).ready(function () {

        $("#create-pass").fancybox({
            width: '500px',
            height: '450px',
            autoScale: false,
            type: 'iframe',
            scrolling: false,
            autoCenter: true,
            autoSize: false,
            padding:'1px',
            helpers : { overlay : { locked : false,closeClick: false } }				
        });

        const myTimeout = setTimeout(function(){
            $('#create-pass').trigger('click');
        }, 3000);
});
</script>
<?php } ?>