<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'post-form',
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
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('maxlength' => 128)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'content'); ?>
            <?php echo $form->textArea($model, 'content',array('class' => 'apply-ckeditor')); ?>
            <?php echo $form->error($model, 'content'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'tags'); ?>
            <?php echo $form->textArea($model, 'tags'); ?>
            <?php echo $form->error($model, 'tags'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', array('2' => Yii::t('app', 'Active'), '1' => Yii::t('app', 'Inactive'))); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

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

<!--script for advance taxt editor-->
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script type="text/javascript">
//CKEDITOR.replace( 'editor1' );
</script>