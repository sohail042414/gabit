<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'testimonial-form',
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
            <?php echo $form->labelEx($model, 'testimonial_text'); ?>
            <?php echo $form->textField($model, 'testimonial_text', array('maxlength' => 455)); ?>
            <?php echo $form->error($model, 'testimonial_text'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'testimonial_by'); ?>
            <?php echo $form->textField($model, 'testimonial_by', array('maxlength' => 45)); ?>
            <?php echo $form->error($model, 'testimonial_by'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'testimonial_company'); ?>
            <?php echo $form->textField($model, 'testimonial_company', array('maxlength' => 45)); ?>
            <?php echo $form->error($model,'testimonial_company'); ?>
        </div>

<!--        <div class="form-group">-->
<!--            --><?php //echo $form->labelEx($model, 'testimonial_picture'); ?>
<!--            --><?php //echo $form->textField($model, 'testimonial_picture', array('maxlength' => 45)); ?>
<!--            --><?php //echo $form->error($model, 'testimonial_picture'); ?>
<!--        </div>-->

        <div class="form-group">
            <?php echo $form->labelEx($model, 'testimonial_picture'); ?>
            <?php
            echo $form->fileField($model, 'testimonial_picture', array('maxlength' => 250));

            if (!empty($model->testimonial_picture)) {
                echo '<input type="hidden" id= "Testimonial_testimonial_picture" maxlength="250" name="Testimonial[testimonial_picture]" value="' . $model->testimonial_picture . '">';
                echo '<img class="preview_image" src="' . SITE_ABS_PATH_TESTIMONIAL_THUMB . $model->testimonial_picture . '" alt="" />';
            }
            ?>
            <?php echo $form->error($model, 'testimonial_picture', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
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