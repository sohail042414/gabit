<style type="text/css">
    .box-body {
        margin-top: 10px !important;
    }
    #ans_response1 {
        color: green;
        float: left;
        font-size: 15px;
        font-weight: 600;
        margin: 0 0 20px;
    }
    #fundraise_form input.upload_file{border:none !important;}
    @media only screen and (max-width: 480px){
        #fundraise_form input.upload_file{ margin-top:10px !important;}
    }
    .lead_tab {
    margin: 15px 0 0;
}
#fundraise_form .box-body {
    margin-top: 9px;
}
.lead_tab ul li{
    flex-grow: 0 !important;
    margin-right: 33px;
}

.lead_tab ul li:last-child{
    margin-right: 0;
}
#dvChecked{
    margin-top: 20px;
}
#fundraise_form input[type=text] {
    height:35px !important;
}
</style>

<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    
    <div class="lead_support">
        <h4>Request Fund Transfer</h4>
        <div class="lead_tab">
            <?php echo $this->renderPartial('/layouts/dashboard_menu'); ?>
        </div>
    </div>
    
    <div class="dashboard_content">
        <?php if(isset($transfer_requests) && count($transfer_requests)){ ?>
        <div class="inner-left" style="width:100%; float:left; margin-bottom:0px;" id="report_manage_fundraiser">
            <div class="inner-page">
                <h4>Request History</h4>
                <table class="demo">
                     <thead>
                        <tr>
                           <th>Fundraiser</th>
                           <th>Bank Name</th>
                           <th>Account Number</th>
                           <th>Account Title/Name</th>
                           <th>Created Date</th>
                           <th>Amount Received</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($transfer_requests as $transfer){ ?>
                     <tr>
                        <td><?php echo $transfer->fundraiser->fundraiser_title; ?></td>
                        <td><?php echo $transfer->bank_name; ?> </td>
                        <td><?php echo $transfer->account_number; ?></td>
                        <td><?php echo $transfer->account_name; ?></td>
                        <td><?php echo date('F d,Y',strtotime($transfer->created_date)); ?></td>
                        <td><?php echo $transfer->amount_transferred; ?></td>
                        <td>
                            <?php if($transfer->status == 'pending'){ ?>
                                <span style="color:#eb6817;">Pending</span>
                            <?php }else if($transfer->status == 'processing'){ ?>
                                <span style="color:#b6c920;">Processing</span>
                            <?php }else if($transfer->status == 'completed'){ ?>
                                <span style="color:green;">Completed</span>
                            <?php }else if($transfer->status == 'rejected'){ ?>
                                <span style="color:red;">Rejected</span>
                            <?php } ?>
                        </td>

                        <td>
                            <?php if($transfer->status == 'pending'){ ?>
                                <a href="<?php echo Yii::app()->createUrl('fundrequest/update',array('id' => $transfer->id)); ?>"><span style="color:green;">Edit</span></a>
                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                <a onclick="return confirm('Are you Sure you want to delete fund request?');" href="<?php echo Yii::app()->createUrl('fundrequest/delete',array('id' => $transfer->id)); ?>"><span style="color:red;">Delete</span></a>
                            <?php } ?>
                        </td>

                     </tr>
                    <?php } ?>
                     </tbody>
                  </table>  
            </div>
        </div>
        <?php } ?>

        <div class="inner-left" style="width:100%; float:left;">
            <div class="inner-page">
                <h4>Create New Request</h4>
                <div id="fundraise_form">
                    <?php echo UtilityHtml::get_flash_message(); ?>
                    <p>You can make fund transfer requests for a total donation of not less than <?php echo $request_min_amount; ?></p>
                    <?php if(empty($fundraisers_list)){ ?>
                        <p style="color:red;">Sorry, your fundraiser does not have up to <?php echo $request_min_amount; ?> in donations.</p>
                    <?php }else{ ?>
                    <?php
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            'id' => 'fund-transfer-form',
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
                        $model = new FundtransferByuser();
                        
                        ?>
                        
                        <div class="box-body">
			                <div class="form-group">
                                <?php echo $form->labelEx($model, 'fundraiser_id'); ?>
                                <?php echo $form->dropDownList($model, 'fundraiser_id', $fundraisers_list,array('prompt' => '--Please Select --')); ?>
                                <?php echo $form->error($model, 'fundraiser_id'); ?>
                            </div>
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'bank_name'); ?>
                                <?php echo $form->textField($model, 'bank_name'); ?>
                                <?php echo $form->error($model, 'bank_name'); ?>
                            </div>
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'account_number'); ?>
                                <?php echo $form->textField($model, 'account_number'); ?>
                                <?php echo $form->error($model, 'account_number'); ?>
                            </div>
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'account_name'); ?>
                                <?php echo $form->textField($model, 'account_name'); ?>
                                <?php echo $form->error($model, 'account_name'); ?>
                            </div>
                            <?php
                            $messg = SupportersDonorsThankuMessage::model()->find(array("select" => "*"));
                            ?>
                             <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'thankyou_message_for_supporters'); ?>
                                <?php echo $form->textArea($model, 'thankyou_message_for_supporters', array('maxlength' => 500, 'value'=>$messg->default_message)); ?>
                                <?php echo $form->error($model, 'thankyou_message_for_supporters'); ?>
                            </div>


                        
                        <div class="box-footer">
                            <?php
                            echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans'));
                            ?>
                        </div>
                        </div>    
                        <?php $this->endWidget(); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
