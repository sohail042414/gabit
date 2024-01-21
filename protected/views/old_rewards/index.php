<?php 
$reward_date = Setting::model()->getBySettingKey('reward_date');
$reward_prize = Setting::model()->getBySettingKey('reward_prize');
?>

<div class="row">
    <div class="col-lg-6 rewards-left-area">
        <div class="reward-img">
            <div class="value">₦<?php echo $reward_prize; ?></div>
                <img src="<?php echo SITE_ABS_PATH; ?>css/rewards/images/reward-card.png" alt="Reward-Card">
            <div class="date"><?php echo $reward_date; ?></div>
        </div>
    </div>
    <div class="col-lg-6 rewards-right-area">
        <h2>Support fundraisers on <span class="fund-logo"><a href="<?php echo SITE_ABS_PATH; ?>"><img src="<?php echo SITE_ABS_PATH; ?>css/rewards/images/Giveyourbit_logo.png"></a></span></h2>
        <h1>The Top Donor Reward<br>Program (TDRP)</h1>
        <p>Get rewarded for your <br/>acts of kindness</p>
        <a href="<?php echo Yii::app()->createUrl('rewards/terms'); ?>"><img style="width:271px;" src="<?php echo SITE_ABS_PATH; ?>images/reward-btn.png"></a>
    </div>
</div>