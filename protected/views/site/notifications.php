<style type="text/css">
.lead_tab ul li{
    flex-grow: 0 !important;
    margin-right: 33px;
}

.lead_tab ul li:last-child{
    margin-right: 0;
}
</style>    

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    <div class="lead_support">
        <h4>Notifications</h4>
        <div class="lead_tab">
            <?php echo $this->renderPartial('/layouts/dashboard_menu'); ?>
        </div>
    </div>
    <div class="inner-left">
        <div class="inner-page">
            <?php echo UtilityHtml::get_flash_message(); ?>
            <div class="notification_row">
                <div class="form">
                <?php
                    if(!empty($notifications_arr)) {
                        foreach($notifications_arr as $key_n => $val_n) {
                ?>
                        <div class="message_box">
                            <a href="<?php echo Yii::app()->createUrl('site/notificationdetail', array('id' => $val_n['data']['id'])); ?>">
                                <?php echo (strlen($val_n['data']['subject'])>250)?substr($val_n['data']['subject'], 0, 250).'...':$val_n['data']['subject']; ?>
                                <?php echo ($val_n['count']>0)?'<span>'.$val_n['count'].' unread comment(s)</span>':''; ?>
                                
                            </a>
                            <br>
                            <span><i>
                                <?php
                                    $by_date = "";
                                   /* if($val_n['data']['from_admin'] == 'Y') {
                                        $by_date .= "By Admin";
                                    } else {
                                        $by_date .= "By ".Users::model()->findByPk($val_n['data']['from_id']);
                                    }

                                    * 
                                    * if($val_n['data']['from_admin'] == 'Y') {
                                            $by_date .= "By Admin";
                                    } else if ($val_n['data']['from_id'] != NULL && $val_n['data']['from_admin']=='N'){
                                        $by_date .= "By Lead Supporter";
                                    }else if ($val_n['data']['to_id'] != NULL  && $val_n['data']['from_admin']=='N'){
                                            $by_date .= "By Supporter";
                                    }else if($val_n['data']['from_admin'] == 'N') {
                                        $by_date .= "By ".Users::model()->findByPk($notification_data->from_id);
                                    }
                                    */
                                    
                                   if($val_n['data']['from_admin'] == 'Y') {
                                            $by_date .= "By Admin";
                                    } else if ($val_n['data']['from_type'] == 'S' && $val_n['data']['to_type'] == 'L'){
                                        $by_date .= "By ".Users::model()->findByPk($val_n['data']['from_id'])." --Supporter--";
                                    }else if ($val_n['data']['from_type'] == 'L' && $val_n['data']['to_type'] == 'S'){
                                            $by_date .= "By  ".Users::model()->findByPk($val_n['data']['from_id'])." --Lead Supporter--";
                                    }else if($val_n['data']['from_admin'] == 'N' && $val_n['data']['from_type'] == 'L' && $val_n['data']['to_type'] == 'A') {
                                        $by_date .= "By ".Users::model()->findByPk($val_n['data']['from_id']);
                                    }
                                    
                                    
                                    //$by_date .= " . ";
                                    //$by_date .= date('M d, Y , H:i:s', strtotime($val_n['data']['created_date']));
                                    //echo $by_date;
                                    echo UtilityHtml::showNigeriaTime($val_n['data']['created_date']);
                                ?>
                                </i>
                    </span>
                        </div>
                <?php
                        }
                    } else {
                ?>
                    <div class="no_message">No message found.</div>
                <?php
                    }
                ?>
                
                </div>
            </div>
        </div>
    </div>
    
    <div class="inner-right">
        <?php /* ?>
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('fundraise/index'); ?>"
               class="btn_question">Start a Fundraiser</a>
        </div>
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('Fundraise/Question'); ?>"
               class="btn_question">Post a Question</a>

        </div>
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('Fundraise/Updateprofile', array('id' => Yii::app()->frontUser->id)); ?>"
               class="btn_question">Update Profile</a>
        </div>
        <?php */ ?>
        <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('site/send_notifications'); ?>"
               class="btn_question">Send Message to Admin</a>
        </div>
    </div>
</div>
