<div class="col-lg-12">
    <div class="panel">
            <header class="panel-heading">
             <?php echo Yii::t('app', 'Notifications') ?>

            <?php
            $this->breadcrumbs = array(
                Yii::t('app', 'Notifications  /  Send Message'),
            );


            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));
            ?>
            </header>
            
                <?php
                    $form = $this->beginWidget('CoreGxActiveForm', array(
                        'id' => 'send-message-form',
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
             <div class="panel-body">    
                <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        //#array('label' => 'Manage Posts', 'url' => array('post/admin')),
                       array('label' => 'Notifications', 'url' => array('notifications/notifications')),
                    ),
                ));
                ?>
               
                </div>
                 <div class="clear"></div>
                <div class="loader_space"></div>
                <?php echo UtilityHtml::get_flash_message(); ?>
                        <div class="box-body">   
                        
                        <div class="form-group">   
                            <?php echo $form->labelEx($send_notification_form,'Send to all'); ?>                                
                            <?php echo $form->checkBox($send_notification_form,'is_checked', array('value'=>'1','uncheckValue'=>'0' ),array('checked'=>'checked')); ?>
                            <?php echo $form->error($send_notification_form,'is_checked'); ?>
                        </div>
                    
                        <div class="form-group" id ="search_box">
                         <?php echo $form->labelEx($send_notification_form,'name'); ?>
                         <?php
                           echo '<br>';
                            echo CHtml::hiddenField('selectedvalue','id');

                             $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                'name'=>'searchbox',
                                'value'=>$model->username,
                                'source'=>CController::createUrl('notifications/autocomplete'),
                                'options'=>array(
//                                'showAnim'=>'fold',         
//                                'minLength'=>'2',
                                'select'=>'js:function( event, ui ) {
                                            $("#searchbox").val( ui.item.label );
                                            $("#selectedvalue").val( ui.item.value );
                                            return false;
                                      }',
                                ),
                                'htmlOptions'=>array(
                                'onfocus' => 'js: this.value = null; $("#searchbox").val(null); $("#selectedvalue").val(null);',
                                'class' => 'form-control',
                                'placeholder' => "Search...",
                                ),
                                ));
                            
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($send_notification_form,'subject'); ?>
                            <?php echo $form->textField($send_notification_form, 'subject', GxHtml::listDataEx(Users::model()->findAllAttributes(null, true)), array('empty' => 'Please Select Username')); ?>
                            <?php echo $form->error($send_notification_form,'subject'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($send_notification_form,'message'); ?>
                            <?php echo $form->textArea($send_notification_form, 'message'); ?>
                            <?php echo $form->error($send_notification_form,'message'); ?>
                        </div>

                        <div class="box-footer">
                            <?php echo GxHtml::submitButton(Yii::t('app', 'Send'), array('class' => 'btn_send_ans')); ?>
                        </div>
                    <?php
                        $this->endWidget();
                    ?>
                </div>
             </div>     
</div> 
</div>
<script>
 $(document).ready(function () {


        var a = '<?php  if(!empty($_POST['SendNotificationForm']['is_checked'])){ echo $_POST['SendNotificationForm']['is_checked'];  } else { echo "1" ;} ?>';
        //alert(a);
        if (a == "1") {
            //$('input:radio[name=AdminPreviewReadyForm[select_type]]').val(['1']);
           
            $("#search_box").show();
        } else {
             <?php $model->is_checked = '2'; ?>

            $("#search_box").hide();
        }
        
        $("input:checkbox[type=checkbox]").change(function () {

            if (this.value == '1' && this.checked) {
                $("#search_box").hide();
         
            } else {
                $("#search_box").show();
 
            }
        });
    });
</script>