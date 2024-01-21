<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">

    <div class="dashboard_content">
   
        <div class="inner-page" id="Invite_Event">
                <h4>Invite for Event</h4>
                <div class="inner-left">
                  
                    <?php echo UtilityHtml::get_flash_message(); ?>
                        <!--<h4>Start a Fundraiser</h4>-->
                      <div class="clear"></div>    
                            
                        <?php
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            'id' => 'invitation-form',
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
                       //$model = new InviteFriendForm();
                        
                        ?>
                        
                        
                        <div class="event_box" >
                            <?php //echo $form->textField($model, 'requirements'); id="invitaion_div1"?>
                            <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>
                        
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'event_name'); ?>
                                <?php echo $form->textField($model, 'event_name'); ?>
                                <?php echo $form->error($model, 'event_name'); ?>
                            </div>
                            
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'event_cordinator'); ?>
                                <?php echo $form->textField($model, 'event_cordinator'); ?>
                                <?php echo $form->error($model, 'event_cordinator'); ?>
                            </div>
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'email'); ?>
                                <?php echo $form->textField($model, 'email'); ?>
                                <?php echo $form->error($model, 'email'); ?>
                            </div>
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'event_type'); ?>
                                <?php echo $form->textField($model, 'event_type'); ?>
                                <?php// echo $form->dropDownList($model,'event_type', array('1'=>'Child','2'=>'Social','3'=>'Awareness'),array('empty'=>'Select Event type')); ?>
                                <?php echo $form->error($model, 'event_type'); ?>
                            </div>
<!--                            <div class="form-group"  >
                                <?php// echo $form->labelEx($model, 'total_members'); ?>
                                <?php //echo $form->textField($model, 'total_members'); ?>
                                <?php //echo $form->dropDownList($model,'total_members', array('1'=>'100','2'=>'200','3'=>'500','4'=>'1000'),array('empty'=>'Select Option')); ?>
                                <?php //echo $form->error($model, 'total_members'); ?>
                            </div>-->
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'event_desc'); ?>
                                <?php echo $form->textArea($model, 'event_desc'); ?>
                                <?php echo $form->error($model, 'event_desc'); ?>
                            </div>
                            
<!--                            <div class="form-group"  >
                                <?php //echo $form->labelEx($model, 'cost_per_person'); ?>
                                <?php// echo $form->textField($model, 'cost_per_person'); ?>
                                <?php //echo $form->error($model, 'cost_per_person'); ?>
                            </div>-->
                            
<!--                            <div class="form-group"  >
                           
                                <?php //echo $form->labelEx($model, 'outside_activity'); ?>
                                <?php //echo $form->radioButtonlist($model,'outside_activity',array('value' => 'Yes', 'uncheckValue'=>'No')); ?>
                                <?php //echo  $form->radioButtonList($model,'outside_activity',array('value'=>'Yes','uncheckValue'=>'No'),array('separator'=>'', 'labelOptions'=>array('style'=>'display:inline'))); ?>
                                <?php //echo $form->error($model, 'outside_activity'); ?>
                            </div>-->
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'attached_itinerary'); ?>
                                <?php echo $form->fileField($model, 'attached_itinerary', array('maxlength' => 250, 'class' => 'upload_file')); ?>
                                <?php echo $form->error($model, 'attached_itinerary'); ?>
                            </div>
<!--                        </div>     
                        <div class="event_box" >-->
<!--                            <div class="form-group"  >
                                <?php //echo $form->labelEx($model, 'requirement_1'); ?>
                                <?php //echo $form->textField($model, 'requirements'); id="invitaion_div2"
                                //echo $form->checkBoxList($model, 'requirement_1', array("SE" => "Security", "CA" => "Catering", "ST" => "Staffing"), array('separator' => '', 'id' => 'chk_lst_id')); ?>
                              
                                <?php //echo $form->error($model, 'requirement_1'); ?>
                            </div>-->
                            
<!--                            <div class="form-group"  >
                                <?php //echo $form->checkBox($model,'Need_Staffing',array('value' => 'Y', 'uncheckValue'=>'N')); ?>
                                <?php //echo $form->labelEx($model, 'Need_Staffing'); ?>
                                <?php// echo $form->error($model, 'Need_Staffing'); ?>
                            </div>
                            <div class="form-group"  >
                                <?php //echo $form->checkBox($model,'Need_Catering',array('value' => 'Y', 'uncheckValue'=>'N')); ?>
                                <?php //echo $form->labelEx($model, 'Need_Catering'); ?>
                                <?php //echo $form->error($model, 'Need_Catering'); ?>
                            </div>
                            <div class="form-group"  >
                                <?php //echo $form->checkBox($model,'Need_Security',array('value' => 'Y', 'uncheckValue'=>'N')); ?>
                                <?php //echo $form->labelEx($model, 'Need_Security'); ?>
                                <?php //echo $form->error($model, 'Need_Security'); ?>
                            </div>-->
                            
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'event_startdate'); ?>
                                <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                                $this->widget('CJuiDateTimePicker', array(
                                    'model' => $model, //Model object
                                    'attribute' => 'event_startdate', //attribute name
                                    'language' => 'en',
                                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                                    'options' => array(
                                        'dateFormat' => 'yy-mm-dd',
                                    ) // jquery plugin options
                                ));
                                ?>
                                <?php echo $form->error($model, 'event_startdate'); ?>
                            </div>
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'event_enddate'); ?>
                                <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                                $this->widget('CJuiDateTimePicker', array(
                                    'model' => $model, //Model object
                                    'attribute' => 'event_enddate', //attribute name
                                    'language' => 'en',
                                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                                    'options' => array(
                                        'dateFormat' => 'yy-mm-dd',
                                    ) // jquery plugin options
                                ));
                                ?>
                                <?php echo $form->error($model, 'event_enddate'); ?>
                            </div>
                            
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'location'); ?>
                                <?php echo $form->textArea($model, 'location'); ?>
                                <?php echo $form->error($model, 'location'); ?>
                            </div>
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'city'); ?>
                                <?php echo $form->textField($model, 'city'); ?>
                                <?php echo $form->error($model, 'city'); ?>
                            </div>
                            
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'state'); ?>
                                <?php //echo $form->textField($model, 'state'); ?>
                                <?php echo $form->dropDownList($model,'state', array('1'=>'Kano','2'=>'Lagos','3'=>'Kaduna'),array('empty'=>'Select Option')); ?>

                                <?php echo $form->error($model, 'state'); ?>
                            </div>
                            
                             <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'country'); ?>
                                <?php// echo $form->textField($model, 'country'); ?>
                                <?php echo $form->dropDownList($model,'country', array('1'=>'Nigeria'),array('empty'=>'Select Option')); ?>

                                <?php echo $form->error($model, 'country'); ?>
                            </div>
                            
                            
                            
                            <div class="box-footer">
                                <?php
                                echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans'));
                                ?>
                            </div>
                        </div>    
                        <?php
                        $this->endWidget();
                    
                    ?>
                    <div class="start_explore_fundraiser">
                        <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
                        <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore
                                    Fundraisers</a>
                   	<?php // if( Yii::app()->request->urlReferrer == SITE_ABS_PATH."index.php/cms/media_reviews") { ?>
                        
				<a href="<?php echo $this->createUrl('cms/media_reviews') ?>" class="button-tab">Back</a>

                    	<?php //} ?>
                    </div>

                    </div>
                    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>

                
            </div>
    

    </div>

</div>



