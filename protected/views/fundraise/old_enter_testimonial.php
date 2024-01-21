<style type="text/css">
.lead_tab ul li {
    flex-grow: 0 !important;
    margin-right: 33px;
}

.lead_tab ul li:last-child {
    margin-right: 0;
}

.dashboard_content .alert.alert-success,
.dashboard_content .alert-dismissable {
    margin: 10px 0 0;
    margin-bottom: 20px;
    margin-top: -6px;
}

#fundraise_form {
    margin-top: 20px;
}
</style>
<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    <div class="lead_support">
        <h4>Enter Testimonial</h4>
        <div class="lead_tab">
            <ul>
                <li><a href="<?php echo $this->createUrl('Fundraise/index'); ?>">Setup Fundraiser</a></li>
                <?php  $user_fundraiser_count = SetupFundraiser::model()->count("user_id = ".Yii::app()->frontUser->id."");                 
                if($user_fundraiser_count==0){          
                    ?>
                <li class="txt_blur"><a href="#" style="color:#6bafcb !important">View/Manage My Fundraiser</a></li>
                <li class="txt_blur"><a href="#" style="color:#6bafcb !important">Request Fund Transfer</a></li>
                <?php }else{?>
                <li><a href="<?php echo $this->createUrl('fundraiser/managefundraiser'); ?>">View/Manage My
                        Fundraiser</a></li>
                <li><a href="<?php echo $this->createUrl('fundraise/fund_transfer'); ?>">Request Fund Transfer</a></li>
                <?php } ?>
                <li class="active"><a href="<?php echo $this->createUrl('fundraise/enter_testimonial');  ?>">Enter
                        Testimonial</a></li>
                <li><a href="<?php echo $this->createUrl('Fundraise/invite',array('type'=>'email'));  ?>">Invite
                        Friends</a></li>
                <li><a
                        href="<?php echo $this->createUrl('site/notifications'); ?>">Notifications</a><?php $notification_count = UtilityHtml::get_notification_count_for_user(); if(!empty($notification_count)) { echo '<span>'.$notification_count.'</span>'; } ?>
                </li>
            </ul>
        </div>
        <div class="dashboard_content">
            <div class="inner-left">
                <div class="inner-page">
                    <div id="fundraise_form">
                        <?php echo UtilityHtml::get_flash_message(); ?>
                            <?php
                            if (empty($_REQUEST['fundraiser_id'])) {
                            ?>
                            
                            <?php                       
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            'id' => 'enter-testimonial-form',
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => true,
                            'htmlOptions' => array(
                            'enctype' => 'multipart/form-data'
                            ),
                            'clientOptions' => array(
                            'validateOnSubmit' => true,
                            'validateOnChange' => true,
                            ),
                            ));
                        $model = new TestimonialMessage();
                            ?>
                                <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'message'); ?>
                                <?php echo $form->textArea($model, 'message', array('maxlength' => 500)); ?>
                                <?php echo $form->error($model, 'message'); ?>
                            </div>
                            <div class="box-footer">
                                <?php echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans')); ?>
                            </div>
                    </div>
                    <?php
                    $this->endWidget();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>    -->