<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'newsletter-form',
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
            <?php echo $form->labelEx($model, 'newsletter_name'); ?>
            <?php echo $form->textField($model, 'newsletter_name', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'newsletter_name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'Newsletter_email'); ?>
            <?php echo $form->textField($model, 'Newsletter_email', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'Newsletter_email'); ?>
        </div>

<!--        <div class="form-group">-->
<!--            --><?php //echo $form->labelEx($model, 'created_date'); ?>
<!--            --><?php //echo $form->textField($model, 'created_date'); ?>
<!--            --><?php //echo $form->error($model, 'created_date'); ?>
<!--        </div>-->
<!---->
<!--        <div class="form-group">-->
<!--            --><?php //echo $form->labelEx($model, 'updated_date'); ?>
<!--            --><?php //echo $form->textField($model, 'updated_date'); ?>
<!--            --><?php //echo $form->error($model, 'updated_date'); ?>
<!--        </div>-->

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

<?php
$this->endWidget();
?>