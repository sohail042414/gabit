<style>
.lead_tab ul li{
        flex-grow: 0 !important;
        margin-right: 33px;
    }
</style>

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    <div class="lead_support">
         <h4>Notification Detail</h4>
        <div class="lead_tab">
            <ul>
                <li ><a href="<?php echo $this->createUrl('Fundraise/Question'); ?>">Setup Fundraiser</a></li>                        
                
                <?php  $user_fundraiser_count = SetupFundraiser::model()->count("user_id = ".Yii::app()->frontUser->id." ");
                       if($user_fundraiser_count==0){ 
                ?>
                <li class="txt_blur"><a href="#">View/Manage My Fundraiser</a></li>                        
                <li class="txt_blur"><a href="#">Request Fund Transfer</a></li>                        
                <?php }else{?>
                <li><a href="<?php echo $this->createUrl('fundraiser/managefundraiser'); ?>">View/Manage My Fundraiser</a></li>                        
                <li><a href="<?php echo $this->createUrl('fundraise/fund_transfer'); ?>">Request Fund Transfer</a></li>
                <?php } ?>       
                <li><a href="<?php echo $this->createUrl('fundraise/enter_testimonial'); ?>">Enter Testimonial</a></li>
                <li ><a href="<?php echo $this->createUrl('Fundraise/Invite_friends',array('type'=>'email')); ?>">Invite Friends</a></li>  
                <li class="active"><a href="<?php echo $this->createUrl('site/notifications'); ?>">Notifications</a><?php $notification_count = UtilityHtml::get_notification_count_for_user(); if(!empty($notification_count)) { echo '<span>'.$notification_count.'</span>'; } ?></li>  
               
            </ul>
        </div>
    </div>
    
    <div class="inner-left">
        <div class="inner-page">
            <?php echo UtilityHtml::get_flash_message(); ?>
           
            
            <p style="font-size: 18px;">Subject: <?php echo $notification_data->subject; ?></p>
          
            <div class="notification_row">
            <div class="notification_message">
                <span class="content_box"><?php echo nl2br($notification_data->message); ?></span>
                <span><i>
                        <?php
                            $by_date = "";
                            $by_date = "";
                            if($notification_data->from_admin == 'Y') {
                                $by_date .= "By Admin";
                            } else if ($notification_data->from_type == 'S' && $notification_data->to_type == 'L'){
                                $by_date .= "By ".Users::model()->findByPk($notification_data->from_id)." --Supporter--";
                            }else if ($notification_data->from_type == 'L' && $notification_data->to_type == 'S'){
                                $by_date .= "By ".Users::model()->findByPk($notification_data->from_id)." --Lead Supporter--";
                            }else if($notification_data->from_admin == 'N') {
                                $by_date .= "By ".Users::model()->findByPk($notification_data->from_id);
                            }
                            
                            /* 1 JULY 2016
                             * if($notification_data->from_admin == 'Y') {
                                $by_date .= "By Admin";
                            } else {
                                $by_date .= "By ".Users::model()->findByPk($notification_data->from_id);
                            }

                             * 
                             * if($notification_data->from_admin == 'Y') {
                                $by_date .= "By Admin";
                            } else if ($notification_data->from_id != NULL && $notification_data->from_admin=='N'){
                                $by_date .= "By Lead Supporter";
                            }else if ($notification_data->from_id == NULL && $notification_data->from_admin=='N'){
                                $by_date .= "By Supporter";
                            }else if($notification_data->from_admin == 'N') {
                                $by_date .= "By ".Users::model()->findByPk($notification_data->from_id);
                            }                             */
                            //$by_date .= " . ";
                            //$by_date .= date('M d, Y , H:i:s', strtotime($notification_data->created_date));
                            //echo $by_date;
                            echo UtilityHtml::showNigeriaTime($notification_data->created_date);
                        ?>    
                    </i>
                </span>
            </div>
            <?php
                foreach($notifications_comments_data as $key_ncd => $val_ncd) {
            ?>
                <div class="notification_comment">
                    <span class="content_box"><?php echo $val_ncd->comment; ?></span>
                    <span><i>
                        <?php
                            $by_date = "";
                            if($val_ncd->from_admin == 'Y') {
                                $by_date .= "By Admin";
                            } else {
                                $by_date .= "By ".Users::model()->findByPk($val_ncd->from_id);
                            }
                            $by_date .= " . ";
                            $by_date .= date('M d, Y , H:i:s', strtotime($val_ncd->created_date));
                            echo $by_date;
                        ?>
                        </i>
                    </span>
                </div>                
            <?php
                }
            ?>
            <div id="login_form" class="form notification_send_comment">
                <?php
                $form = $this->beginWidget('CoreGxActiveForm', array(
                    'id' => 'message-comment-form',
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
                ?>
                <?php
                //if($notification_data->subject == "New Supporter" || ($notification_data->from_id != NULL && $notification_data->from_admin=="N")){?>
                
                <?php// }else{?>
                    <div class="box-footer row buttons">
                        <?php echo $form->textArea($notifications_comment_model, 'comment', array()); ?>
                        <?php echo GxHtml::submitButton(Yii::t('app', 'Send Notification'), array('class' => 'btn_send_ans')); ?>
                    </div>
                <?php //} ?>
                <?php
                    $this->endWidget();
                ?>
            </div>
            </div>
        </div>
    </div>
    
    
    <div class="inner-right">
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('fundraise/index'); ?>"
               class="btn_question">Start a Fundraiser</a>
        </div>
       <!-- <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('Fundraise/Question'); ?>"
               class="btn_question">Post a Question</a>

        </div>-->
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('Fundraise/Updateprofile', array('id' => Yii::app()->frontUser->id)); ?>"
               class="btn_question">Update Profile</a>
        </div>
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('site/notifications'); ?>"
               class="btn_question">Notifications</a>
        </div>
    </div>
</div>
