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
    <h4 style='font-weight: normal;'>You are setting up a fundraiser to champion a community project with support from the general public</h4>
</div>
<div class="box-body bbbb" >
    <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>
    <?php echo $form->hiddenField($model, 'fundraiser_kind'); ?>
    <div class="form-group scrldw" id="fty_d">
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

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'ftype_typ_other'); ?>
        <?php echo $form->textField($model, 'ftype_typ_other', array('maxlength' => 50)); ?>
        <?php echo $form->error($model, 'ftype_typ_other'); ?>           
    </div>

    <div class="form-group scrldw">
        <?php echo $form->labelEx($model, 'fundraiser_title'); ?>
        <?php echo $form->textField($model, 'fundraiser_title', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'fundraiser_title'); ?>
    </div>

    <div class="form-group scrldw">
        <?php echo $form->labelEx($model, 'tell_ur_fund_story'); ?>
        <?php echo $form->textArea($model, 'tell_ur_fund_story', array('minlength' => 1500, 'maxlength' => 1600 , 'rows' => 10, 'cols' => 400)); ?>
        <p id="counter"></p>
        <?php echo $form->error($model, 'tell_ur_fund_story'); ?>   
    </div>

    <div class="form-group scrldw" id="funding12" >
        <?php echo $form->labelEx($model, 'uplod_fun_img'); ?>
        <?php echo $form->fileField($model, 'uplod_fun_img', array('maxlength' => 250, 'class' => 'upload_file')); ?>
        <div id="bn_em">Square image required; preferably 512 x 512</div>
        <?php echo $form->error($model, 'uplod_fun_img'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'benifi_type'); ?>
        <?php echo $form->dropDownList($model, 'benifi_type', $model->getBeneficiaryTypes(),array('prompt' => '– Please Select –')); ?>
        <?php echo $form->error($model, 'benifi_type'); ?>   
    </div>

    <div class="form-group" style="display: none;">
        <?php echo $form->label($model, 'benifiry_name'); ?>
        <?php echo $form->textField($model, 'benifiry_name', array('maxlength' => 200)); ?>
        <?php echo $form->error($model, 'benifiry_name'); ?>           
    </div>

    <div class="form-group ">
        <?php echo $form->labelEx($model, 'project_name'); ?>
        <?php echo $form->textField($model, 'project_name', array('maxlength' => 50)); ?>
        <?php echo $form->error($model, 'project_name'); ?>           
    </div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'project_category'); ?>
        <?php echo $form->dropDownList($model, 'project_category', $model->getProjectCategories(),array('prompt' => '– Please Select –')); ?>
        <?php echo $form->error($model, 'project_category'); ?>           
    </div>

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'project_category_other'); ?>
        <?php echo $form->textField($model, 'project_category_other', array('maxlength' => 50)); ?>
        <?php echo $form->error($model, 'project_category_other'); ?>           
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'project_champion'); ?>
        <?php echo $form->dropDownList($model, 'project_champion', $model->getProjectChampions(),array('prompt' => '– Please Select –')); ?>
        <?php echo $form->error($model, 'project_champion'); ?> 
    </div>

    <div class="form-group">
        <span id="champion-logo-wrap" style="display:none; width:190px; float:left;">
            <h6>Logo</h6>
            <img id="champion-logo" class="preview_image" src="" alt="" />
        </span>
        <span id="champion-bg-wrap" style="display:none; width:260px; float:left;">
            <h6>Background Image</h6>
            <img id="champion-bg" class="preview_image" src="" alt="" />
        </span>          
    </div> 

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'project_champion_name'); ?>
        <?php echo $form->textField($model, 'project_champion_name'); ?>
        <?php echo $form->error($model, 'project_champion_name'); ?>           
    </div>

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'champion_logo' ); ?>
        <?php echo $form->fileField($model, 'champion_logo', array('maxlength' => 250, 'class' => 'upload_file'));
            if (!empty($model->champion_logo)) {
                echo '<img class="preview_image" src="'.$model->champion_logo . '" alt="" />';
            }
            ?>
        <?php echo $form->error($model, 'champion_logo' ); ?>
    </div>

    <div class="form-group" style="display: none;">
        <?php echo $form->labelEx($model, 'champion_bg_image' ); ?>
        <?php echo $form->fileField($model, 'champion_bg_image', array('maxlength' => 250, 'class' => 'upload_file'));
            if (!empty($model->champion_bg_image)) {
                echo '<img class="preview_image" src="' . SITE_ABS_PATH_UPLOAD_PIC_FUN_MANAGE_THUMB . $model->champion_bg_image . '" alt="" />';
            }
            ?>
        <?php echo $form->error($model, 'champion_bg_image' ); ?>
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
        <?php echo $form->fileField($model, 'uplod_pic_lead_supptr', array('maxlength' => 250, 'class' => 'upload_file'));
            if (!empty($model->uplod_pic_lead_supptr)) {
                echo '<img class="preview_image" src="' . SITE_ABS_PATH_UPLOD_PIC_LEAD_SUPPTR_THUMB . $model->uplod_pic_lead_supptr . '" alt="" />';
            }
            ?>
        <div id="bn_em">Square image required; preferably 512 x 512</div>
        <?php echo $form->error($model, 'uplod_pic_lead_supptr'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'fund_manager'); ?>
        <?php echo $form->dropDownList($model, 'fund_manager', $model->getFundManagers(),array('prompt' => '– Please Select –')); ?>
        <?php echo $form->error($model, 'fund_manager'); ?>           
    </div>

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'fund_mange_name'); ?>
        <?php echo $form->textField($model, 'fund_mange_name',array('maxlength' => 200)); ?>
        <?php echo $form->error($model, 'fund_mange_name'); ?>  
        <div id="bn_em">Fund manager must be a person</div>         
    </div>

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'fund_mange_phone'); ?>
        <?php echo $form->textField($model, 'fund_mange_phone', array('maxlength' => 20)); ?>
        <?php echo $form->error($model, 'fund_mange_phone'); ?>   
    </div>

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'fund_mange_email'); ?>
        <?php echo $form->textField($model, 'fund_mange_email', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'fund_mange_email'); ?>   
    </div>

    <div class="form-group" style="display:none;">
        <?php echo $form->labelEx($model, 'upload_pic_fun_manager' ); ?>
        <?php echo $form->fileField($model, 'upload_pic_fun_manager', array('maxlength' => 250, 'class' => 'upload_file')); ?>
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
    <div class="form-group">
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
<div class="box-footer bbbb" id="submt" >
    <?php echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans')); ?>
