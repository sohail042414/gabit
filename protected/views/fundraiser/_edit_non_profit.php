<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'action' => Yii::app()->createUrl('fundraiser/managefundraiser',array('tab'=>'edit','fundraiser_id' => $model->id)),
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
<div class="box-body" >
<?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>
    <?php echo $form->hiddenField($model, 'fundraiser_kind'); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'ftype_id'); ?>
        <?php echo $form->dropDownList($model, 'ftype_id', CHtml::listData(FundraiserType::model()->findAll(),'id','fundraiser_type') ,
            array(
                    'empty' => '– Please Select –',
                    'disabled' => 'disabled',
                )
            );
        ?>
        <?php echo $form->error($model, 'ftype_id'); ?>
    </div>
    
    <div class="form-group" >
        <?php echo $form->labelEx($model, 'ftype_typ'); ?>
        <?php echo $form->dropDownList($model,'ftype_typ',$ftype_list, array('empty' => '– Please Select –','disabled' => 'disabled')); ?>
        <?php echo $form->error($model, 'ftype_typ'); ?>
    </div>

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'ftype_typ_other'); ?>
        <?php echo $form->textField($model, 'ftype_typ_other', array('maxlength' => 50)); ?>
        <?php echo $form->error($model, 'ftype_typ_other'); ?>           
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'fundraiser_title'); ?>
        <?php echo $form->textField($model, 'fundraiser_title', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'fundraiser_title'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'tell_ur_fund_story'); ?>
        <?php echo $form->textArea($model, 'tell_ur_fund_story', array('minlength' => 1500, 'maxlength' => 1600 ,'rows' => 10, 'cols' => 400)); ?>
        <p id="counter"></p>
        <?php echo $form->error($model, 'tell_ur_fund_story'); ?>   
    </div>
    <div class="form-group" >
        <?php echo $form->labelEx($model, 'uplod_fun_img'); ?>
        <?php echo $form->fileField($model, 'uplod_fun_img', array('maxlength' => 250, 'class' => 'upload_file')); ?>
        <?php echo $form->error($model, 'uplod_fun_img'); ?>
    </div>
    <div class="form-group preview-wrap">
        <?php 
        if (!empty($model->uplod_fun_img)) {
            echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $model->uplod_fun_img . '" alt="" />';
        }
        ?>
    </div>
    <div class="form-group scrldw" id="ben_nm">
        <?php echo $form->labelEx($model, 'benifiry_name'); ?>
        <?php echo $form->textField($model, 'benifiry_name', array('maxlength' => 255,'disabled' => 'disabled')); ?>
        <?php echo $form->error($model, 'benifiry_name'); ?>   
    </div>

    <div class="form-group scrldw" >
        <?php echo $form->labelEx($model, 'benifi_email'); ?>
        <?php echo $form->textField($model, 'benifi_email', array('maxlength' => 255,'disabled' => 'disabled')); ?>
        <?php echo $form->error($model, 'benifi_email'); ?>
        <div style="display:none;" id="bn_em">If beneficiary is under the age of 18, Lead Supporter can input their email address here</div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'uplod_pic_benif'); ?>
        <?php echo $form->fileField($model, 'uplod_pic_benif', array('maxlength' => 250, 'class' => 'upload_file','disabled' => 'disabled')); ?>
        <?php echo $form->error($model, 'uplod_pic_benif'); ?>
    </div>
    <div class="form-group preview-wrap">
        <?php 
        if (!empty($model->uplod_pic_benif)) {
            echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $model->uplod_pic_benif . '" alt="" />';
        }
        ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'uplod_benif_bg'); ?>
        <?php echo $form->fileField($model, 'uplod_benif_bg', array('maxlength' => 250, 'class' => 'upload_file')); ?>
        <?php echo $form->error($model, 'uplod_benif_bg'); ?>
    </div>

    <div class="form-group preview-wrap">
        <?php 
        if (!empty($model->uplod_benif_bg)) {
            echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $model->uplod_benif_bg . '" alt="" />';
        }
        ?>
    </div>

    <h6 style="font-weight: normal;">Who is the Lead Supporter?<span class="required">*</span></h6>

<div class="form-group" >
<?php echo $form->labelEx($model, 'lead_supptr_name'); ?>
    <?php echo $form->textField($model, 'lead_supptr_name', array('maxlength' => 255)); ?>
    <?php echo $form->error($model, 'lead_supptr_name'); ?>   
</div>

<div class="form-group">        
    <?php echo $form->labelEx($model, 'lead_supptr_email'); ?>
    <?php echo $form->textField($model, 'lead_supptr_email', array('maxlength' => 255)); ?>
    <?php echo $form->error($model, 'lead_supptr_email'); ?>   
</div>

<div class="form-group">        
    <?php echo $form->labelEx($model, 'lead_supptr_phone'); ?>
    <?php echo $form->textField($model, 'lead_supptr_phone', array('maxlength' => 20)); ?>
    <?php echo $form->error($model, 'lead_supptr_phone'); ?>   
