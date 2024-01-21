<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'home-slider-form',
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
    <!--                                        <div class="form-group">
    <?php //echo $form->labelEx($model,'id'); ?>
    <?php //echo $form->textField($model, 'id'); ?>
    <?php //echo $form->error($model,'id'); ?>
                        </div>-->

    <div class="form-group">
        <?php echo $form->labelEx($model, 'slider_title'); ?>
        <?php echo $form->textField($model, 'slider_title', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'slider_title'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'slider_content'); ?>
        <?php // echo $form->textArea($model, 'page_content'); ?>
        <?php
        $this->widget('ext.jqueryte.Jqueryte', array(
            'model' => $model,
            'attribute' => 'slider_content',
            'value' => $model->slider_content,
        ));
        ?>
        <?php echo $form->error($model, 'slider_content'); ?>
    </div>

    <!--                                                    <div class="form-group">
    <?php //echo $form->labelEx($model,'slider_image'); ?>
    <?php //echo $form->textField($model, 'slider_image', array('maxlength' => 255)); ?>
    <?php //echo $form->error($model,'slider_image'); ?>
                        </div>-->

    <div class="form-group">
        <?php echo $form->labelEx($model, 'slider_image'); ?>
        <?php
        echo $form->fileField($model, 'slider_image', array('maxlength' => 250));

        if (!empty($model->slider_image)) {
            echo '<input type="hidden" id="HomeSlider_slider_image" maxlength="250" name="HomeSlider[slider_image]" value="' . $model->slider_image . '">';
//            echo '<img class="preview_image" src="' . SITE_ABS_PATH_HOME_SLIDER_THUMB . $model->slider_image . '" alt="" />';
        }
        ?>

        <?php echo $form->error($model, 'slider_image', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
    </div>

    <!--                                                    <div class="form-group">
    <?php //echo $form->labelEx($model,'created_date'); ?>
    <?php //echo $form->textField($model, 'created_date'); ?>
    <?php //echo $form->error($model,'created_date'); ?>
                        </div>
                    
                                                        <div class="form-group">
    <?php //echo $form->labelEx($model,'updated_date'); ?>
    <?php //echo $form->textField($model, 'updated_date'); ?>
    <?php //echo $form->error($model,'updated_date'); ?>
                        </div>-->

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