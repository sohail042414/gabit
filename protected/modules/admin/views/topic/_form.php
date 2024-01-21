<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'topic-form',
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
            <?php echo $form->labelEx($model, 'topic_type'); ?>
            <?php echo $form->textField($model, 'topic_type', array('maxlength' => 250)); ?>
            <?php echo $form->error($model, 'topic_type'); ?>
        </div>

        <?php echo $form->hiddenField($model, 'created_by', array('type' => "hidden", 'value' => Yii::app()->User->id)); ?>

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