</div>
<?php $this->endWidget(); ?>
<script>

    $('#<?php echo Chtml::activeId($model,'ftype_id') ?>').on('change',function(){
        if($(this).val() == '5'){
            location.href = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/corporate'); ?>';
        }else if($(this).val() == '6'){
            location.href = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/nonprofit'); ?>';
        }else{
            location.href = '<?php echo Yii::app()->createAbsoluteUrl('Fundraise/other'); ?>';
        }
    });

    $('#<?php echo Chtml::activeId($model,'benifi_name_not_applicable') ?>').on('click',function(){
        if($(this).is(':checked')){
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').attr('readonly',true);
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').css('cursor','not-allowed');
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').css('background-color','#ccc');
        }else{
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').removeAttr('readonly');
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').css('cursor','initial');
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').css('background-color','white');
        }
    });

    $('#<?php echo Chtml::activeId($model,'project_champion') ?>').on('change',function(){
        var champion_id = $(this).val();
        if(champion_id=='-1'){
            $('#<?php echo Chtml::activeId($model,'project_champion_name') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'project_champion_name') ?>').parent('.form-group').show();
            $('#<?php echo Chtml::activeId($model,'champion_logo') ?>').parent('.form-group').show();
            $('#<?php echo Chtml::activeId($model,'champion_bg_image') ?>').parent('.form-group').show();
            $('#champion-logo-wrap').hide();
            $('#champion-bg-wrap').hide();
        }else{
            $('#<?php echo Chtml::activeId($model,'project_champion_name') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'project_champion_name') ?>').parent('.form-group').hide();
            $('#<?php echo Chtml::activeId($model,'champion_logo') ?>').parent('.form-group').hide();
            $('#<?php echo Chtml::activeId($model,'champion_bg_image') ?>').parent('.form-group').hide();

            $.ajax({
                'type': 'GET',
                'dataType' : 'json',
                'url': '<?php echo Yii::app()->createUrl('Fundraise/champion'); ?>',                
                'data': {'champion_id':champion_id},
                'success': function (data) {
                    if(data.status){
                        if(data.champion_logo){
                            $('#champion-logo').attr('src',data.champion_logo);
                            $('#champion-logo-wrap').show();
                        }
                        if(data.champion_bg_image){
                            $('#champion-bg').attr('src',data.champion_bg_image);
                            $('#champion-bg-wrap').show();
                            
                        }
                    }
                 }
            });

        }
    });
    
    $('#<?php echo Chtml::activeId($model,'fund_manager') ?>').on('change',function(){
        if($(this).val()=='-1'){
            $('#<?php echo Chtml::activeId($model,'fund_mange_name') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'fund_mange_name') ?>').parent('.form-group').show();
            $('#<?php echo Chtml::activeId($model,'fund_mange_email') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'fund_mange_email') ?>').parent('.form-group').show();
            $('#<?php echo Chtml::activeId($model,'fund_mange_phone') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'fund_mange_phone') ?>').parent('.form-group').show();
            $('#<?php echo Chtml::activeId($model,'upload_pic_fun_manager') ?>').parent('.form-group').show();
            
        }else{
            $('#<?php echo Chtml::activeId($model,'fund_mange_name') ?>').val($(this).val());
            $('#<?php echo Chtml::activeId($model,'fund_mange_name') ?>').parent('.form-group').hide();
            $('#<?php echo Chtml::activeId($model,'fund_mange_email') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'fund_mange_email') ?>').parent('.form-group').hide();
            $('#<?php echo Chtml::activeId($model,'fund_mange_phone') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'fund_mange_phone') ?>').parent('.form-group').hide();
            $('#<?php echo Chtml::activeId($model,'upload_pic_fun_manager') ?>').parent('.form-group').hide();
        }
    });  
    
    $('#<?php echo Chtml::activeId($model,'project_category') ?>').on('change',function(){
        if($(this).val()=='-1'){
            $('#<?php echo Chtml::activeId($model,'project_category_other') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'project_category_other') ?>').parent('.form-group').show();
        }else{
            $('#<?php echo Chtml::activeId($model,'project_category_other') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'project_category_other') ?>').parent('.form-group').hide();
        }
    });

    $('#<?php echo Chtml::activeId($model,'benifi_type') ?>').on('change',function(){
        if($(this).val()=='community'){
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').parent('.form-group').show();
        }else{
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').val('');
            $('#<?php echo Chtml::activeId($model,'benifiry_name') ?>').parent('.form-group').hide();
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