<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'patner-form',
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
            <?php echo $form->labelEx($model, 'patner_title'); ?>
            <?php echo $form->textField($model, 'patner_title', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'patner_title'); ?>
        </div>

        <!--<div class="form-group">
            <?php /*echo $form->labelEx($model, 'patner_image'); */?>
            <?php /*echo $form->textField($model, 'patner_image', array('maxlength' => 255)); */?>
            <?php /*echo $form->error($model, 'patner_image'); */?>
        </div>-->

        <div class="form-group">
            <?php echo $form->labelEx($model, 'patner_image'); ?>
            <?php
            echo $form->fileField($model, 'patner_image', array('maxlength' => 250));

            if (!empty($model->patner_image)) {
                echo '<input type="hidden" id="Patner_patner_image" maxlength="250" name="HomeSlider[patner_image]" value="' . $model->patner_image . '">';
//            echo '<img class="preview_image" src="' . SITE_ABS_PATH_HOME_SLIDER_THUMB . $model->slider_image . '" alt="" />';
            }
            ?>

            <?php echo $form->error($model, 'patner_image', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
        </div>


    </div>
    <div class="box-footer">
        <?php
        echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary'));
        ?>
    </div>
<?php $this->endWidget(); ?>