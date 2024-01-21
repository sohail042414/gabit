<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'setup-fundraise-form',
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
            <?php echo $form->labelEx($model, 'ftype_id'); ?>
            <?php echo $form->dropDownList($model, 'ftype_id', GxHtml::listDataEx(FundraiserType::model()->findAllAttributes(null, true)),array("disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'ftype_id'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_title'); ?>
            <?php echo $form->textField($model, 'fundraiser_title', array('maxlength' => 255,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'fundraiser_title'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'search_status'); ?>
<!--            --><?php //echo $form->textField($model, 'search_status', array('maxlength' => 1)); ?>
            <?php echo $form->dropDownList($model, 'search_status', array('Y' => Yii::t('app', 'Yes'), 'N' => Yii::t('app', 'No'))); ?>
<!--            --><?php //echo $form->textField($model, 'search_status', array('maxlength' => 1,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'search_status'); ?>
        </div>

        <?php /* ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_image'); ?>
            <?php
            echo $form->fileField($model, 'fundraiser_image', array('maxlength' => 250,"disabled"=>"disabled"));

            if (!empty($model->fundraiser_image)) {
                echo '<input type="hidden" id="SetupFundraiser_fundraiser_image" maxlength="250" name="SetupFundraiser[fundraiser_image]" value="' . $model->fundraiser_image . '">';
                //echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->fundraiser_image . '" alt="" />';
                echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $model->fundraiser_image . '" alt="" />';
            }
            ?>

            <?php echo $form->error($model, 'fundraiser_image', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
        </div>
        <?php */ ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'uplod_fun_img'); ?>
            <?php
            echo $form->fileField($model, 'uplod_fun_img', array('maxlength' => 250,"disabled"=>"disabled"));

            if (!empty($model->uplod_fun_img)) {
                echo '<input type="hidden" id="SetupFundraiser_uplod_fun_img" maxlength="250" name="SetupFundraiser[uplod_fun_img]" value="' . $model->uplod_fun_img . '">';
                //echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->fundraiser_image . '" alt="" />';
                echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $model->uplod_fun_img . '" alt="" />';
            }
            ?>

            <?php echo $form->error($model, 'fundraiser_image', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
        </div>



        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_description'); ?>
            <?php echo $form->textField($model, 'fundraiser_description', array('maxlength' => 255,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'fundraiser_description'); ?>
        </div>
        <?php /* ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_name'); ?>
            <?php echo $form->textField($model, 'recipient_name', array('maxlength' => 255,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'recipient_name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_age'); ?>
            <?php echo $form->textField($model, 'recipient_age',array("disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'recipient_age'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_sex'); ?>
            <?php echo $form->textField($model, 'recipient_sex', array('maxlength' => 1,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'recipient_sex'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_email'); ?>
            <?php echo $form->textField($model, 'recipient_email', array('maxlength' => 255,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'recipient_email'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_relationship'); ?>
            <?php echo $form->textField($model, 'recipient_relationship', array('maxlength' => 255,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'recipient_relationship'); ?>
        </div>
        <?php */?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_goal'); ?>
            <?php echo $form->textField($model, 'fundraiser_goal', array('maxlength' => 255,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'fundraiser_goal'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_amount_need'); ?>
            <?php echo $form->textField($model, 'fundraiser_amount_need', array('maxlength' => 45,"disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'fundraiser_amount_need'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_timeline'); ?>
            <?php echo $form->textField($model, 'fundraiser_timeline',array("disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'fundraiser_timeline'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'use_of_funds'); ?>
            <?php echo $form->textArea($model, 'use_of_funds',array("disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'use_of_funds'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'funds_achieve'); ?>
            <?php echo $form->textArea($model, 'funds_achieve',array("disabled"=>"disabled")); ?>
            <?php echo $form->error($model, 'funds_achieve'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'feature_flag'); ?>
            <?php echo $form->dropDownList($model, 'feature_flag', array('Y' => Yii::t('app', 'Yes'), 'N' => Yii::t('app', 'No'))); ?>
            <!--            --><?php //echo $form->textField($model, 'Feature_flag', array('maxlength' => 1)); ?>
            <?php echo $form->error($model, 'feature_flag'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'comments_count'); ?>
            <?php echo $form->textField($model, 'comments_count'); ?>
            <?php echo $form->error($model, 'comments_count'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'social_shares_count'); ?>
            <?php echo $form->textField($model, 'social_shares_count'); ?>
            <?php echo $form->error($model, 'social_shares_count'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', array('Y' => Yii::t('app', 'Active'), 'N' => Yii::t('app', 'Inactive'))); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'corporateSupporters'); ?>
            <?php echo $form->dropDownList($model, 'corporateSupporters', $corporate_list,array('multiple' => 'true','class' => 'form-control','empty' => ' -- Select coporate Supporters-- ')); ?> 
            <?php echo $form->error($model, 'corporateSupporters'); ?>                               
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
<?php $select2_data = json_encode($fundraiser_corporate_list); ?>
<script>
    //let select2_data = '<?php echo $select2_data; ?>';
    //$($('#<?php echo Chtml::activeId($model,'corporateSupporters') ?>')).select2('data',select2_data);
    $($('#<?php echo Chtml::activeId($model,'corporateSupporters') ?>')).select2();
</script>