<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'cms-form',
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
            <?php echo $form->labelEx($model, 'page_name'); ?>
            <?php echo $form->textField($model, 'page_name', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'page_name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'page_title'); ?>
            <?php echo $form->textField($model, 'page_title', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'page_title'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'meta_title'); ?>
            <?php echo $form->textField($model, 'meta_title', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'meta_title'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'meta_desc'); ?>
            <?php echo $form->textField($model, 'meta_desc', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'meta_desc'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'meta_keyword'); ?>
            <?php echo $form->textField($model, 'meta_keyword', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'meta_keyword'); ?>
        </div>


       <!-- <div class="form-group">
            <?php /*echo $form->labelEx($model, 'page_content'); */?>
            <?php /*// echo $form->textArea($model, 'page_content'); */?>
            <?php
/*            $this->widget('ext.jqueryte.Jqueryte', array(
                'model' => $model,
                'attribute' => 'page_content',
                'value' => $model->page_content,
                'htmlOptions' => ''
            ));
            */?>
            <?php /*echo $form->error($model, 'page_content'); */?>
        </div>-->

        <div class="form-group">
            <?php echo $form->labelEx($model,'page_content'); ?>
            <?php echo $form->textArea($model, 'page_content', array('id'=>'editor1', 'class' => 'apply-ckeditor')); ?>
            <?php echo $form->error($model,'page_content'); ?>
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