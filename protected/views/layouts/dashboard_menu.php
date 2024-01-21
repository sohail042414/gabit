<style>
   ul.dashboard-menu li { 
        margin: 0px auto; 
   }
   ul.dashboard-menu li:first-child { 
        margin-left: 0px; 
   }
</style>

<?php 

$controller_id = Yii::app()->controller->id;
$action_id = Yii::app()->controller->action->id;
?>

<ul class="dashboard-menu">
    <?php if(Yii::app()->frontUser->role == 'fundraiser') { ?>
        <?php $user_fundraiser_count = SetupFundraiser::model()->count("user_id = ".Yii::app()->frontUser->id." "); ?>
        <li class="<?php echo ($controller_id=='fundraise' && $action_id=='index') ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('Fundraise/index'); ?>">Setup Fundraiser</a></li>
        <?php if($user_fundraiser_count==0){ ?>
                <li class="txt_blur"><a href="#" style="color:#6bafcb !important">View/Manage My Fundraiser</a></li>
                <li class="txt_blur"><a href="#" style="color:#6bafcb !important">Request Fund Transfer</a></li>
        <?php }else{ ?>
            <li class="<?php echo ($controller_id=='fundraiser' && $action_id=='managefundraiser') ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('fundraiser/managefundraiser'); ?>">View/Manage My Fundraiser</a></li>
            <li class="<?php echo ($controller_id=='fundrequest') ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('fundrequest/index'); ?>">Request Fund Transfer</a></li>
        <?php } ?>
    <?php }else if(Yii::app()->frontUser->role == 'supporter' || Yii::app()->frontUser->role == 'donor'){ ?>
        <li class="<?php echo ($controller_id=='fundraise' && $action_id=='index') ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('fundraise/index'); ?>">Reward</a></li>
        <li class="<?php echo ($controller_id=='account' && $action_id=='profile') ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('account/profile'); ?>">Profile</a></li>
    <?php } ?>    
    <li class="<?php echo ($controller_id=='testimonials' && $action_id=='create') ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('testimonials/create'); ?>">Enter Testimonial</a></li>
    <li class="<?php echo ($controller_id=='fundraise' && $action_id=='invite_friends') ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('Fundraise/invite_friends',array('type'=>'email'));  ?>">Invite Friends</a></li>
    <li class="<?php echo ($controller_id=='site' && $action_id=='notifications') ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('site/notifications'); ?>">Notifications</a><?php $notification_count = UtilityHtml::get_notification_count_for_user(); if(!empty($notification_count)) { echo '<span>'.$notification_count.'</span>'; } ?></li>
</ul>