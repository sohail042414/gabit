<style>
.box-body{
    margin-top: 10px !important;
}

.reward-prog-button {
    width:190px !important;
    line-height: 35px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    padding: 0px 10px;
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)) !important;
    background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%) !important;
    color: #FFF;
    border: none;
    font-family: Arial, Helvetica, sans-serif;
    border-radius: 5px !important;
    cursor: pointer;
}


</style>
<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
   <div class="lead_support">
      <h4>Top Donor Reward Program</h4>
      <div class="lead_tab">
         <?php echo $this->renderPartial('/layouts/dashboard_menu'); ?>
      </div>
   </div>
   <div class="dashboard_content">
      <div class="inner-left" style="width:100%;">
         <div class="inner-page">
            <div id="user_profile">
                <div class="box-body" id="report_manage_fundraiser" style="margin-top:0px;">
                    <table class="demo">
                        <thead>
                            <tr>
                                <th>Fundraiser Title</th>
                                <th>Reward Program Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fundraisers_list as $key => $fundraiser) { ?>
                                <tr>
                                    <td style="width:50%;"><?php echo $fundraiser->fundraiser_title; ?></td>
                                    <td style="text-align: center;"><?php echo ($fundraiser->reward_program) ? "<span style='color:green;'>Yes</span>" : "<span style='color:red;'>No</div>"; ?> </td>
                                    <td style="text-align: center !important;">
                                        <?php
                                        $reload_url = Yii::app()->createUrl('fundraiser/reward_program');
                                        ?>
                                        <?php if ($fundraiser->reward_program == 1) { ?>
                                            <?php
                                            echo CHtml::ajaxSubmitButton(
                                                'Leave Reward Program',
                                                Yii::app()->createUrl('fundraiser/leave_reward_program'),
                                                array(
                                                    'type' => 'POST',
                                                    'data' => 'js:{"fundraiser": ' . $fundraiser->id . '}',
                                                    'beforeSend' => 'js:function() {
                                                        return confirm("Are you sure you wish to remove this fundraiser from the reward program?");
                                                    }',
                                                    'success' => 'js:function(string){ location.href= \'' . $reload_url . '\' }'
                                                ),
                                                array('class' => 'reward-prog-button',)
                                            );
                                            ?>

                                        <?php } else { ?>

                                            <?php
                                            echo CHtml::ajaxSubmitButton(
                                                'Join Reward Program',
                                                Yii::app()->createUrl('fundraiser/join_reward_program'),
                                                array(
                                                    'type' => 'POST',
                                                    'beforeSend' => 'js:function() {
                                                        return confirm("Are you sure you wish to include this fundraiser in the reward program?");
                                                    }',
                                                    'data' => 'js:{"fundraiser": ' . $fundraiser->id . '}',
                                                    'success' => 'js:function(string){ location.href= \'' . $reload_url . '\' }'
                                                ),
                                                array('class' => 'reward-prog-button')
                                            );
                                            ?>


                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>