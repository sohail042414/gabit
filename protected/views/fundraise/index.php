<style>
.box-body{
    margin-top: 20px !important;
}
.empty{
   float: none !important;
}
</style>
<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
   <div class="lead_support">
      <h4>Dashboard</h4>
      <div class="lead_tab">
         <?php echo $this->renderPartial('/layouts/dashboard_menu'); ?>
      </div>
   </div>
   <div class="dashboard_content">
   <?php if(Yii::app()->frontUser->role == 'fundraiser') { ?>
      <div class="inner-left">
         <div class="inner-page">
            <div id="fundraise_form">
               <?php echo UtilityHtml::get_flash_message(); ?>

               <?php
                  $form = $this->beginWidget('CoreGxActiveForm', array(
                      'id' => 'setup-fundraise-form',
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
               <div class="kousr">
                  <b style='font-weight: normal;'>Visit <a style="color: #098fc6;" href="http://giveyourbit.com/index.php/cms/how_this_work?bck=1">How This Works</a> page to guide you in completing this form.</b>
                  <h4 style='font-weight: normal;'>What kind of fundraiser are you?</h4>
                  <div class="ttt">
                     <div>                    
                        <?php
                           echo $form->radioButtonList($model, 'fundraiser_kind',
                               $model->getKindsList(),
                               array(
                                   'id' => 'fundraiser_kind',
                                   'class' => 'radio-button-list',
                                   'template' => '{label}{input}<br>'
                               )
                                   );
                           ?>                    
                     </div>
                  </div>
               </div>
               <?php $this->endWidget(); ?>
            </div>
         </div>
      </div>
      <div class="inner-right">
         <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('account/update_profile'); ?>" class="btn_question">Update Profile</a>
            <a href="<?php echo $this->createUrl('Fundraiser/reward_program'); ?>" class="btn_question">Reward Program</a>
         </div>
      </div>
      <?php }else if(Yii::app()->frontUser->role == 'donor' || Yii::app()->frontUser->role== 'supporter') { ?>
         <div class="inner-left" id="report_manage_fundraiser" style="width:100%;">
            <div class="inner-page">
               <div class="box-body">

                  <table class="demo">
                     <thead>
                        <tr>
                           <th>Total no. of Actions</th>
                           <th>No. of Donations</th>
                           <th>Total Donation</th>
                           <th>No. of Fundraisers Supported</th>
                           <th>No. of comments</th>
                           <th>Cumulative Points</th>
                        </tr>
                     </thead>
                     <tbody>
                     <tr>
                        <td><?php echo $rewardModel->getMonthlyActionsCount($rewardModel->user_id,$rewardModel->month,$rewardModel->year); ?></td>
                        <td>
                           <?php echo Donations::model()->getUserCurrentMonthDonationsCount($rewardModel->user_id); ?>
                        </td>
                        <td><?php echo Donations::model()->getUserCurrentMonthTotalDonation($rewardModel->user_id); ?></td>
                        <td>
                           <?php echo Supporter::model()->getCurrentMonthSupporterCount(); ?>
                        </td>
                        <td><?php echo  ($user->comment_count+$user->comment_count_other); ?></td>
                        <td>Hidden</td>
                     </tr>
                     </tbody>
                  </table>  

                  <table class="demo" style="margin-top:20px;">
                     <thead>
                        <tr>
                           <th>Donor Referral Code</th>
                           <th>No. of Code Entries</th>
                           <th>Referral Cumulative Points</th>
                        </tr>
                     </thead>
                     <tbody>
                     <tr>
                        <td><?php echo $user->referral_code; ?></td>
                        <td>
                           <?php //echo $user->getReferralCount(); ?>
                           <?php echo $rewardModel->getMonthlyActivityCount('referral_code_entry',$rewardModel->user_id,$rewardModel->month,$rewardModel->year) ?>
                        </td>
                        <td>Hidden</td>
                     </tr>
                     </tbody>
                  </table>  

                  <div style="width:100%;margin-top:20px;">
                     <div style="width:59%;float:left;">
                        <h3>Activity Chart</h3>
                        <?php 
                        $this->widget('CoreCGridView', array(
                              'id'=>'reward-points-grid',
                              'dataProvider'=>$dataProvider,
                              'columns'=>array(
                                 array(
                                    'value' => '$data["title"]',
                                    'header' =>'Activity',
                                 ),
                                 /*
                                 array(
                                    'value' => '$data["points"]',
                                    'header' =>'Points',
                                 ),
                                 */
                                 array(
                                    'value' => '$data["count"]',
                                    'header' =>'Total Number of actions',
                                 ),
                              ),
                        )); 
                        ?>
                     </div>
                     <div style="width:40%;float:right;">
                        <h3>Action History</h3>
                        <?php                 
                            $this->widget('CoreCGridView', array(
                                'id'=>'reward-points-grid',
                                'dataProvider'=>$actionDataProvider,
                                'columns'=>array(
                                    array(
                                        'value' => '$data->activity_title',
                                        'header' =>'Action',
                                    ),
                                    //'points',
                                    array(
                                        'value' => '$data->created_at',
                                        'header' =>'Date/Time',
                                    ),
                                ),
                            ));                 
                        ?>
                     </div>
                  </div> 
               </div>
            </div>
         </div>                
         <?php } ?>
   </div>
</div>
<script>
   var fundraiser_kind = '<?php echo $model->fundraiser_kind; ?>';
   $(document).ready(function () {
       fundraiser_kind = $('input[name="SetupFundraiser[fundraiser_kind]"]:checked').val();

        $('input[name="SetupFundraiser[fundraiser_kind]"]').change(function(){                        
            fundraiser_kind = $('input[name="SetupFundraiser[fundraiser_kind]"]:checked').val();
            //var from_url = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/form'); ?>?fundraiser_kind='+fundraiser_kind;
            if(fundraiser_kind != '' && fundraiser_kind != undefined){
                var from_url = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise'); ?>/'+fundraiser_kind;
                location.href = from_url;
            }
            /*
            if(fundraiser_kind == '' || fundraiser_kind == undefined){
                
            }else{
                $.ajax({
                    type: 'GET',//You can set GET or POST
                    dataType:'html',
                    url: '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/form'); ?>?fundraiser_kind='+fundraiser_kind,
                    //data:{fundraiser_kind:fundraiser_kind},
                    success:function(data){
                        $('#form-wrapper').html(data);
                    },
                });

                // $('.bbbb').show();
                $('.kousr').hide();
            }
            */
        });
   });
</script>