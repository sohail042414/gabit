<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'update-fundraise_image-form',
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
    <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>
    <div class="form-group sort_dropdown">
        <?php echo $form->labelEx($model, 'Select Fundraiser'); ?>
        <?php echo $form->dropDownList($model, 'fundraiser_id', GxHtml::listDataEx(SetupFundraiser::model()->findAllByAttributes(array('user_id' =>Yii::app()->frontUser->id ))),array('prompt' => '--Please Select --')); ?>
        <?php echo $form->error($model, 'fundraiser_id'); ?>
    </div>  
    <div class="form-group">
        <?php echo $form->labelEx($model, 'fundraiser_image'); ?>
        <?php echo $form->fileField($model, 'uplod_fun_img', array('maxlength' => 250, 'class' => 'upload_file'));

        if (!empty($model->uplod_fun_img)) {
            echo '<input type="hidden" id="HomeSlider_slider_image" maxlength="250" name="SetupFundraiser[uplod_fun_img]" value="' . $model->uplod_fun_img . '">';
            echo '<img class="preview_image" src="' . SITE_ABS_PATH_UPLOD_FUN_IMG_THUMB . $model->uplod_fun_img . '" alt="" />';
        }
        ?>
        <?php echo $form->error($model, 'uplod_fun_img'); ?>        
    </div>
</div>

<div class="box-footer">
    <?php echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans')); ?>
</div>
<?php $this->endWidget(); ?>