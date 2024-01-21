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
<div class="kousr">
    <h4 style='font-weight: normal;'>You are setting up a fundraiser to support a loved one or someone in need.</h4>
</div>
<div class="box-body bbbb" >
<?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>
    <?php echo $form->hiddenField($model, 'fundraiser_kind'); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'ftype_id'); ?>
        <?php echo $form->dropDownList($model, 'ftype_id', CHtml::listData(FundraiserType::model()->findAll(),'id','fundraiser_type') ,
            array(
                    'empty' => '– Please Select –',
                    'ajax' => array(
                        'type'=>'POST', //request type
                        'url'=>CController::createUrl('Fundraise/dynamiccities'),
                        'update'=>'#'.Chtml::activeId($model,'ftype_typ'), //selector to update
                        'data' => array('ftype_id' => 'js:this.value'),
                    )
                )
            );
        ?>
        <?php echo $form->error($model, 'ftype_id'); ?>
    </div>
    
    <div class="form-group" >
        <?php echo $form->labelEx($model, 'ftype_typ'); ?>
        <?php echo $form->dropDownList($model,'ftype_typ',$ftype_list, array('empty' => '– Please Select –')); ?>
        <?php echo $form->error($model, 'ftype_typ'); ?>
    </div>

    <?php echo $form->hiddenField($model, 'hidd_fl', array('type' => "hidden", 'value' => "")); ?>
    <div class="form-group" >
        <?php echo $form->labelEx($model, 'ftype_typ'); ?>
        <?php echo $form->textField($model,'ftype_typ', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'ftype_typ'); ?>
    </div>
    <div class="form-group" id="titl12">
        <?php echo $form->labelEx($model, 'fundraiser_title'); ?>
        <?php echo $form->textField($model, 'fundraiser_title', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'fundraiser_title'); ?>
    </div>

    <div class="form-group" id="tel12">
        <?php echo $form->labelEx($model, 'tell_ur_fund_story'); ?>
        <?php echo $form->textArea($model, 'tell_ur_fund_story', array('maxlength' => 4000, 'rows' => 10, 'cols' => 400)); ?>
        <?php echo $form->error($model, 'tell_ur_fund_story'); ?>   
    </div>
    <div class="form-group" >
        <?php echo $form->labelEx($model, 'uplod_fun_img'); ?>
        <?php echo $form->fileField($model, 'uplod_fun_img', array('maxlength' => 250, 'class' => 'upload_file'));
            if (!empty($model->uplod_fun_img)) {
                echo '<input type="hidden" id="HomeSlider_slider_image" maxlength="250" name="SetupFundraiser[uplod_fun_img]" value="' . $model->uplod_fun_img . '">';
                echo '<img class="preview_image" src="' . SITE_ABS_PATH_UPLOD_FUN_IMG_THUMB . $model->uplod_fun_img . '" alt="" />';
            }
            ?>
        <?php echo $form->error($model, 'uplod_fun_img'); ?>
    </div>
    <div class="form-group scrldw" id="ben_nm">
        <?php echo $form->labelEx($model, 'benifiry_name'); ?>
        <?php echo $form->textField($model, 'benifiry_name', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'benifiry_name'); ?>   
    </div>

    <div class="form-group scrldw" >
        <?php echo $form->labelEx($model, 'benifi_email'); ?>
        <?php echo $form->textField($model, 'benifi_email', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'benifi_email'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'uplod_pic_benif'); ?>
        <?php echo $form->fileField($model, 'uplod_pic_benif', array('maxlength' => 250, 'class' => 'upload_file'));
            if (!empty($model->uplod_pic_benif)) {
                echo '<input type="hidden" id="HomeSlider_slider_image" maxlength="250" name="SetupFundraiser[uplod_pic_benif]" value="' . $model->uplod_pic_benif . '">';
                echo '<img class="preview_image" src="' . SITE_ABS_PATH_UPLOD_PIC_BENIF_THUMB . $model->uplod_pic_benif . '" alt="" />';
            }
            ?>
        <?php echo $form->error($model, 'uplod_pic_benif'); ?>
    </div>
        <?php /* ?>
        <h6 style="font-weight: normal;">Who is the Lead Supporter?<span class="required">*</span></h6>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'lead_supporter_not_sure'); ?>
            <?php echo $form->checkBox($model,'lead_supporter_not_sure'); ?>
            <?php echo $form->error($model, 'lead_supporter_not_sure'); ?>   
            </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'lead_supporter_i_am'); ?>
            <?php echo $form->checkBox($model,'lead_supporter_i_am'); ?>
            <?php echo $form->error($model, 'lead_supporter_i_am'); ?>   
            </div>
        <div id="lead_have_idea">
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'lead_supptr_name'); ?>
            <?php echo $form->textField($model, 'lead_supptr_name', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'lead_supptr_name'); ?>   
        </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'lead_supptr_age'); ?>
            <?php echo $form->textField($model, 'lead_supptr_age', array('maxlength' => 3)); ?>
            <?php echo $form->error($model,'lead_supptr_age'); ?>
            <!--                                <span class="shw_msg_ag_b errorMessage">Minimum age must be 18 </span>-->
        </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'lead_supptr_sex'); ?>
            <?php echo $form->dropDownList($model, 'lead_supptr_sex', array('M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female')),array('prompt' => '– Please Select –')); ?>
            <?php //echo $form->textField($model, 'benifi_sex', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'lead_supptr_sex'); ?>   
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'lead_supptr_email'); ?>
            <?php echo $form->textField($model, 'lead_supptr_email', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'lead_supptr_email'); ?>   
        </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'lead_supptr_relationshp'); ?>
            <?php echo $form->dropDownList($model, 'lead_supptr_relationshp',array('prompt' => '– Please Select –') + GxHtml::listDataEx(Relationship::model()->findAllAttributes(null, true))); ?>
            <?php //echo $form->textField($model, 'lead_supptr_relationshp', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'lead_supptr_relationshp'); ?>   
        </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'uplod_pic_lead_supptr'); ?>
            <?php echo $form->fileField($model, 'uplod_pic_lead_supptr', array('maxlength' => 250, 'class' => 'upload_file'));
                if (!empty($model->uplod_pic_lead_supptr)) {
                    echo '<input type="hidden" id="HomeSlider_slider_image" maxlength="250" name="SetupFundraiser[uplod_pic_lead_supptr]" value="' . $model->uplod_pic_lead_supptr . '">';
                    echo '<img class="preview_image" src="' . SITE_ABS_PATH_UPLOD_PIC_LEAD_SUPPTR_THUMB . $model->uplod_pic_lead_supptr . '" alt="" />';
                }
                ?>
            <?php echo $form->error($model, 'uplod_pic_lead_supptr'); ?>
        </div>
        <?php */ ?>
        <h6 style="font-weight: normal;">Who is the Fund Manager?<span class="required">*</span></h6>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'fund_mange_sure'); ?>
            <?php echo $form->checkBox($model,/*'estado',*/'fund_mange_sure'); ?>
            <?php echo $form->error($model, 'fund_mange_sure'); ?>   
        </div>
        <?php /* ?>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'fund_mange_idea'); ?>
            <?php echo $form->checkBox($model,'fund_mange_idea'); ?>
            <?php echo $form->error($model, 'fund_mange_idea'); ?>   
        </div>
        <?php */ ?>
        <div class="form-group" >
            <?php echo $form->labelEx($model,'fund_mange_name'); ?>
            <?php echo $form->textField($model, 'fund_mange_name', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fund_mange_name'); ?>   
        </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'fund_mange_email'); ?>
            <?php echo $form->textField($model, 'fund_mange_email', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fund_mange_email'); ?>   
        </div>
        <?php /* ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'fund_mange_age'); ?>
            <?php echo $form->textField($model, 'fund_mange_age', array('maxlength' => 3)); ?>
            <?php echo $form->error($model, 'fund_mange_age'); ?>
            <!--                                <span class="shw_msg_ag_a">Minimum age must be 18 </span>-->
        </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'fund_mange_sex'); ?>
            <?php echo $form->dropDownList($model, 'fund_mange_sex', array('M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female')),array('prompt' => '– Please Select –')); ?>
            <?php echo $form->error($model, 'fund_mange_sex'); ?>   
        </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'fund_mange_relationshp'); ?>
            <?php echo $form->dropDownList($model, 'fund_mange_relationshp',array('prompt' => '– Please Select –') + GxHtml::listDataEx(Relationship::model()->findAllAttributes(null, true))); ?>
            <?php echo $form->error($model, 'fund_mange_relationshp'); ?>   
        </div>
        <?php */ ?>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'upload_pic_fun_manager' ); ?>
            <?php echo $form->fileField($model, 'upload_pic_fun_manager', array('maxlength' => 250, 'class' => 'upload_file'));
                if (!empty($model->upload_pic_fun_manager)) {
                    echo '<input type="hidden" id="HomeSlider_slider_image" maxlength="250" name="SetupFundraiser[upload_pic_fun_manager]" value="' . $model->upload_pic_fun_manager . '">';
                    echo '<img class="preview_image" src="' . SITE_ABS_PATH_UPLOAD_PIC_FUN_MANAGE_THUMB . $model->upload_pic_fun_manager . '" alt="" />';
                }
                ?>
            <?php echo $form->error($model, 'upload_pic_fun_manager' ); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundriser_goal_amount'); ?>
            <?php echo $form->textField($model, 'fundriser_goal_amount', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fundriser_goal_amount'); ?>   
        </div>
        <h6>Fundraiser Timeline</h6>
        <div class="form-group" >
            <?php echo $form->labelEx($model,  'fundr_timeline_from'); ?>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'fundr_timeline_from', //attribute name
                    'language' => 'en',
                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ) // jquery plugin options
                ));
                ?>
            <?php echo $form->error($model,  'fundr_timeline_from'); ?> 
        </div>  
        <div class="form-group" >
            <?php echo $form->labelEx($model,  'fundr_timeline_to'); ?>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'fundr_timeline_to', //attribute name
                    'language' => 'en',
                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ) // jquery plugin options
                ));
                ?>
            <?php echo $form->error($model,  'fundr_timeline_to'); ?>   
        </div>
        <div class="form-group scrldw" >
        <?php echo $form->labelEx($model, 'fund_can_achiv'); ?>
        <?php echo $form->textArea($model, 'fund_can_achiv', array('maxlength' => 255)); ?>
        <?php echo $form->error($model,'fund_can_achiv'); ?>   
        </div>
        <h6 style='font-weight: normal;'>Fundraiser should be searchable<span class="required">*</span></h6>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'search_yes'); ?>
            <?php echo $form->checkBox($model,/*'estado'*/'search_yes'); ?>
            <?php echo $form->error($model, 'search_yes'); ?>   
        </div>
        <div class="form-group" >
        <?php echo $form->labelEx($model, 'search_no'); ?>
        <?php echo $form->checkBox($model,/*'estado'*/'search_no'); ?>
        <?php echo $form->error($model, 'search_no'); ?>   
        </div>
    </div>
</div>
<div class="box-footer bbbb" id="submt" >
    <?php
        echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans'));
        ?>
</div>
<?php $this->endWidget(); ?>
<script>
    $('#<?php echo Chtml::activeId($model,'ftype_id') ?>').on('change',function(){
        if($(this).val() == '4'){
            location.href = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/community'); ?>';
        }
        if($(this).val() == '5'){
            location.href = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/corporate'); ?>';
        }
    });
</script>