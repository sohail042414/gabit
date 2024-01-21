<style type="text/css">
.lead_tab ul li:last-child {
    margin-right: 0;
}

.dashboard_content .alert.alert-success,
.dashboard_content .alert-dismissable {
    margin: 10px 0 0;
    margin-bottom: 20px;
    margin-top: -6px;
}

#fundraise_form {
    margin-top: 20px;
}
.testimonial-picture {
    border: none !important;
}
</style>
<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    <div class="lead_support">
        <h4>Enter Testimonial</h4>
        <div class="lead_tab">
            <?php echo $this->renderPartial('/layouts/dashboard_menu'); ?>
        </div>
        <div class="dashboard_content">
            <div class="inner-left">
                <div class="inner-page">
                    <div id="fundraise_form">
                        <?php echo UtilityHtml::get_flash_message(); ?>                            
                        <?php                       
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            'id' => 'enter-testimonial-form',
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
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'testimonial_text'); ?>
                            <?php echo $form->textArea($model, 'testimonial_text', array('maxlength' => 500)); ?>
                            <?php echo $form->error($model, 'testimonial_text'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'testimonial_picture'); ?>
                            <?php echo $form->fileField($model, 'testimonial_picture', array('class'=> 'testimonial-picture')); ?>
                            <?php echo $form->error($model, 'testimonial_picture'); ?>
                        </div>
                        <div class="box-footer">
                            <?php echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans')); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>    -->