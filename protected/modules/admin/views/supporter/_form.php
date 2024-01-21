<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'supporter-form',
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
            <?php echo $form->labelEx($model, 'user_id'); ?>
            <?php echo $form->dropDownList($model, 'user_id', GxHtml::listDataEx(Users::model()->findAllAttributes(null, true)),array("disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'user_id'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_id'); ?>
            <?php echo $form->dropDownList($model, 'fundraiser_id', GxHtml::listDataEx(SetupFundraiser::model()->findAllAttributes(null, true)),array("disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'fundraiser_id'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'supporter_message'); ?>
            <?php echo $form->textArea($model, 'supporter_message',array("disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'supporter_message'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', array('Y' => Yii::t('app', 'Active'), 'N' => Yii::t('app', 'Inactive'))); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

    </div>
    <div class="box-footer">
        <?php
        echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary'));
        ?>
    </div>

<?php $this->endWidget(); ?>