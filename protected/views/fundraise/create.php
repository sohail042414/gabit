<style>
#fundraise_form{
   margin-top:-20px !important;
}
</style>
<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
   <div class="lead_support">
      <h4>Supporter Dashboard</h4>
      <div class="lead_tab">
         <ul>
            <li class="active"><a href="<?php echo $this->createUrl('Fundraise/index'); ?>">Setup Fundraiser</a></li>
            <?php  $user_fundraiser_count = SetupFundraiser::model()->count("user_id = ".Yii::app()->frontUser->id." ");
               if($user_fundraiser_count==0){ 
               ?>
            <li class="txt_blur"><a href="#" style="color:#6bafcb !important">View/Manage My Fundraiser</a></li>
            <li class="txt_blur"><a href="#" style="color:#6bafcb !important">Request Fund Transfer</a></li>
            <?php }else{?>
            <li ><a href="<?php echo $this->createUrl('fundraiser/managefundraiser'); ?>">View/Manage My Fundraiser</a></li>
            <li><a href="<?php echo $this->createUrl('fundraise/fund_transfer'); ?>">Request Fund Transfer</a></li>
            <?php } ?>
            <li><a href="<?php echo $this->createUrl('fundraise/enter_testimonial'); ?>">Enter Testimonial</a></li>
            <li><a href="<?php echo $this->createUrl('Fundraise/invite_friends',array('type'=>'email'));  ?>">Invite Friends</a></li>
            <li><a href="<?php echo $this->createUrl('site/notifications'); ?>">Notifications</a><?php $notification_count = UtilityHtml::get_notification_count_for_user(); if(!empty($notification_count)) { echo '<span>'.$notification_count.'</span>'; } ?></li>
         </ul>
      </div>
   </div>
   <div class="dashboard_content">
      <div class="inner-left">
         <div class="inner-page">
            <div id="fundraise_form">
                <?php 
                echo $this->renderPartial('/fundraise/'.$form_view, array(
                    'model'=>$model,
                    'ftype_list'=> $ftype_list,
                )); 
                ?>
            </div>
         </div>
      </div>
   </div>
</div>