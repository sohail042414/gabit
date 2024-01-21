<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'fundraiser-questions-form',
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
        <?php echo $form->labelEx($model, 'bank_name'); ?>
        <?php echo $form->textArea($model, 'bank_name'); ?>
        <?php echo $form->error($model, 'bank_name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'account_number'); ?>
        <?php echo $form->textArea($model, 'account_number'); ?>
        <?php echo $form->error($model, 'account_number'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'account_name'); ?>
        <?php echo $form->textField($model, 'account_name'); ?>
        <?php echo $form->error($model, 'account_name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'account_name'); ?>
        <?php echo $form->textField($model, 'account_name'); ?>
        <?php echo $form->error($model, 'account_name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'amount_transferred'); ?>
        <?php echo $form->textField($model, 'amount_transferred'); ?>
        <?php echo $form->error($model, 'amount_transferred'); ?>
    </div>

    <div class="form-group"  >
        <?php echo $form->labelEx($model, 'admin_message'); ?>
        <?php echo $form->textArea($model, 'admin_message', array('maxlength' => 300)); ?>
        <?php echo $form->error($model, 'admin_message'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(
            'pending' => 'Pending',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'rejected' => 'Rejected',
        )); ?>
        <?php echo $form->error($model, 'status'); ?>
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