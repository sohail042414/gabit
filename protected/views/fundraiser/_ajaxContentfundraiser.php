<?php
    $model->attributes=Yii::app()->session['my_fundraiser_data']; 
    if(!empty(Yii::app()->session['my_fundraiser_data'])){
        $model->attributes=Yii::app()->session['my_fundraiser_data'];
    }
    
    $form = $this->beginWidget('CoreGxActiveForm', array(
                'id' => 'edit_fundraiser_data-form',
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
        <?php $model->user_id= null; ?>
        
        <div class="form-group" id="fundraiser_id">
            <?php   echo $form->labelEx($model, 'Select Fundraiser');  ?>
            <?php echo $form->dropDownList($model, 'id',GxHtml::listDataEx(SetupFundraiser::model()->findAllByAttributes(array('user_id' =>Yii::app()->frontUser->id )))
                           ,array('prompt' => '--Please Select --','options'=>array('selected'=>true))); ?>
            <?php echo $form->error($model, 'id'); ?>
        </div>    
        <div class="form-group">
                <?php echo $form->labelEx($model, 'ftype_id'); ?>
                <?php echo $form->dropDownList($model, 'ftype_id', GxHtml::listDataEx(FundraiserType::model()->findAllAttributes(null, true))); ?>
                <?php echo $form->error($model, 'ftype_id'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_title'); ?>
            <?php echo $form->textField($model, 'fundraiser_title', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fundraiser_title'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'search_status'); ?>
            <?php echo $form->dropDownList($model, 'search_status', array('Y' => Yii::t('app', 'Active'), 'N' => Yii::t('app', 'Inactive'))); ?>
            <?php echo $form->error($model, 'search_status'); ?>
       </div>

        <div class="form-group"> 
            <?php echo $form->labelEx($model, 'fundraiser_description'); ?>
            <?php echo $form->textArea($model, 'fundraiser_description', array('rows' => 3, 'cols' => 30)); ?>
            <?php echo $form->error($model, 'fundraiser_description'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_name'); ?>
            <?php echo $form->textField($model, 'recipient_name', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'recipient_name'); ?>
        </div>

        <div class="form-group">
           <?php echo $form->labelEx($model, 'recipient_age'); ?>
            <?php echo $form->textField($model, 'recipient_age', array('maxlength' => 3)); ?>
            <?php echo $form->error($model, 'recipient_age'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_sex'); ?>
            <?php echo $form->dropDownList($model, 'recipient_sex', array('M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female'))); ?>
            <?php echo $form->error($model, 'recipient_sex'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_email'); ?>
            <?php echo $form->textField($model, 'recipient_email', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'recipient_email'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recipient_relationship'); ?>
            <?php echo $form->dropDownList($model, 'recipient_relationship', GxHtml::listDataEx(Relationship::model()->findAllAttributes(null, true))); ?>
            <?php echo $form->error($model, 'recipient_relationship'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_goal'); ?>
            <?php echo $form->textField($model, 'fundraiser_goal', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fundraiser_goal'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_amount_need'); ?>
            <?php echo $form->textField($model, 'fundraiser_amount_need', array('maxlength' => 45)); ?>
            <?php echo $form->error($model, 'fundraiser_amount_need'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_startdate'); ?>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                                            $this->widget('CJuiDateTimePicker', array(
                                                'model' => $model, //Model object
                                                'attribute' => 'fundraiser_startdate', //attribute name
                                                'language' => 'en',
                                                'mode' => 'datetime', //use "time","date" or "datetime" (default)
                                                'options' => array(
                                                    'dateFormat' => 'yy-mm-dd',
                                                ) // jquery plugin options
                                            ));
            ?>
            <?php echo $form->error($model, 'fundraiser_startdate'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'fundraiser_timeline'); ?>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                                            $this->widget('CJuiDateTimePicker', array(
                                                'model' => $model, //Model object
                                                'attribute' => 'fundraiser_timeline', //attribute name
                                                'language' => 'en',
                                                'mode' => 'datetime', //use "time","date" or "datetime" (default)
                                                'options' => array(
                                                    'dateFormat' => 'yy-mm-dd',
                                                ) // jquery plugin options
                                            ));
            ?>
                                            <!--                    --><?php //echo $form->textField($model, 'fundraiser_timeline'); ?>
            <?php echo $form->error($model, 'fundraiser_timeline'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'use_of_funds'); ?>
            <?php echo $form->textArea($model, 'use_of_funds'); ?>
            <?php echo $form->error($model, 'use_of_funds'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'funds_achieve'); ?>
            <?php echo $form->textArea($model, 'funds_achieve'); ?>
            <?php echo $form->error($model, 'funds_achieve'); ?>
        </div>

    </div>
        <div class="box-footer">
        <?php
            echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans'));
        ?>
        </div>
  

    <?php
        //echo "silicon";die;
        $this->endWidget();
    ?>

<script>
    
    $(document).ready(function(){
            
                $("#SetupFundraiser_id.form-control").on('change', function () {
                   var adata = $(this).val();
                    if(adata==''){
                        var adata = "999999999999999";
                    }
                    $.ajax({
                        url: '<?php echo Yii::app()->createUrl('fundraiser/managefundraiser'); ?>',
                        type: 'post',
                        data: {clienData: adata},
                        success: function (result) {
                           $('#tab-3').html(result);
                        }
                    });
                });

        });
</script>