<?php 
    $form = $this->beginWidget('CoreGxActiveForm', array(
        'id' => 'donations-form',
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
    <div class="box-body">
        <div class="form-group">
            <?php echo $form->labelEx($model,'fundraiser_id'); ?>
            <?php echo $form->dropDownList($model, 'fundraiser_id', GxHtml::listDataEx(SetupFundraiser::model()->findAllAttributes(null, true))); ?>
            <?php echo $form->error($model,'fundraiser_id'); ?>
        </div>
                
        <div class="form-group">
            <?php echo $form->labelEx($model,'donation_amount'); ?>
            <?php echo $form->textField($model, 'donation_amount'); ?>
            <?php echo $form->error($model,'donation_amount'); ?>
        </div>
                
        <div class="form-group">
            <?php echo $form->labelEx($model,'donor_name'); ?>
            <?php echo $form->textField($model, 'donor_name', array('maxlength' => 255)); ?>
            <?php echo $form->error($model,'donor_name'); ?>
        </div>
                
        <div class="form-group">
            <?php echo $form->labelEx($model,'donor_email'); ?>
            <?php echo $form->textField($model, 'donor_email', array('maxlength' => 255)); ?>
            <?php echo $form->error($model,'donor_email'); ?>
        </div>
                
        <div class="form-group">
            <?php echo $form->labelEx($model,'donor_phone_no'); ?>
            <?php echo $form->textField($model, 'donor_phone_no', array('maxlength' => 255)); ?>
            <?php echo $form->error($model,'donor_phone_no'); ?>
        </div>
                
        <div class="form-group">
            <?php echo $form->labelEx($model,'donor_message'); ?>
            <?php echo $form->textArea($model, 'donor_message'); ?>
            <?php echo $form->error($model,'donor_message'); ?>
        </div>
        
        <?php /*
        <div class="form-group">
            <?php echo $form->labelEx($model,'user_id'); ?>
            <?php echo $form->textField($model, 'user_id'); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div> 
        
                
        <div class="form-group">
            <?php echo $form->labelEx($model,'created_date'); ?>
            <?php echo $form->textField($model, 'created_date'); ?>
            <?php echo $form->error($model,'created_date'); ?>
        </div>
                
        <div class="form-group">
            <?php echo $form->labelEx($model,'updated_date'); ?>
            <?php echo $form->textField($model, 'updated_date'); ?>
            <?php echo $form->error($model,'updated_date'); ?>
        </div> */ ?>
                
        <div class="form-group">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model, 'status', array('Y' => Yii::t('app', 'Active'), 'N' => Yii::t('app', 'Inactive'))); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
    </div>
    <div class="box-footer">
        <?php
    echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary'));
    ?>
    </div>

<?php
$this->endWidget();
?>