</div>

<div class="form-group" >
    <?php echo $form->labelEx($model, 'uplod_pic_lead_supptr'); ?>
    <?php echo $form->fileField($model, 'uplod_pic_lead_supptr', array('maxlength' => 250, 'class' => 'upload_file')); ?>
    <?php echo $form->error($model, 'uplod_pic_lead_supptr'); ?>
</div>

<div class="form-group preview-wrap">
<?php 
    if (!empty($model->uplod_pic_lead_supptr)) {
        echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $model->uplod_pic_lead_supptr . '" alt="" />';
    }
?>
</div>
<h6 style="font-weight: normal;">Who is the Fund Manager?<span class="required">*</span></h6>

    <div class="form-group" >
        <?php echo $form->labelEx($model,'fund_mange_name'); ?>
        <?php echo $form->textField($model, 'fund_mange_name', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'fund_mange_name'); ?>
        <div id="bn_em">Fund manager must be a person</div>
    </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'fund_mange_phone'); ?>
            <?php echo $form->textField($model, 'fund_mange_phone', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fund_mange_phone'); ?>               
        </div>
        <div class="form-group" >
            <?php echo $form->labelEx($model, 'fund_mange_email'); ?>
            <?php echo $form->textField($model, 'fund_mange_email', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fund_mange_email'); ?>   
        </div>

        <div class="form-group" >
            <?php echo $form->labelEx($model, 'upload_pic_fun_manager' ); ?>
            <?php echo $form->fileField($model, 'upload_pic_fun_manager', array('maxlength' => 250, 'class' => 'upload_file')); ?>
            <?php echo $form->error($model, 'upload_pic_fun_manager' ); ?>
        </div>

        <div class="form-group preview-wrap">
        <?php 
            if (!empty($model->upload_pic_fun_manager)) {
                echo '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $model->upload_pic_fun_manager . '" alt="" />';
            }
        ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundriser_goal_amount'); ?>
            <?php echo $form->textField($model, 'fundriser_goal_amount', array('maxlength' => 255,'disabled' => 'disabled')); ?>
            <?php echo $form->error($model, 'fundriser_goal_amount'); ?>   
        </div>
        <h6>Fundraiser Timeline</h6>
        <div class="form-group" >
            <?php echo $form->labelEx($model,  'fundr_timeline_from'); ?>
            <?php echo $form->textField($model, 'fundr_timeline_from', array('maxlength' => 50,'disabled' => 'disabled')); ?>           
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
        <h6 style='font-weight: normal;'>Fundraiser Should Be Searchable<span class="required">*</span></h6>
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

        <h6 style='font-weight: normal;'>Include this fundraiser in <a target="_blank" href="<?php echo Yii::app()->createUrl('rewards'); ?>">donor reward program</a><span class="required">*</span></h6>
        <div class="form-group" >
            <label for="OtherFundraiser_reward_program">Yes</label>
            <?php echo $form->checkBox($model,'reward_program'); ?>
            <?php echo $form->error($model, 'reward_program'); ?>   
        </div>
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
        //if community selected
        if($(this).val() == '4'){
            location.href = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/community'); ?>';
        }else if($(this).val() == '5'){ //if corporate selected
            location.href = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/corporate'); ?>';
        }else if($(this).val() != '6'){ // if other options selected
            location.href = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/other'); ?>';
        }
    });

    $('#<?php echo Chtml::activeId($model,'tell_ur_fund_story') ?>').keyup(function () {
        var story_length = $(this).val().length;        
        if (story_length < 1500 || story_length > 1600) {
            $('#counter').text('Story length ' + story_length + ", should be between (1500 and 1600 characters)");
            $('#counter').removeClass('counter-green').addClass('counter-red');
        }else{
            $('#counter').text('Story looks good!');
            $('#counter').removeClass('counter-red').addClass('counter-green');
        }
    });
    

    $('#<?php echo Chtml::activeId($model,'ftype_typ') ?>').on('change',function(){
        $('#<?php echo Chtml::activeId($model,'ftype_typ_other') ?>').val('');
        if($(this).val()=='-1'){
            $('#<?php echo Chtml::activeId($model,'ftype_typ_other') ?>').parent('.form-group').show();
        }else{            
            $('#<?php echo Chtml::activeId($model,'ftype_typ_other') ?>').parent('.form-group').hide();
        }
    });


    $('#<?php echo Chtml::activeId($model,'search_yes') ?>').on('click',function(){        
        if($(this).is(':checked')){
            $('#<?php echo Chtml::activeId($model,'search_no') ?>').attr('checked',false);
        }
    });

    $('#<?php echo Chtml::activeId($model,'search_no') ?>').on('click',function(){        
        if($(this).is(':checked')){
            $('#<?php echo Chtml::activeId($model,'search_yes') ?>').attr('checked',false);
        }
    });
</script>