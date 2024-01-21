<style>
    @media (min-width:801px) {
        .mobile-explore {
            display: none !important;
        }

        .mobile-explore-wrap {
            display: none;
        }
    }

    @media (max-width:767px) {
        .mobile-explore-wrap {
            margin: 1px auto;
        }
    }

    .logo {
        position: relative;
    }

    .crismas {
        position: absolute;
        left: -22px;
        top: -26px;
    }

    .crismas-hat {
        width: 60px;
        height: 60px;
    }
</style>
<div class="main_head">
    <div class="center_head">
        <div class="center_head_top">
            <div class="center_head_top_left">
                <div class="logo">
                    <?php /* ?>
                    <div class="crismas">
                        <img class="crismas-hat" src="<?php echo Yii::app()->request->baseUrl; ?>/images/crismas-hat.png" />
                    </div>
                    <?php */ ?>
                    <a class="has-loader" href="<?php echo $this->createUrl('site/index'); ?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" />
                    </a>
                </div>
            </div>
            <div class="center_head_top_right">
                <div class="center_head_top_right_search_box">

                    <?php
                    $model = new SetupFundraiser();
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'locate_fundraiser',
                        'enableAjaxValidation' => false,
                        'action' => array('site/locate_fundraiser')
                    ));
                    echo CHtml::submitButton('', array("class" => "icon"));
                    // echo $form->textField($model, 'search_field', array('id' => 'search', 'placeholder' => 'Find a fundraiser'));

                    echo CHtml::hiddenField('selectedvalue', 'id');

                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'name' => 'search',
                        'value' => $model->search_field,
                        'source' => CController::createUrl('site/autocomplete'),
                        'options' => array(
                            //                                'showAnim'=>'fold',         
                            //                                'minLength'=>'2',
                            'select' => 'js:function( event, ui ) {
                                            $("#search").val( ui.item.label );
                                            $("#selectedvalue").val( ui.item.value );
                                            return false;
                                      }',
                        ),
                        'htmlOptions' => array(
                            'onfocus' => 'js: this.value = null; $("#search").val(null); $("#selectedvalue").val(null);',
                            'class' => '#search',
                            'placeholder' => "Search Fundraiser...",
                        ),
                    ));

                    $this->endWidget();
                    ?>
                </div>
                <div class="center_head_top_right_login_link">
                    <ul>
                        <li><a id="link_signup" href="<?php echo $this->createUrl('site/signup'); ?>">Sign up</a></li>
                        |
                        <li><a href="<?php echo $this->createUrl('site/login'); ?>">Log in</a></li>
                        <li style="display:none;"><a id="site-notes" href="<?php echo $this->createUrl('banners/desktop'); ?>"></a></li>
                        <li style="display:none;"><a id="mobile-notes" href="<?php echo $this->createUrl('banners/mobile'); ?>"></a></li>
                    </ul>

                </div>
                <div class="center_head_top_right_social_link1 mobile-explore-wrap">
                    <span class="mobile-explore">
                        <a style="color:red;" href="<?php echo $this->createUrl('fundraiser/locatefundraiser'); ?>">Explore Fundraisers</a>
                    </span>
                    <span class="mobile-explore">
                        <a style="color:#098fc6;" href="<?php echo $this->createUrl('fundraise/index'); ?>">Start a Fundraiser</a>
                    </span>
                </div>
                <div class="center_head_top_right_social_link1">
                    <!-- <a href="https://www.facebook.com/Giveyourbit-476073536087038/" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fb_icon.png"/></a> -->
                    <a href="https://www.facebook.com/Giveyourbit?mibextid=ZbWKwL" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fb_icon.png" /></a>
                    <a href="https://twitter.com/giveyourbit" target="_blank"><img style="width:28px;height:28px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/twter_icon.png" /></a>
                    <a href="https://www.linkedin.com/company/Giveyourbit" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/in_icon.png" /></a>
                    <a href="https://www.youtube.com/channel/UCa23bsMB9vTtJCFdlJGNsEA" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/yt.png" /></a>
                    <a href="https://www.instagram.com/giveyourbit/" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/insta-icon.png" /></a>
                </div>
            </div>
        </div>
        <div class="center_head_bottom">

            <nav class="nav-collapse">
                <ul>
                    <li class="home_icon <?php if (Yii::app()->controller->action->id == 'index' && Yii::app()->controller->id == 'site') { ?> active <?php } ?>">
                        <a class="has-loader" href="<?php echo $this->createUrl('site/index'); ?>"><img src="/images/nav_homeicon.png"></a>
                    </li>
                    <li class="nav1 <?php if (Yii::app()->controller->action->id == 'how_this_work') { ?> active <?php } ?>">
                        <a class="has-loader" href="<?php echo $this->createUrl('cms/how_this_work') ?>">How This works</a>
                    </li>
                    <li class="nav2 <?php if (Yii::app()->controller->action->id == 'aboutus') { ?> active <?php } ?>">
                        <a class="has-loader" href="<?php echo $this->createUrl('cms/aboutus') ?>">About Giveyourbit</a>
                    </li>
                    <li class="nav3 <?php if (Yii::app()->controller->action->id == 'support_and_contact_centre') { ?> active <?php } ?>">
                        <a class="has-loader" href="<?php echo $this->createUrl('cms/support_and_contact_centre') ?>">Support & Contact
                            Centre</a>
                    </li>
                    <li class="nav4 <?php if (Yii::app()->controller->action->id == 'media_reviews') { ?> active <?php } ?> ">
                        <a class="has-loader" href="<?php echo $this->createUrl('cms/media_reviews') ?>">Media</a>
                    </li>
                    <?php /* ?>
                    <li class="nav4 <?php if (Yii::app()->controller->action->id == 'careers') { ?> active <?php } ?> ">
                        <a class="has-loader" href="<?php echo $this->createUrl('cms/careers') ?>">Careers</a>
                    </li>
                    <?php */ ?>
                    <li class="nav5 <?php if (Yii::app()->controller->action->id == 'fees') { ?> active <?php } ?> ">
                        <a class="has-loader" href="<?php echo $this->createUrl('cms/fees') ?>">Fees</a>
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