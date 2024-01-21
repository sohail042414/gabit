<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'comment-form',
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
            <?php echo $form->labelEx($model, 'post_id'); ?>
            <?php echo $form->dropDownList($model, 'post_id', GxHtml::listDataEx(Post::model()->findAllAttributes(null, true))); ?>
            <?php echo $form->error($model, 'post_id'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'author'); ?>
            <?php echo $form->textField($model, 'author', array('maxlength' => 128)); ?>
            <?php echo $form->error($model, 'author'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('maxlength' => 128)); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'content'); ?>
            <?php echo $form->textArea($model, 'content'); ?>
            <?php echo $form->error($model, 'content'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'url'); ?>
            <?php echo $form->textField($model, 'url', array('maxlength' => 128)); ?>
            <?php echo $form->error($model, 'url'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', array('2' => Yii::t('app', 'Active'), '1' => Yii::t('app', 'Inactive'))); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div>

    <div class="box-footer">
        <?php echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>